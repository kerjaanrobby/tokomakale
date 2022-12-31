
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Data User</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Data Table</h4>
                                <h6 class="card-subtitle">Data table example</h6> -->
                                <div>
                                    <button type="button" onclick="showData()" class="btn btn-success d-none d-lg-block m-l-15 float-right"><i
                                    class="fas fa-undo"></i> Refresh</button></div>
                                <div class="table-responsive m-t-40">
                                    <table id="tableuser" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Saldo</th>
                                                <th>Level</th>
                                                <th>Nomor WA</th>
                                                <th>Register</th>
                                                <th class="text-center"><i class="fa fa-cog"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modallevel">
            <div class="modal-dialog">
                <div class="modal-content">          
                    <!-- Modal Header -->
                    <form action=""  enctype="multipart/form-data" method="POST" id="formlevel" class="form-horizontal"  role="form">
                        <div class="modal-header">
                            <h4 class="modal-title">Ubah Level</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <input type="hidden" name="iduser" id="iduser">
                            <input type="hidden" name="level" id="level">
                            <h5>Apakah anda yakin akan mengubah level ?</h5>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-success btn-sm" onclick="ubahlevel()">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalsaldo">
            <div class="modal-dialog">
                <div class="modal-content">          
                    <!-- Modal Header -->
                    <form action=""  enctype="multipart/form-data" method="POST" id="formSaldo" class="form-horizontal"  role="form">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Saldo</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <input type="hidden" name="idusers" id="idusers">
                                <div>
                                    <label>Tambah Saldo</label>
                                    <input type="text" name="saldo" id="saldo" class="form-control"  required />
                                </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success btn-sm">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php echo $foot;?>
    

    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->

    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/moment/moment.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    
    <script>
        var modal = $("#modallevel");
        var modalsaldo = $("#modalsaldo");
        var table = $("#tableuser");
        var form = document.getElementById("formlevel");
        var formSaldo = document.getElementById("formSaldo");
        $(function () {
            showData();
        });
        function refreshData() {
            table.DataTable().ajax.reload();
        };
        function resetform(){
            $('#iduser').val("");
            $('#level').val("");
            form.reset();
        };
        function resetformSaldo()
        {
            $('#iduser').val("");
            formSaldo.reset();
        }
        function showData(){
            if ($.fn.DataTable.isDataTable('#tableuser') ) {
                table.DataTable().destroy();
            }
            dttable = table.DataTable({
              responsive: true,
              retrieve: true,
              paging: true,
              scrollX: true,
              processing: true, //Feature control the processing indicator.
              serverSide: true, //Feature control DataTables' server-side processing mode.
              order: [],
              ajax: {
                url: "<?php echo site_url('user/datalist')?>",
                type: "POST"
              },
              "columnDefs": [{
              "targets": [ 0 ], //first column / numbering column
              "orderable": true, //set not orderable
              },],
            });
        }
        function makereseller(iduser)
        {
            $("#level").val("Reseller");
            $("#iduser").val(iduser);
            modal.find('.modal-title').text('Ubah Level');
            modal.modal();
        }
        function makeuser(iduser)
        {
            $("#level").val("User");
            $("#iduser").val(iduser);
            modal.find('.modal-title').text('Ubah Level');
            modal.modal();
        }
        function makevvip(iduser)
        {
            $("#level").val("VVIP");
            $("#iduser").val(iduser);
            modal.find('.modal-title').text('Ubah Level');
            modal.modal();
        }
        modal.on('hidden.bs.modal', function () {
            resetform();
        });
        function ubahlevel(){
            var id = $("#iduser").val();
            var level = $("#level").val();
            $.ajax({
                url: "<?php  echo base_url(); ?>user/ubahlevel",
                type: "POST",
                data:  {
                    id:id,
                    level:level
                },
                dataType:'json', 
                success: function(data)
                {
                    if(data.hasil==1){
                        Swal.fire({
                            icon: 'success',
                            title: data.pesan,
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }else{
                        Swal.fire({
                            icon: 'warning',
                            title: data.pesan,
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                    refreshData();
                    $('#modallevel').modal('hide');
                }         
            });
        }
        function tambahsaldo($iduser){
            $("#idusers").val($iduser);
            modalsaldo.find('.modal-title').text('Tambah Saldo');
            modalsaldo.modal();
        }
        $(function () {
            $('#formSaldo').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php  echo base_url(); ?>user/ubahsaldo",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType:'json', 
                    success: function(data){
                        if(data.hasil==1){
                            Swal.fire({
                                icon: 'success',
                                title: data.pesan,
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: data.pesan,
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                        resetformSaldo();
                        refreshData();
                        modalsaldo.modal('hide');
                    }   
                });
            });
        });

        function hapusData(id){
            $("#id_data_hapus").val(id);
            $("#modalHapusData").modal();
        }
        function hapus(){
            var id = $("#id_data_hapus").val();
            $.ajax({
                url: "<?php  echo base_url(); ?>user/datahapus",
                type: "POST",
                data:  {id,id},
                dataType:'json', 
                success: function(data)
                {
                    if(data.hasil==1){
                        Swal.fire({
                            icon: 'success',
                            title: data.pesan,
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }else{
                        Swal.fire({
                            icon: 'warning',
                            title: data.pesan,
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                    refreshData();
                    $('#modalHapusData').modal('hide');
                    $('#id_data_hapus').val("");
                }         
            });
        }
    </script>
</body>

</html>