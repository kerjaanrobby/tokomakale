
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Data News</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">News</a></li>
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
                                <div><button type="button" onclick="tambahdata()" class="btn btn-info d-none d-lg-block m-l-15 float-right"><i
                                    class="fa fa-plus-circle"></i> Tambah Data</button>
                                    <button type="button" onclick="showData()" class="btn btn-success d-none d-lg-block m-l-15 float-right"><i
                                    class="fas fa-undo"></i> Refresh</button></div>
                                <div class="table-responsive m-t-40">
                                    <table id="tablenews" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Judul</th>
                                                <th>Isi</th>
                                                <th>Thumbnail</th>
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
        <div id="modalform" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action=""  enctype="multipart/form-data" id="formInput" method="POST" class="form-horizontal" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div>
                                    <label>Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control"  required />
                                </div>
                                <div>
                                    <label>Isi</label>
                                    <textarea name="isi" id="isi" class="form-control"  required ></textarea>
                                </div>
                                <div>
                                    <label>Tanggal</label>
                                    <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('Y-m-d');?>" required readonly />
                                </div>
                                <div>
                                    <label>Thumbnail</label>
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control"   />
                                    <img id="imgthumbnail" width="100">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" class="form-control"  />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
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
        var modal = $("#modalform");
        var table = $("#tablenews");
        var form = document.getElementById("formInput");
        $(function () {
            // $('#tglmulai').datepicker({ 
            //     // dateFormat: 'dd-mm-yyyy',
            //     toggleActive: true 
            // });
            // $('#tglselesai').datepicker({ 
            //     dateFormat: 'dd-mm-yyyy',
            //     toggleActive: true  
            // });
            showData();
        });
        function refreshData() {
            table.DataTable().ajax.reload();
        };
        function resetform(){
            $('#id').val("");
            $("#imgthumbnail").attr('src','<?php echo base_url();?>assets/image/imgdef.jpeg');
            form.reset();
        };
        function showData(){
            if ($.fn.DataTable.isDataTable('#tablenews') ) {
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
                url: "<?php echo site_url('news/datalist')?>",
                type: "POST"
              },
              "columnDefs": [{
              "targets": [ 0 ], //first column / numbering column
              "orderable": true, //set not orderable
              },],
            });
        }
        function tambahdata(){
            modal.find('.modal-title').text('Tambah Data');
            modal.modal();
            resetform();
        }
        function editData(id){
            modal.find('.modal-title').text('Edit Data');
            modal.modal();
            $.ajax({
                type: "POST",
                url: '<?php  echo base_url(); ?>news/datadetail',
                data:{
                id:id
              },
              dataType:'json',
              success: function(data) {
                $.each(data.hasildata,function(i,v){
                    $('#id').val(v.idnews);
                    $('#judul').val(v.judul);
                    $('#isi').val(v.isi);
                    if(v.thumbnail!=""){
                        $("#imgthumbnail").attr('src','<?php echo base_url();?>assets/image/'+v.thumbnail);
                    }
                });
              }
            });
        }
        modal.on('hidden.bs.modal', function () {
            resetform();
        });
        function hapusData(id){
            $("#id_data_hapus").val(id);
            $("#modalHapusData").modal();
        }
        function hapus(){
            var id = $("#id_data_hapus").val();
            $.ajax({
                url: "<?php  echo base_url(); ?>news/datahapus",
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
        $(function () {
            $('#formInput').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php  echo base_url(); ?>news/datasimpan",
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
                        resetform();
                        refreshData();
                        modal.modal('hide');
                    }   
                });
            });
        });
    </script>
</body>

</html>