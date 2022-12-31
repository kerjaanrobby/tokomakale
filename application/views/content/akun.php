<?php echo $head;?>
        <div class="page-wrapper">
            <div class="container m-b-30">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Profil Akun</h4>
                    </div>
                </div>
                <?php foreach($akun as $a){?>
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body text-center">
                            <input type="hidden" value="<?php echo $a->iduser;?>" name="idusers" id="idusers"/>
                                <h4 class="card-title m-t-10"><?php echo $a->nama;?></h4>
                                <?php if($a->level=="Reseller"){?>
                                    <h6 class="card-subtitle"><?php echo $a->level;?></h6>
                                <?php } else if($a->level=="VVIP"){?>
                                    <h6 class="card-subtitle"><?php echo $a->level;?></h6>
                                <?php } ?>
                                
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?php echo $a->email;?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?php echo $a->nowa;?></h6> 
                            </div>
                            <a href="javascript:logout();" class="btn btn-block btn-info" style="background-color: #FF8C32;border-color: #FF8C32;">Keluar</a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <?php echo $menuakun;?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php echo $footer;?>

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
    <script src="<?php echo base_url();?>assets/theme/assets/node_modules/typeahead.js-master/dist/typeahead.bundle.min.js"></script>
        <script>
        $(document).ready(function(){
            var sample_data = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch:'<?php echo base_url(); ?>home/datagamelist',
                remote:{
                    url:'<?php echo base_url(); ?>home/datagamelist/%QUERY',
                    wildcard:'%QUERY'
                }
            });
            

            $('#prefetch .typeahead').typeahead(null, {
                name: 'sample_data',
                display: 'nama',
                source:sample_data,
                limit:10,
                templates:{
                    
                    suggestion:Handlebars.compile('<div onclick="direct({{idgame}})" class="row"><div class="col-md-2" style=""><img src="<?php echo base_url();?>/assets/image/{{icon}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="margin-top:-8px;"><br><h4>{{nama}}</h4></div></div>')
                }
            });
        });
        function direct(idgame)
        {
            location.href='<?php echo base_url();?>shop/game/'+idgame;
        }
    </script>
        <script>

            var table = $("#tabletopup");
            var tabletarik = $("#tabletarik");
            var tablehistory = $("#tablehistory");
            var tabletrans = $("#tabletransaksi");
            var tablereward = $("#tablereward");
            var tableredeem = $("#tableredeem");
            function logout(){
                Swal.fire({
                    title: 'Yakin ingin keluar?',
                    showCancelButton: true,
                    confirmButtonText: `Ya`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = "<?php echo base_url(); ?>home/logoutuser";
                    }
                })
            }
            function pilireward(idreward,nilai)
            {
                var nilaiuser = $("#jumlahpoint").text();
                if(nilaiuser>=nilai){
                    Swal.fire({
                    title: 'Yakin ingin memilih item ini?',
                    showCancelButton: true,
                    confirmButtonText: `Ya`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $.ajax({
                                type:"POST",
                                url:"<?php echo base_url();?>rewardpoint/tukarreward",
                                data:{
                                    iduser:$("#iduser").val(),
                                    idreward:idreward,
                                    nilai:nilai
                                },
                                dataType:'json',
                                success: function(data) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Order sudah masuk kedalam sistem',
                                        showConfirmButton: true,
                                    }).then(function(){
                                        window.location.href="point";
                                    });
                                }
                            })
                        }
                    })
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mohon maaf point anda tidak cukup',
                        showConfirmButton: true
                    })
                }
                
            }
            $(function() {
                var persenfee="";
                var idpayment="";
                $('#payment').on('change', function(){
                    var selected = $(this).find('option:selected');
                    var extra = selected.data('foo'); 
                    var extraid = selected.data('idpay');
                    persenfee = extra;
                    idpayment = extraid;
                });
                $('#formtopup').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>user/statustopup",
                        data:{
                            iduser:$("#iduser").val()
                        },
                        mimeType: 'multipart/form-data',
                        dataType:'json',
                        success: function(data) {
                            if(data.hasil==1){
                                var payment=$("#payment").val();
                                var paymentname = $("#payment option:selected").text();
                                if(payment=="Ipaymu")
                                {
                                    var nominal = 0;
                                    var persen = 0;
                                    var total = 0;
                                    nominal=Number($("#nominal").val());
                                    persen =Number(nominal*persenfee/100);
                                    total =nominal+persen;
                                    var email =$("#email").val();
                                    var htmltext = '<p> Email : ' +email+'<br>'+
                                        'Harga : Rp' +number_format(total)+'<br>'+
                                        'Bayar dengan : '+paymentname+'<br>';

                                        Swal.fire({
                                            title: 'Detail Topup',
                                            text: "Klik konfrim jika detail topup sudah sesuai",
                                            icon: 'info',
                                            html: htmltext,
                                            showCancelButton: true,
                                            confirmButtonText: 'Konfirm'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.ajax({
                                                    type:"POST",
                                                    url:"<?php echo base_url();?>Transpayment/ipaymutopup",
                                                    data:{
                                                        iduser:$("#iduser").val(),
                                                        name:$("#nama").val(),
                                                        phone:$("#phone").val(),
                                                        email:$("#email").val(),
                                                        payment:idpayment,
                                                        fee:persen,
                                                        nominal:total,
                                                    },
                                                    mimeType: 'multipart/form-data',
                                                    dataType:'json',
                                                    success: function(data) {
                                                        console.log(data[0].QrTemplate);
                                                        urlpayment=data[0].QrTemplate;
                                                        if(data[0].pesan=="success")
                                                        {
                                                            Swal.fire({
                                                                icon: 'success',
                                                                title: 'Top Up sudah masuk kedalam sistem silahkan lakukan pembayaran',
                                                                showConfirmButton: true,
                                                                confirmButtonText:'Lanjutkan Pembayaran',
                                                            }).then(function(){
                                                                window.open(
                                                                    data[0].linkpayment,
                                                                    '_blank' // <- This is what makes it open in a new window.
                                                                );
                                                                window.location.href = "https://www.tokopetanionline.com/invoice/sendEmailInvoiceTopUp/"+data[0].kode;
                                                            });
                                                        }
                                                    }
                                                })
                                            }
                                        });
                                }else if(payment=="Cek Mutasi")
                                {
                                    $.ajax({
                                        type:"POST",
                                        url:"<?php echo base_url();?>transpayment/cekmutasitopup",
                                        data:{
                                            iduser:$("#iduser").val(),
                                            name:$("#nama").val(),
                                            phone:$("#phone").val(),
                                            email:$("#email").val(),
                                            nominal:$("#nominal").val(),
                                            payment:idpayment,
                                            fee:persen,
                                        },
                                        mimeType: 'multipart/form-data',
                                        dataType:'json',
                                        success: function(data) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Top Up sudah masuk kedalam sistem silahkan lakukan pembayaran',
                                                showConfirmButton: true,
                                                confirmButtonText:'Lanjutkan pembayaran',
                                            }).then(function(){
                                                window.location.href = "https://www.tokopetanionline.com/invoice/sendEmailInvoiceTopUp/"+data[0].kodetrans;
                                                // window.location.href = "/shop/invoice_topup/"+data[0].kodetrans;
                                            });
                                        }
                                    });
                                }else if(payment=="Manual")
                                {
                                    $.ajax({
                                        type:"POST",
                                        url:"<?php echo base_url();?>transpayment/manualtopup",
                                        data:{
                                            iduser:$("#iduser").val(),
                                            name:$("#nama").val(),
                                            phone:$("#phone").val(),
                                            email:$("#email").val(),
                                            nominal:$("#nominal").val(),
                                            payment:idpayment,
                                            fee:persen,
                                        },
                                        mimeType: 'multipart/form-data',
                                        dataType:'json',
                                        success: function(data) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Top Up sudah masuk kedalam sistem silahkan lakukan pembayaran',
                                                showConfirmButton: true,
                                                confirmButtonText:'Lanjutkan pembayaran',
                                            }).then(function(){
                                                window.location.href = "https://www.tokopetanionline.com/invoice/sendEmailInvoiceTopUp/"+data[0].kodetrans;
                                                // window.location.href = "/shop/invoice_topup/"+data[0].kodetrans;
                                            });
                                        }
                                    });
                                }
                                // if(payment=="gopay"){ paymentname="GoPay";
                                // }else if(payment=="bri"){ paymentname="BRI";
                                // }else if(payment=="bca"){ paymentname="BCA";
                                // }else if(payment=="dana"){ paymentname="Dana";
                                // }else if(payment=="ovo"){ paymentname="Ovo";
                                // }else if(payment=="linkaja"){ paymentname="Link Aja";
                                // }else if(payment=="alfamart"){ paymentname="Alfamart";
                                // }else if(payment=="indomaret"){ paymentname="Indomaret"; };
                                // if((payment=="linkaja")||(payment=="gopay")||(payment=="dana")||(payment=="ovo"))
                                // {
                                //     var nominal = 0;
                                //     var persen = 0;
                                //     var total = 0;
                                //     nominal=Number($("#nominal").val());
                                //     persen =Number(nominal*persenfee/100);
                                //     total =nominal+persen;
                                //     var email =$("#email").val();
                                //     var htmltext = '<p> Email : ' +email+'<br>'+
                                //         'Harga : Rp' +number_format(total)+'<br>'+
                                //         'Bayar dengan : '+paymentname+'<br>';
                                    
                                //     Swal.fire({
                                //         title: 'Detail Topup',
                                //         text: "Klik konfrim jika detail topup sudah sesuai",
                                //         icon: 'info',
                                //         html: htmltext,
                                //         showCancelButton: true,
                                //         confirmButtonText: 'Konfirm'
                                //     }).then((result) => {
                                //         if (result.isConfirmed) {
                                //             $.ajax({
                                //                 type:"POST",
                                //                 url:"<?php echo base_url();?>user/topupqris",
                                //                 data:{
                                //                     iduser:$("#iduser").val(),
                                //                     name:$("#nama").val(),
                                //                     phone:$("#phone").val(),
                                //                     email:$("#email").val(),
                                //                     fee:persen,
                                //                     nominal:total,
                                //                 },
                                //                 mimeType: 'multipart/form-data',
                                //                 dataType:'json',
                                //                 success: function(data) {
                                //                     urlpayment=data[0].QrTemplate;
                                //                     if(data[0].pesan=="success")
                                //                     {
                                //                         Swal.fire({
                                //                             icon: 'success',
                                //                             title: 'Top Up sudah masuk kedalam sistem silahkan lakukan pembayaran',
                                //                             showConfirmButton: true,
                                //                             confirmButtonText:'Lanjutkan Pembayaran',
                                //                         }).then(function(){
                                //                             window.location.href = urlpayment;
                                //                         });
                                //                     }
                                //                 }
                                //             })
                                //         }
                                //     });

                                    
                                // }else if((payment=="bri")||(payment=="bca")){
                                //     $.ajax({
                                //         type:"POST",
                                //         url:"<?php echo base_url();?>transaksi/topupbri",
                                //         data:{
                                //             iduser:$("#iduser").val(),
                                //             email:$("#email").val(),
                                //             nominal:$("#nominal").val()
                                //         },
                                //         mimeType: 'multipart/form-data',
                                //         dataType:'json',
                                //         success: function(data) {
                                //             Swal.fire({
                                //                 icon: 'success',
                                //                 title: 'Order sudah masuk kedalam sistem',
                                //                 html: '<p style="text-align:left;">Detail transaksi : <br>Jumlah Top up : Rp.'+number_format(data[0].harga)+'<br>Kode Unik    : Rp.'+data[0].kodeunik+'<br>Total Bayar  : <b>Rp.'+number_format(data[0].total)+'</b></p>',
                                //                 showConfirmButton: true,
                                //                 confirmButtonText:'Lanjutkan pembayaran',
                                //             }).then(function(){
                                //                 window.location.href="/shop/invoice_topup/"+data[0].kodetrans;
                                //             });
                                //         }
                                //     })
                                // }else if((payment=="alfamart")||(payment=="indomaret")){
                                //     var unotifystore = "<?php echo base_url();?>/user/unotifycstore";
                                //     var nominal = 0;
                                //     var persen = 0;
                                //     var total = 0;
                                //     nominal=Number($("#nominal").val());
                                //     persen =Number(nominal*persenfee/100);
                                //     total =nominal+persen;
                                //     var email =$("#email").val();
                                //     var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';

                                //     $.ajax({
                                //         type:"POST",
                                //         url:"<?php echo base_url();?>user/topupstore",
                                //         data:{
                                //             payment:payment,
                                //             iduser:$("#iduser").val(),
                                //             name:$("#nama").val(),
                                //             phone:"089601908822",
                                //             email:$("#email").val(),
                                //             fee:persen,
                                //             notifyUrl:unotifystore,
                                //             amount:total,
                                //         },
                                //         beforeSend: function() {
                                //             swal.fire({
                                //                 html: '<h5>Loading...</h5>',
                                //                 showConfirmButton: false,
                                //                 onRender: function() {
                                //                     // there will only ever be one sweet alert open.
                                //                     $('.swal2-content').prepend(sweet_loader);
                                //                 }
                                //             });
                                //         },
                                //         mimeType: 'multipart/form-data',
                                //         dataType:'json',
                                //         success: function(data) {
                                //             Swal.fire({
                                //                 icon: 'success',
                                //                 title: 'Order sudah masuk kedalam sistem',
                                //                 html: '<p style="text-align:left;">Detail transaksi : <br>Harga Produk : Rp.'+number_format(data[0].hargaproduk)+'<br>Fee    : Rp.'+data[0].fee+'<br>Total Bayar  : <b>Rp.'+number_format(data[0].harga)+'</b></p>',
                                //                 showConfirmButton: true,
                                //                 confirmButtonText:'Lanjutkan pembayaran',
                                //             }).then(function(){
                                //                 window.location.href = "/shop/invoice_topup_retail/"+data[0].referenceid;
                                //             });
                                //         }
                                //     })
                                // }
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: data.pesan,
                                    showConfirmButton: true
                                })
                            }
                        }
                    })
                    
                });
                $('#formtarik').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "<?php  echo base_url(); ?>user/tarikproses",
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
                                }).then(function(){
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: data.pesan,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(function(){
                                    window.location.reload();
                                });
                            }
                        }   
                    });
                });
                $('#formakun').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "<?php  echo base_url(); ?>user/updateakun",
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
                                }).then(function(){
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: data.pesan,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(function(){
                                    window.location.reload();
                                });
                            }
                        }   
                    });
                });
                $("#nominal").on('input', function(){
                    var nominal = this.value;
                    // if(nominal<30000)
                    // {
                    //     document.getElementById("btnTopUp").disabled=true;
                    // }else{

                    //     document.getElementById("btnTopUp").disabled=false;
                    // }
                });
                $("#nominaltarik").on('input', function(){
                    var nominal = this.value;
                    var saldo = <?php echo $a->saldo;?>;
                    if(nominal>saldo)
                    {
                        document.getElementById("brnTarik").disabled=true;
                    }else{

                        document.getElementById("brnTarik").disabled=false;
                    }
                });
                $("#password").on('input',function(){
                    var pass = this.value;
                    var repass = $("#repassword").val();
                    if(pass!=repass)
                    {
                        document.getElementById("btnUpdate").disabled=true;
                        document.getElementById("warningpasswd").style.display="unset";
                        document.getElementById("warningrepasswd").style.display="unset";
                        
                    }else{
                        document.getElementById("btnUpdate").disabled = false;
                        document.getElementById("warningpasswd").style.display="none";
                        document.getElementById("warningrepasswd").style.display="none";

                    }
                });
                $("#repassword").on('input',function(){
                    var repass = this.value;
                    var pass = $("#password").val();
                    if(pass!=repass)
                    {
                        document.getElementById("btnUpdate").disabled=true;
                        document.getElementById("warningpasswd").style.display="unset";
                        document.getElementById("warningrepasswd").style.display="unset";
                        
                    }else{
                        document.getElementById("btnUpdate").disabled = false;
                        document.getElementById("warningpasswd").style.display="none";
                        document.getElementById("warningrepasswd").style.display="none";

                    }
                });

            });
            $(function () {
                showData();
                showDataHistory();
               // showDataTarik();
                showDataReward();
                showDataDetail();
                showDataTransReward();
                
            });
            function showData(){
                var iduser = $("#idusers").val();
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
                    url: "<?php echo site_url('user/datatopup')?>",
                    type: "POST",
                    data:{iduser:iduser},
                },
                "columnDefs": [{
                "targets": [ 0 ], //first column / numbering column
                "orderable": true, //set not orderable
                },],
                });
            }
            function showDataTarik(){
                var iduser = $("#idusers").val();
                if ($.fn.DataTable.isDataTable('#tabletarik') ) {
                    tabletarik.DataTable().destroy();
                }
                dttable = tabletarik.DataTable({
                responsive: true,
                retrieve: true,
                paging: true,
                scrollX: true,
                processing: true, //Feature control the processing indicator.
                serverSide: true, //Feature control DataTables' server-side processing mode.
                order: [],
                ajax: {
                    url: "<?php echo site_url('user/datatarik')?>",
                    type: "POST",
                    data:{iduser:iduser},
                },
                "columnDefs": [{
                "targets": [ 0 ], //first column / numbering column
                "orderable": true, //set not orderable
                },],
                });
            }
            function showDataHistory(){
                var iduser = $("#idusers").val();
                if ($.fn.DataTable.isDataTable('#tablehistory') ) {
                    tablehistory.DataTable().destroy();
                }
                dttable = tablehistory.DataTable({
                responsive: true,
                retrieve: true,
                paging: true,
                scrollX: true,
                processing: true, //Feature control the processing indicator.
                serverSide: true, //Feature control DataTables' server-side processing mode.
                order: [1,"DESC"],
                ajax: {
                    url: "<?php echo site_url('user/datahistory')?>",
                    type: "POST",
                    data:{iduser:iduser},
                },
                "columnDefs": [{
                "targets": [ 0 ], //first column / numbering column
                "orderable": true, //set not orderable
                },],
                });
            }
            function showDataDetail(){
                if ($.fn.DataTable.isDataTable('#tabletransaksi') ) {
                    tabletrans.DataTable().destroy();
                }
                dttable = tabletrans.DataTable({
                responsive: true,
                retrieve: true,
                paging: true,
                scrollX: true,
                processing: true, //Feature control the processing indicator.
                serverSide: true, //Feature control DataTables' server-side processing mode.
                order: [],
                ajax: {
                    url: "<?php echo site_url('transaksi/datalistpayment')?>",
                    type: "POST",
                    data:{
                        id:$("#idtrans").val(),
                    }
                },
                "columnDefs": [{
                "targets": [ 0 ], //first column / numbering column
                "orderable": true, //set not orderable
                },],
                });
                $.ajax({
                    type: "POST",
                    url: '<?php  echo base_url(); ?>transaksi/datadetailtransaksi',
                    data:{
                    id:$("#idtrans").val(),
                },
                dataType:'json',
                success: function(data) {
                    $.each(data.hasildata,function(i,v){
                        $('#akun').val(v.akun);
                        $('#zone').val(v.zone);
                        $('#server').val(v.server);
                        $('#game').val(v.gamename);
                        $('#nominal').val(v.productname);
                        $('#harga').val(number_format(v.harga));
                        $('#trx_id').val(v.trx_id);
                        $('#email').val(v.email);
                        $('#payment').val(v.payment);
                        $('#admin').val(v.namaadmin);
                    });
                }
                });
            }
            function showDataReward(){
                var iduser = $("#idusers").val();
                if ($.fn.DataTable.isDataTable('#tablereward') ) {
                    tablereward.DataTable().destroy();
                }
                dttable = tablereward.DataTable({
                responsive: true,
                retrieve: true,
                paging: true,
                scrollX: true,
                processing: true, //Feature control the processing indicator.
                serverSide: true, //Feature control DataTables' server-side processing mode.
                order: [],
                ajax: {
                    url: "<?php echo site_url('rewardpoint/datareward')?>",
                    type: "POST",
                },
                "columnDefs": [{
                "targets": [ 0 ], //first column / numbering column
                "orderable": true, //set not orderable
                },],
                });
            }
            function showDataTransReward(){
                var iduser = $("#idusers").val();
                if ($.fn.DataTable.isDataTable('#tableredeem') ) {
                    tableredeem.DataTable().destroy();
                }
                dttable = tableredeem.DataTable({
                responsive: true,
                retrieve: true,
                paging: true,
                scrollX: true,
                processing: true, //Feature control the processing indicator.
                serverSide: true, //Feature control DataTables' server-side processing mode.
                order: [],
                ajax: {
                    url: "<?php echo site_url('transaksireward/datalistuser')?>",
                    type: "POST",
                },
                "columnDefs": [{
                "targets": [ 0 ], //first column / numbering column
                "orderable": true, //set not orderable
                },],
                });
            }
        </script>