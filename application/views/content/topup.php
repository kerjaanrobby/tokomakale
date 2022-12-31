
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Data Top Up</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Top Up</a></li>
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
                                    <table id="tabletopup" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kode</th>
                                                <th>Nominal</th>
                                                <th>Payment</th>
                                                <th>Email</th>
                                                <th>Kode TRX</th>
                                                <th>Status</th>
                                                <th class="text-center"><span class="fa fa-cog"></span></th>
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
        var table = $("#tabletopup");
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
        function konfirmasimanual(trans_id)
        {
            $.ajax({
                type: "POST",
                url: '<?php  echo base_url(); ?>transpayment/konfirmasimanualtopup',
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
        function hapustransaksi(trans_id)
        {
            $("#id_data_hapus").val(trans_id);
            $("#modalHapusData").modal();
        }
        function hapus(){
            var id = $("#id_data_hapus").val();
            $.ajax({
                url: "<?php  echo base_url(); ?>user/hapustopup",
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
            if ($.fn.DataTable.isDataTable('#tabletopup') ) {
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
                url: "<?php echo site_url('user/datalisttopup')?>",
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