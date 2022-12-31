
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Data Withdraw</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Withdraw</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <button type="button" onclick="showData()" class="btn btn-success d-none d-lg-block m-l-15 float-right"><i
                                    class="fas fa-undo"></i> Refresh</button></div>
                                <div class="table-responsive m-t-40">
                                    <table id="tablewithdraw" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nominal</th>
                                                <th>Bank</th>
                                                <th>Nomor Rekening</th>
                                                <th>Email</th>
                                                <th>Status</th>
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
        </div> <div id="modalform" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
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
                                    <label>File Transfer</label>
                                    <input type="file" name="file" id="file" class="form-control"  required />
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
    <script type="text/javascript">
        var modal = $("#modalform");
        var table = $("#tablewithdraw");
        var form = document.getElementById("formInput");

        $(function () {
            showData();
        });
        function refreshData() {
            table.DataTable().ajax.reload();
        };
        function resetform(){
            $('#id').val("");
            $("#imgicon").attr('src','<?php echo base_url();?>assets/image/imgdef.jpeg');
            $("#imggambar").attr('src','<?php echo base_url();?>assets/image/imgdef.jpeg');
            form.reset();
        };
        function modalBukti($idtarik)
        {
            modal.find('.modal-title').text('Upload Bukti Transfer');
            modal.modal();
            $("#id").val($idtarik);
        }
        $(function () {
            $('#formInput').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php  echo base_url(); ?>withdraw/updatetarik",
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
        function showData(){
            if ($.fn.DataTable.isDataTable('#tablewithdraw') ) {
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
                url: "<?php echo site_url('user/datalisttarik')?>",
                type: "POST"
              },
              "columnDefs": [{
              "targets": [ 0 ], //first column / numbering column
              "orderable": true, //set not orderable
              },],
            });
        }
    </script>
</body>

</html>