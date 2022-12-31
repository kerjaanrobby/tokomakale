<?php echo $head;?>
            <div class="page-wrapper" style="margin-top:-50px;">
                <?php foreach($game as $g){?>
                <div class="row" id="choose-demo">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <h3 class=""><b><?php echo $g->nama;?></b></h3>
                                <h6 class="card-subtitle">&nbsp;</h6>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="white-box text-center"> <img src="<?php echo base_url().'/assets/image/'.$g->gambar;?>" class="img-responsive"> </div>
                                        <br>
                                        <h4 class="box-title">Detail Game</h4>
                                        <p><?php echo $g->desk;?></p>
                                        <a target="_blank" href="/<?php echo $g->appstore;?>"><img src="<?php echo base_url().'assets/image/app_store.png';?>" width="100"/></a>
                                        <a target="_blank" href="/<?php echo $g->playstore;?>"><img src="<?php echo base_url().'assets/image/google_play.png';?>" width="100"/></a>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-6">
                                        <form id="formfield">
                                            <div class="card">
                                                <div class="card-header" style="background-color: #1d6294;color: #fff;">
                                                    <h4 class="box-title"><b>1.Isi Informasi Akun</b></h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                    
                                                        <?php if($g->akunid_status=="Aktif"){?>
                                                            <div class="col-sm-6">
                                                                <label><?php echo $g->akunid_label;?></label>
                                                                <?php if($g->akunid_jenis=="Optional"){?>
                                                                <select class="form-control"  name="akunid" id="akunid"></select>
                                                                <?php } else {?>
                                                                <input type="text" class="form-control" name="akunid" id="akunid">
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>

                                                        <?php if($g->zona_status=="Aktif"){?>
                                                            <div class="col-sm-6">
                                                                <label><?php echo $g->zona_label;?></label>
                                                                <?php if($g->zona_jenis=="Optional"){?>
                                                                <select class="form-control"  name="zona" id="zona"></select>
                                                                <?php } else {?>
                                                                <input type="text" class="form-control" name="zona" id="zona">
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>

                                                        <?php if($g->server_status=="Aktif"){?>
                                                            <div class="col-sm-6">
                                                                <label><?php echo $g->server_label;?></label>
                                                                <?php if($g->server_jenis=="Optional"){?>
                                                                <select class="form-control"  name="server" id="server"></select>
                                                                <?php } else {?>
                                                                <input type="text" class="form-control" name="server" id="server">
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="card">         
                                                <div class="card-header" style="background-color: #ff9f08;color: #fff;">
                                                    <h4 class="box-title"><b>2.Pilih Nominal Top Up</b></h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                    <?php foreach($product as $p){?>
                                                        <div class="col-sm-4" style="margin-bottom:5px;" onclick="pilihNominal('<?php echo $p->nama;?>',<?php echo $p->harga_jual;?>)">
                                                            <div class="card">
                                                                
                                                                <div class="card-product" id="card-product<?php echo $p->idproduct;?>" onclick="pilihproduct(<?php echo $p->idproduct;?>)">
                                                                <div class="card-body text-center">
                                                                    <?php echo $p->nama;?>
                                                                </div>
                                                                <!-- <button type="button" onclick="pilihNominal(<?php echo $p->nama;?>,<?php echo $p->harga_jual;?>)" class="btn btn-sm btn-block btn-primary"> Pilih</button> -->
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="card">         
                                                <div class="card-header" style="background-color: #ff9f08;color: #fff;">
                                                    <h4 class="box-title"><b>3.Pilih Metode Pembayaran</b></h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                    <?php foreach($payment as $pay){?>
                                                        <div class="col-sm-12">
                                                            <div class="card" >
                                                                <div class="card-pay" id="card-pay<?php echo $pay->kode;?>">
                                                                <a class="card-body stretched-link text-decoration-none" href="javascript:pilihpayment('<?php echo $pay->kode;?>');">
                                                                    <div class="row">
                                                                        <div class="col-sm-9">
                                                                            <img src="<?php echo base_url();?>assets/image/payment/<?php echo $pay->logo;?>" width="100"/>
                                                                        </div>
                                                                        <div class="col-sm-3 text-left">
                                                                            <span class="text-left" id="hargalabel<?php echo $pay->kode;?>" style="display:none;">Harga</span><br>
                                                                            <span class="text-left" id="harga-<?php echo $pay->kode;?>"><b></b></span>
                                                                            <span class="text-left" style="display:none;" id="harganum-<?php echo $pay->kode;?>"><b></b></span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <?php echo $pay->nama;?> -->
                                                                </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        &nbsp;
                                                    <?php }?>
                                                    </div>
                                                    <input type="hidden" id="harga" name="harga" />
                                                    <input type="hidden" id="payment" name="payment"/>
                                                    <input type="hidden" id="product" name="product"/>
                                                    <input type="hidden" id="idgame" name="idgame" value="<?php echo $g->idgame;?>"/>
                                                    <input type="hidden" id="idproduct" name="idproduct"/>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="card">         
                                                <div class="card-header">
                                                    <h4 class="box-title"><b>4.Beli !</b></h4>
                                                </div>
                                                <div class="card-body">
                                                    <p>Optional: Jika anda ingin mendapatkan bukti pembayaran atas pembelian anda, harap mengisi alamat emailnya</p>
                                                    <div class="form-group">
                                                        <label>Alamat Email</label>
                                                        <input type="text" class="form-control" name="email" id="email">
                                                    </div>
                                                </div>
                                                <button class="btn btn-lg btn-primary" type="submit"> Beli Sekarang</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <br>
                <?php }?>
                
        <?php echo $footer;?>
        <script>
            function pilihNominal(product,harga)
            {
                <?php foreach($payment as $pay){?>
                var fee = <?php echo $pay->fee;?>;
                var persenfee = harga*fee/100;
                hargaakhir = harga+persenfee;
                document.getElementById("hargalabel<?php echo $pay->kode;?>").style="display:unset;";
                document.getElementById("harga-<?php echo $pay->kode;?>").textContent="Rp. "+number_format(hargaakhir);
                document.getElementById("harganum-<?php echo $pay->kode;?>").textContent=hargaakhir;

                $("#product").val(product);
                <?php }?>
                
            }
            function pilihproduct(idproduct)
            {
                var card = document.getElementsByClassName("card-product");
                changeColor(card, '#fff');
                document.getElementById("card-product"+idproduct).style.background="#ff9f08";
                $("#idproduct").val(idproduct);
            }
            function pilihpayment(kodepayment)
            {
                var card = document.getElementsByClassName("card-pay");
                changeColor(card, '#fff');
                document.getElementById("card-pay"+kodepayment).style.background="#e9ecef";
                var harga = document.getElementById("harganum-"+kodepayment).textContent;
                $("#harga").val(harga);
                $("#payment").val(kodepayment);
            }
            function changeColor(coll, color){

                for(var i=0, len=coll.length; i<len; i++)
                {
                    coll[i].style["background-color"] = color;
                }
            }
            $(function(){
                $('#formfield').on('submit', function (e) {
                    e.preventDefault();
                    var harga = $("#harga").val();
                    var product = $("#product").val();
                    var unotify = "<?php echo base_url();?>/transaksi/unotify";
                    var buyer_name = $("#akunid").val();
                    var buyer_email = $("#email").val();
                    var buyer_phone = "0";
                    var payment = $("#payment").val();
                    var paymentname="";
                    var zone="";
                    var server="";
                        zone = $("#zona").val();
                        server = $("#server").val();
                    if(payment=="gopay"){ paymentname="GoPay";
                    }else if(payment=="dana"){ paymentname="Dana";
                    }else if(payment=="ovo"){ paymentname="Ovo";
                    }else if(payment=="alfamart"){ paymentname="Alfamart";
                    }else if(payment=="indomaret"){ paymentname="Indomaret"; };
                    if(buyer_name!=""){ akunidtemp = 'ID :'+ buyer_name+'<br>'; }else{ akunidtemp=""; }; 
                    if(typeof zone!=="undefined"){ zonetemp = 'Zone :'+ zone+'<br>'; }else{ zonetemp=""; }; 
                    if(typeof server!=="undefined"){ servertemp = 'Server :'+ server+'<br>'; }else{ servertemp=""; }; 
                    var htmltext = '<p>' +akunidtemp+' '+zonetemp+' '+servertemp+
                            'Harga : Rp' +number_format(harga)+'<br>'+
                            'Bayar dengan : '+paymentname+'<br>';
                    Swal.fire({
                        title: 'Detail Pembelian',
                        text: "Klik konfrim jika detail pembelian sudah sesuai",
                        icon: 'info',
                        html: htmltext,
                        showCancelButton: true,
                        confirmButtonText: 'Konfirm'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if((payment=="gopay")||(payment=="dana")||(payment=="ovo")||(payment=="linkaja"))
                            { 
                                $.ajax({
                                    type:"POST",
                                    url:"<?php echo base_url();?>transaksi/qris",
                                    data:{
                                        name:buyer_name,
                                        phone:buyer_phone,
                                        email:buyer_email,
                                        amount:harga,
                                        notifyUrl:unotify,
                                        idgame:$("#idgame").val(),
                                        idproduct:$("#idproduct").val(),
                                        akun:$("#akunid").val(),
                                        zone:$("#zona").val(),
                                        server:$("#server").val(),
                                    },
                                    mimeType: 'multipart/form-data',
                                    dataType:'json',
                                    success: function(data) {
                                        urlpayment=data[0].QrTemplate;
                                        if(data[0].pesan=="success")
                                        {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Order sudah masuk kedalam sistem silahkan lakukan pembayaran',
                                                showConfirmButton: true,
                                                confirmButtonText:'Lanjutkan Pembayaran',
                                            }).then(function(){
                                                window.location.href = urlpayment;
                                            });
                                        }
                                    
                                    }
                                })
                            }else if(payment=="bca"){
                                $.ajax({
                                    type:"POST",
                                    url:"<?php echo base_url();?>transaksi/bcatransfer",
                                    data:{
                                        name:buyer_name,
                                        phone:buyer_phone,
                                        email:buyer_email,
                                        amount:harga,
                                        notifyUrl:unotify,
                                        idgame:$("#idgame").val(),
                                        idproduct:$("#idproduct").val(),
                                        akun:$("#akunid").val(),
                                        zone:$("#zona").val(),
                                        server:$("#server").val(),
                                    },
                                    mimeType: 'multipart/form-data',
                                    dataType:'json',
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Order sudah masuk kedalam sistem',
                                            text: 'Silahkan melakukan pembayaran : Rp.'+number_format(data[0].Total) ,
                                            showConfirmButton: true,
                                            confirmButtonText:'OK',
                                        }).then(function(){
                                            window.location.reload();
                                        });
                                    }
                                })
                            }else if((payment=="alfamart")||(payment=="indomaret")){
                                $.ajax({
                                    type:"POST",
                                    url:"<?php echo base_url();?>transaksi/cstore",
                                    data:{
                                        channel:payment,
                                        name:buyer_name,
                                        phone:"082150716903",
                                        email:buyer_email,
                                        amount:harga,
                                        notifyUrl:unotify,
                                    },
                                    mimeType: 'multipart/form-data',
                                    dataType:'json',
                                    success: function(data) {
                                        keterangan=data.keterangan;
                                        $.ajax({
                                            type:"POST",
                                            url:"<?php echo base_url();?>transaksi/cstoresimpan",
                                            data:{
                                                channel:data.channel,
                                                expired:data.expired,
                                                idgame:$("#idgame").val(),
                                                idproduct:$("#idproduct").val(),
                                                akun:$("#akunid").val(),
                                                zone:$("#zona").val(),
                                                server:$("#server").val(),
                                                trx_id:data.trx_id,
                                                kode:data.reference_id,
                                                email:buyer_email,
                                                harga:harga,
                                            },
                                            mimeType: 'multipart/form-data',
                                            dataType:'json',
                                            success: function(data) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Order sudah masuk kedalam sistem',
                                                    text: keterangan ,
                                                    showConfirmButton: true,
                                                    confirmButtonText:'Ok',
                                                }).then(function(){
                                                    window.location.reload();
                                                });
                                            }    
                                        });
                                    }
                                })
                            }
                        }else{
                            window.location.reload();
                        }
                    });
                }); 
            });
        </script>