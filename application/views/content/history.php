
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Data History Transaksi</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">History Transaksi</a></li>
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
                                <!-- <button type="button" onclick="tambahdata()" class="btn btn-info d-none d-lg-block m-l-15 float-right"><i
                                    class="fa fa-plus-circle"></i> Tambah Data</button> -->
                                    <button type="button" onclick="showData()" class="btn btn-success d-none d-lg-block m-l-15 float-right"><i
                                    class="fas fa-undo"></i> Refresh</button></div>
                                <div class="table-responsive m-t-40">
                                    <table id="tabletransaksi" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Game</th>
                                                <th>Produk</th>
                                                <th>Akun</th>
                                                <th>Zona/Server</th>
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
        </div>
        <div id="modalform" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <form action=""  enctype="multipart/form-data" id="formInput" method="POST" class="form-horizontal" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                    <label>Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"  required />
                                </div>
                                <div>
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" name="desk" id="desk"required ></textarea>
                                </div>
                                <div>
                                    <label>Url Playstore</label>
                                    <input type="text" name="playstore" id="playstore" class="form-control" required  />
                                </div>
                                <div>
                                    <label>Url Appstore</label>
                                    <input type="text" name="appstore" id="appstore" class="form-control" required  />
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <p>Pengaturan Form</p>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Status Form AkunId</label>
                                            <select class="form-control" name="akunid_status" id="akunid_status"required >
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Non Aktif">Non Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Label Form AkunId</label>
                                            <input type="text" name="akunid_label" id="akunid_label" class="form-control" required  />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Jenis Form AkunId</label>
                                            <select class="form-control" name="akunid_jenis" id="akunid_jenis"required >
                                                <option value="">Pilih Jenis Form</option>
                                                <option value="Textfield">Textfield</option>
                                                <option value="Optional">Optional</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Status Form Zona</label>
                                            <select class="form-control" name="zona_status" id="zona_status"required >
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Non Aktif">Non Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Label Form Zona</label>
                                            <input type="text" name="zona_label" id="zona_label" class="form-control"  required />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Jenis Form Zona</label>
                                            <select class="form-control" name="zona_jenis" id="zona_jenis"required >
                                                <option value="">Pilih Jenis Form</option>
                                                <option value="Textfield">Textfield</option>
                                                <option value="Optional">Optional</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Status Form Server</label>
                                            <select class="form-control" name="server_status" id="server_status"required >
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Non Aktif">Non Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Label Form Server</label>
                                            <input type="text" name="server_label" id="server_label" class="form-control"required   />
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <label>Jenis Form Server</label>
                                            <select class="form-control" name="server_jenis" id="server_jenis"required >
                                                <option value="">Pilih Jenis Form</option>
                                                <option value="Textfield">Textfield</option>
                                                <option value="Optional">Optional</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <label>Icon Game</label>
                                            <input type="file" id="icon" name="icon" class="form-control"   />
                                            <img id="imgicon" width="100">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div>
                                            <label>Gambar Game</label>
                                            <input type="file" id="gambar" name="gambar" class="form-control"   />
                                            <img id="imggambar" width="100">
                                        </div>
                                    </div>
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
        var table = $("#tabletransaksi");
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
        function selesaiTrans(trans_id)
        {
            $.ajax({
                type: "POST",
                url: '<?php  echo base_url(); ?>transaksi/selesaitrans',
                data:{
                id:trans_id
              },
              dataType:'json',
              success: function(data) {
                if(data.hasil==1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Update Transaksi Berhasil',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Update Transaksi Gagal',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
                refreshData();
              }
            });
        }
        function showData(){
            if ($.fn.DataTable.isDataTable('#tabletransaksi') ) {
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
                url: "<?php echo site_url('transaksi/datalisthistory')?>",
                type: "POST"
              },
              "columnDefs": [{
              "targets": [ 0 ], //first column / numbering column
              "orderable": true, //set not orderable
              },],
            });
        }
        function hapusData(id){
            $("#id_data_hapus").val(id);
            $("#modalHapusData").modal();
        }
        function hapus(){
            var id = $("#id_data_hapus").val();
            $.ajax({
                url: "<?php  echo base_url(); ?>transaksi/datahapus",
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