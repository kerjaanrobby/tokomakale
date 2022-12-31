
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Data Transaksi</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Transaksi</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row" id="rownotif">
                            <!-- <div class="col-lg-12 col-md-12" id="divsuccesss">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3> This is an example top alert. You can edit what u wish. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.
                                </div>
                            </div> -->
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
                                                <th>ID Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Game</th>
                                                <th>Produk</th>
                                                <th>Akun</th>
                                                <th>Zona/Server</th>
                                                <th>Payment</th>
                                                <th>P/R</th>
                                                <th>Harga</th>
                                                <th>Nama</th>
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
        <!-- <input type="button" value="PLAY" onclick="play()"> -->
        <audio id="audio" src="https://www.tokopetanionline.com/assets/notification.mp3"></audio>
        <!-- <div id="modalform" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <form action=""  enctype="multipart/form-data" id="formInput" method="POST" class="form-horizontal" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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
        </div> -->
        <div id="modalformKirim" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <form action=""  enctype="multipart/form-data" id="formInputKirim" method="POST" class="form-horizontal" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label>Kurir</label>
                            <select class="form-control" name="kurir" id="kurir"required >
                                <option value="">Kurir</option>
                                <option value="JNE">JNE</option>
                                <option value="TIKI">TIKI </option>
                                <option value="POS">POS </option>
                            </select>
                        </div>
                        <div>
                            <label>Nomor Resi</label>
                            <input type="text" name="noresi" id="noresi" class="form-control"  required />
                        </div>
                        <input type="text" name="id" id="id" class="form-control"  />
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
    <script>
        // const myTimeout = setInterval(myGreeting, 10000);
        // function myGreeting() {
        //     // var html =;
        //     $.ajax({
        //         type: "POST",
        //         url: '<?php  echo base_url(); ?>transpayment/notification',
        //         dataType:'json',
        //         success: function(data) {
        //             $("#rownotif").html("");

        //             $.each(data.datanotif,function(i,v){
        //                 console.log(v.kode_trans);    
        //                 // audionotif();
        //                 $("#rownotif").append('<div class="col-lg-12 col-md-12" id="divsuccesss">'+
        //                 '<div class="alert alert-success">'+
        //                     // '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'+
        //                     ' <h3 class="text-success" o><i class="fa fa-check-circle"></i> Transaksi baru</h3>Terdapat transaksi sukses melakukan pembayaran dengan kode:'+v.kode_trans+'<br><a href="<?php echo base_url();?>transaksi/detailtransaksi/'+v.idtrans+'" class="btn btn-sm btn-success"> Lihat Detail</a>&nbsp;<button onclick="hapusnotif('+v.id+')" class="btn btn-sm btn-warning"> Hapus Notifikasi</button>'+
        //                 '</div>'+
        //             '</div>');
        //             });
        //             // var count = data.jumlahnotif;
        //             // for(var i = 1; i <= count; i++) {
        //             //     $("#rownotif").append('<div class="col-lg-12 col-md-12" id="divsuccesss">'+
        //             //     '<div class="alert alert-success">'+
        //             //         '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'+
        //             //         ' <h3 class="text-success" o><i class="fa fa-check-circle"></i> Transaksi Baru</h3> This is an example top alert. You can edit what u wish. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.'+
        //             //     '</div>'+
        //             // '</div>');
        //             // }
                   
        //             // console.log(data.jumlahnotif);
        //             // console.log(data);
        //         }
        //     });
        // }
        // function audionotif()
        // {
        //     var audio = document.getElementById("audio");
        //     audio.play();
        // }
    </script>
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
      	function selesaiTransKategori(trans_id)
      	{
            $("#modalformKirim").find('.modal-title').text('Kirim Barang');
        	$("#modalformKirim").modal();
            $("#id").val(trans_id);
        }
        function hapusnotif(id)
        {
            $.ajax({
                url: "<?php  echo base_url(); ?>transaksi/hapusnotif",
                type: "POST",
                data:{id:id},
              dataType:'json',
                success: function(data){
                    if(data.hasil==1){
                        Swal.fire({
                            icon: 'success',
                            title: "Notifikasi dihapus",
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
                    myGreeting();
                    refreshData();
                }   
            });
        }
        $(function () {
            $('#formInputKirim').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php  echo base_url(); ?>transaksi/selesaikirim",
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
                        $("#modalformKirim").modal('hide');
                    }   
                });
            });
        });
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
                        timer: 1000,
                    }).then((result)=>{
                        let timerInterval
                        Swal.fire({
                            title: 'Proses kirim email',
                            timer: 6000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                $.ajax({
                                    type: "POST",
                                    url: '<?php  echo base_url(); ?>transaksi/kirimemail/',
                                    data:{
                                        email:data.email,
                                        message:data.message
                                    },
                                    dataType:'json',
                                    success: function(data) {
                                    }
                                });
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        });
                    });
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
        function errorTrans(trans_id)
        {
            // alert("Masih tahap pengembangan");
            $.ajax({
                type: "POST",
                url: '<?php  echo base_url(); ?>transaksi/errortrans',
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
                            timer: 1000,
                        });
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
        function selesaiTransVoucher(trans_id)
        {
            $.ajax({
                type: "POST",
                url: '<?php  echo base_url(); ?>transaksi/selesaitransvoucher',
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
                        title: 'Update Transaksi Gagal, stok voucher tidak cukup',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
                refreshData();
              }
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
        function showData(){
            if ($.fn.DataTable.isDataTable('#tabletransaksi') ) {
                table.DataTable().destroy();
            }
            dttable = table.DataTable({
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                dom: 'Blfrtip',
                buttons: ['excel'
                    // {
                    //     extend: 'excel',
                    //     text: '<span class="fa fa-file-excel-o"></span> Excel Export',
                    //     exportOptions: {
                    //         modifier: {
                    //             search: 'applied',
                    //             order: 'applied',
                    //             page:'all',
                    //         }
                    //     }
                    // },
                    // {
                    //     extend: 'pageLength',
                    // }
                ],
            //   responsive: true,
                retrieve: true,
                paging: true,
                scrollX: true,
                ordering: true,
                processing: true, //Feature control the processing indicator.
                serverSide: true, //Feature control DataTables' server-side processing mode.
                order: [1,"DESC"],
                ajax: {
                    url: "<?php echo site_url('transaksi/datalist')?>",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": true, //set not orderable
                },],
            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info mr-1');
        }
        // function tambahdata(){
        //     modal.find('.modal-title').text('Tambah Data');
        //     modal.modal();
        //     resetform();
        // }
        // function editData(id){
        //     modal.find('.modal-title').text('Edit Data');
        //     modal.modal();
        //     $.ajax({
        //         type: "POST",
        //         url: '<?php  echo base_url(); ?>game/datadetail',
        //         data:{
        //         id:id
        //       },
        //       dataType:'json',
        //       success: function(data) {
        //         $.each(data.hasildata,function(i,v){
        //             $('#id').val(v.idgame);
        //             $('#nama').val(v.nama);
        //             $('#desk').val(v.desk);
        //             $('#playstore').val(v.playstore);
        //             $('#appstore').val(v.appstore);
        //             $('#akunid_status').val(v.akunid_status);
        //             $('#akunid_label').val(v.akunid_label);
        //             $('#akunid_jenis').val(v.akunid_jenis);
        //             $('#zona_status').val(v.zona_status);
        //             $('#zona_label').val(v.zona_label);
        //             $('#zona_jenis').val(v.zona_jenis);
        //             $('#server_status').val(v.server_status);
        //             $('#server_label').val(v.server_label);
        //             $('#server_jenis').val(v.server_jenis);
        //             if(v.icon!=""){
        //                 $("#imgicon").attr('src','<?php echo base_url();?>assets/image/'+v.icon);
        //             }
        //             if(v.gambar!=""){
        //                 $("#imggambar").attr('src','<?php echo base_url();?>assets/image/'+v.gambar);
        //             }
        //         });
        //       }
        //     });
        // }
        // modal.on('hidden.bs.modal', function () {
        //     resetform();
        // });
        // function hapusData(id){
        //     $("#id_data_hapus").val(id);
        //     $("#modalHapusData").modal();
        // }
        // function hapus(){
        //     var id = $("#id_data_hapus").val();
        //     $.ajax({
        //         url: "<?php  echo base_url(); ?>game/datahapus",
        //         type: "POST",
        //         data:  {id,id},
        //         dataType:'json', 
        //         success: function(data)
        //         {
        //             if(data.hasil==1){
        //                 Swal.fire({
        //                     icon: 'success',
        //                     title: data.pesan,
        //                     showConfirmButton: false,
        //                     timer: 1000
        //                 })
        //             }else{
        //                 Swal.fire({
        //                     icon: 'warning',
        //                     title: data.pesan,
        //                     showConfirmButton: false,
        //                     timer: 1000
        //                 })
        //             }
        //             refreshData();
        //             $('#modalHapusData').modal('hide');
        //             $('#id_data_hapus').val("");
        //         }         
        //     });
        // }
        // $(function () {
        //     $('#formInput').on('submit', function (e) {
        //         e.preventDefault();
        //         $.ajax({
        //             url: "<?php  echo base_url(); ?>game/datasimpan",
        //             type: "POST",
        //             data:  new FormData(this),
        //             contentType: false,
        //             cache: false,
        //             processData:false,
        //             dataType:'json', 
        //             success: function(data){
        //                 if(data.hasil==1){
        //                     Swal.fire({
        //                         icon: 'success',
        //                         title: data.pesan,
        //                         showConfirmButton: false,
        //                         timer: 1000
        //                     })
        //                 }else{
        //                     Swal.fire({
        //                         icon: 'warning',
        //                         title: data.pesan,
        //                         showConfirmButton: false,
        //                         timer: 1000
        //                     })
        //                 }
        //                 resetform();
        //                 refreshData();
        //                 modal.modal('hide');
        //             }   
        //         });
        //     });
        // });
    </script>
</body>

</html>