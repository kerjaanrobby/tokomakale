<?php echo $head;?>
            <div class="page-wrapper" style="margin-top:-50px;background-color:#1d6294;">
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
                                                                <select class="form-control"  name="akunid" id="akunid" required></select>
                                                                <?php } else {?>
                                                                <input type="text" class="form-control" name="akunid" id="akunid" required>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>

                                                        <?php if($g->zona_status=="Aktif"){?>
                                                            <div class="col-sm-6">
                                                                <label><?php echo $g->zona_label;?></label>
                                                                <?php if($g->zona_jenis=="Optional"){?>
                                                                <select class="form-control"  name="zona" id="zona" required></select>
                                                                <?php } else {?>
                                                                <input type="text" class="form-control" name="zona" id="zona" required>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>

                                                        <?php if($g->server_status=="Aktif"){?>
                                                            <div class="col-sm-6">
                                                                <label><?php echo $g->server_label;?></label>
                                                                <?php if($g->server_jenis=="Optional"){?>
                                                                <select class="form-control"  name="server" id="server" required>
                                                                    <option value="">Pilih <?php echo $g->server_label;?></option>
                                                                    <?php foreach($server as $s){?>
                                                                    <option value="<?php echo $s->nama;?>"> <?php echo $s->nama;?></option>
                                                                    <?php } ?>
                                                                </select>
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
                                                <div class="card-header" style="background-color: #1d6294;color: #fff;">
                                                    <h4 class="box-title"><b>2.Pilih Nominal Top Up</b></h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                    <?php foreach($product as $p){?>
                                                        <div class="col-6 col-md-6 col-lg-4" style="margin-bottom:5px;" onclick="pilihNominal('<?php echo $p->nama;?>',<?php echo $p->harga_vvip;?>)">
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
                                                <div class="card-header" style="background-color: #1d6294;color: #fff;">
                                                    <h4 class="box-title"><b>3.Pilih Metode Pembayaran</b></h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-9">
                                                                            <h3 class="card-title">Bayar dengan saldo kamu</h3>
                                                                            <p class="card-text">Saldo kamu : <b>Rp <?php echo number_format($saldo);?></b><p>
                                                                        </div>
                                                                        <div class="col-sm-3 text-right">
                                                                            <span class="text-left" id="hargalabelsaldo" style="display:none;">Harga VVIP</span><br>
                                                                            <span class="text-left" id="hargasaldo"></span><br><br>
                                                                            <span class="text-left" style="display:none;" id="harganum"><b></b></span>
                                                                            <button class="btn btn-sm btn-success" type="button" onclick="pilihPaymentBalance();" id="paywithbalance" style="display:none;">Bayar dengan saldo tersimpan</button>
                                                                            <button class="btn btn-sm btn-danger"  type="button" id="balancelow" style="display:none;" disabled="true">Maaf saldo anda tidak cukup</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        &nbsp;
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
                                                                                <span class="text-left text-info" id="hargalabel<?php echo $pay->kode;?>" style="display:none;">Harga VVIP</span><br>
                                                                                <span class="text-left text-info" id="harga-<?php echo $pay->kode;?>"><b></b></span>
                                                                                <span class="text-left text-info" style="display:none;" id="harganum-<?php echo $pay->kode;?>"><b></b></span>
                                                                                <span class="text-left text-info" style="display:none;" id="feenum-<?php echo $pay->kode;?>"><b></b></span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        &nbsp;
                                                    <?php }?>
                                                    </div>
                                                    <input type="hidden" id="harga" name="harga" required/>
                                                    <input type="hidden" id="fee" name="fee" required/>
                                                    <input type="hidden" id="payment" name="payment" required/>
                                                    <input type="hidden" id="product" name="product" required/>
                                                    <input type="hidden" id="idgame" name="idgame" value="<?php echo $g->idgame;?>" required/>
                                                    <input type="hidden" id="idproduct" name="idproduct" required/>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="card">         
                                                <div class="card-header" style="background-color: #1d6294;color: #fff;">
                                                    <h4 class="box-title"><b>4.Beli !</b></h4>
                                                </div>
                                                <div class="card-body">
                                                    <p>Optional: Jika anda ingin mendapatkan bukti pembayaran atas pembelian anda, harap mengisi alamat emailnya</p>
                                                    <div class="form-group">
                                                        <label>Alamat Email</label>
                                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>">
                                                        <input type="hidden" class="form-control" name="iduser" id="iduser" value="<?php echo $iduser;?>">
                                                    </div>
                                                </div>
                                                <button class="btn btn-lg btn-info" type="submit"> Beli Sekarang</button>
                                                
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
            function pilihPaymentBalance()
            {
                var statakun = "Kosong";
                var statzone = "Kosong";
                var statserver = "Kosong";
                var zonefield ="";
                var serverfield ="";
                    zonefield =$("#zona").val();
                    serverfield = $("#server").val()
                var harga = document.getElementById("harganum").textContent;
                $("#harga").val(harga);
                $("#payment").val("Potong saldo");
                var buyer_name = $("#akunid").val();
                if(buyer_name!=""){ akunidtemp = 'ID :'+ buyer_name+'<br>'; }else{ akunidtemp=""; }; 
                if(typeof zonefield!=="undefined"){ zonetemp = 'Zone :'+ zonefield+'<br>'; }else{ zonetemp=""; }; 
                if(typeof serverfield!=="undefined"){ servertemp = 'Server :'+ serverfield+'<br>'; }else{ servertemp=""; }; 
                var htmltext = '<p>' +akunidtemp+' '+zonetemp+' '+servertemp+
                            'Harga : Rp. ' +number_format(harga)+'<br>'+
                            'Bayar dengan : Potong saldo<br></p>';
                <?php if($g->akunid_status=="Aktif"){?>
                    
                    if(buyer_name==""){
                        statakun = "Kosong";
                    }else{
                        statakun = "Isi";
                    }
                <?php } else { ?>
                    statakun = "Isi";
                <?php }?>


                <?php if($g->zona_status=="Aktif"){?>
                    if(zonefield==""){
                        statzone = "Kosong";
                    }else{
                        statzone = "Isi";
                    }
                <?php } else { ?>
                    statzone = "Isi";
                <?php }?>

                <?php if($g->server_status=="Aktif"){?>
                    if(serverfield==""){
                        statserver = "Kosong";
                    }else{
                        statserver = "Isi";
                    }
                <?php } else { ?>
                    statserver = "Isi";
                <?php }?>

                if((statakun=="Kosong")||(statzone=="Kosong")||(statserver=="Kosong")){
                    if(statakun=="Kosong")
                    {
                        Swal.fire({
                            title: 'Mohon isi data dengan lengkap',
                            text: "Isi akun id kamu",
                            icon: 'warning',
                            showCancelButton: false
                        });
                    }
                    if(statzone=="Kosong")
                    {
                        Swal.fire({
                            title: 'Mohon isi data dengan lengkap',
                            text: "Isi Zona kamu",
                            icon: 'warning',
                            showCancelButton: false
                        });
                    }
                    if(statserver=="Kosong")
                    {
                        Swal.fire({
                            title: 'Mohon isi data dengan lengkap',
                            text: "Isi Server kamu",
                            icon: 'warning',
                            showCancelButton: false
                        });
                    }

                }else{
                    Swal.fire({
                        title: 'Detail Pembelian',
                        text: "Klik konfrim jika detail pembelian sudah sesuai",
                        icon: 'info',
                        html: htmltext,
                        showCancelButton: true,
                        confirmButtonText: 'Konfirm'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type:"POST",
                                url:"<?php echo base_url();?>transaksi/potonhsaldo",
                                data:{
                                    email:$("#email").val(),
                                    amount:harga,
                                    payment:$("#payment").val(),
                                    idgame:$("#idgame").val(),
                                    idproduct:$("#idproduct").val(),
                                    akun:$("#akunid").val(),
                                    zone:$("#zona").val(),
                                    server:$("#server").val(),
                                    iduser:<?php echo $iduser;?>
                                },
                                mimeType: 'multipart/form-data',
                                dataType:'json',
                                success: function(data) {
                                    if(data.hasil)
                                    {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Order sudah masuk tunggu proses oleh admin',
                                            showConfirmButton: true,
                                            confirmButtonText:'Transaksi Berhasil',
                                        }).then(function(){
                                            window.location.reload();
                                        });
                                    }
                                    
                                }
                            })
                        }
                    });
                    console.log(htmltext);
                }
            }
            function pilihNominal(product,harga)
            {
                <?php foreach($payment as $pay){?>
                var fee = <?php echo $pay->fee;?>;
                var persenfee = harga*fee/100;
                hargaakhir = harga+persenfee;
                if(harga>=<?php echo $saldo;?>){
                    document.getElementById("balancelow").style="display:unset;";
                    document.getElementById("paywithbalance").style="display:none;";
                }else{
                    document.getElementById("balancelow").style="display:none;";
                    document.getElementById("paywithbalance").style="display:unset;";
                }

                
                document.getElementById("hargalabelsaldo").style="display:unset;";
                document.getElementById("hargasaldo").textContent="Rp. "+number_format(harga);
                document.getElementById("harganum").textContent=harga;

                document.getElementById("hargalabel<?php echo $pay->kode;?>").style="display:unset;";
                document.getElementById("harga-<?php echo $pay->kode;?>").textContent="Rp. "+number_format(hargaakhir);
                document.getElementById("harganum-<?php echo $pay->kode;?>").textContent=hargaakhir;
                document.getElementById("feenum-<?php echo $pay->kode;?>").textContent=persenfee;
                $("#product").val(product);
                <?php }?>
                
            }
            function pilihproduct(idproduct)
            {
                var card = document.getElementsByClassName("card-product");
                changeColor(card, '#fff');
                document.getElementById("card-product"+idproduct).style.background="#1d6294";
                document.getElementById("card-product"+idproduct).style.color="#fff";
                $("#idproduct").val(idproduct);
            }
            function pilihpayment(kodepayment)
            {
                var idproduk =$("#idproduct").val();
                var product =$("#product").val();
                if((idproduk=="")||(product==""))
                {
                    Swal.fire({
                                title: 'Mohon isi data dengan lengkap',
                                text: "Pilih Nominal Top Up",
                                icon: 'warning',
                                showCancelButton: false
                            });
                }else{
                    var card = document.getElementsByClassName("card-pay");
                    changeColor(card, '#fff');
                    document.getElementById("card-pay"+kodepayment).style.background="#e9ecef";
                    var harga = document.getElementById("harganum-"+kodepayment).textContent;
                    var fee = document.getElementById("feenum-"+kodepayment).textContent;
                    $("#harga").val(harga);
                    $("#fee").val(fee);
                    $("#payment").val(kodepayment);
                }
            }
            function changeColor(coll, color){

                for(var i=0, len=coll.length; i<len; i++)
                {
                    coll[i].style["background-color"] = color;
                    coll[i].style["color"] = "#000";
                }
            }
            $(function(){
                $('#formfield').on('submit', function (e) {
                    e.preventDefault();
                    var harga = $("#harga").val();
                    var fee = $("#fee").val();
                    var product = $("#product").val();
                    var unotify = "<?php echo base_url();?>/transaksi/unotify";
                    var unotifystore = "<?php echo base_url();?>/transaksi/unotifycstore";
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
                    }else if(payment=="bri"){ paymentname="BRI";
                    }else if(payment=="bni"){ paymentname="BNI";
                    }else if(payment=="bca"){ paymentname="BCA";
                    }else if(payment=="dana"){ paymentname="Dana";
                    }else if(payment=="ovo"){ paymentname="Ovo";
                    }else if(payment=="linkaja"){ paymentname="Link Aja";
                    }else if(payment=="alfamart"){ paymentname="Alfamart";
                    }else if(payment=="indomaret"){ paymentname="Indomaret"; };
                    if(buyer_name!=""){ akunidtemp = 'ID :'+ buyer_name+'<br>'; }else{ akunidtemp=""; }; 
                    if(typeof zone!=="undefined"){ zonetemp = 'Zone :'+ zone+'<br>'; }else{ zonetemp=""; }; 
                    if(typeof server!=="undefined"){ servertemp = 'Server :'+ server+'<br>'; }else{ servertemp=""; }; 
                    var htmltext = '<p>' +akunidtemp+' '+zonetemp+' '+servertemp+
                            'Harga : Rp' +number_format(harga)+'<br>'+
                            'Bayar dengan : '+paymentname+'<br>';
                    if((harga=="")||(product=="")||(paymentname==""))
                    {
                        if(harga=="")
                        {
                            Swal.fire({
                                title: 'Mohon isi data dengan lengkap',
                                text: "Pilih Nominal Top Up",
                                icon: 'warning',
                                showCancelButton: false
                            });
                        }
                        if(paymentname=="")
                        {
                            Swal.fire({
                                title: 'Mohon isi data dengan lengkap',
                                text: "Pilih Metode Pembayaran",
                                icon: 'warning',
                                showCancelButton: false
                            });
                        }
                        
                    }else{
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
                                            jenis:"Reseller",
                                            iduser:$("#iduser").val()
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
                                }else if((payment=="bri"||payment=="bni")){
                                    $.ajax({
                                        type:"POST",
                                        url:"<?php echo base_url();?>transaksi/transfer",
                                        data:{
                                            name:buyer_name,
                                            phone:buyer_phone,
                                            email:buyer_email,
                                            amount:harga,
                                            payment:payment,
                                            notifyUrl:unotify,
                                            idgame:$("#idgame").val(),
                                            idproduct:$("#idproduct").val(),
                                            akun:$("#akunid").val(),
                                            zone:$("#zona").val(),
                                            server:$("#server").val(),
                                            jenis:"Reseller",
                                            iduser:$("#iduser").val()
                                        },
                                        mimeType: 'multipart/form-data',
                                        dataType:'json',
                                        success: function(data) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Order sudah masuk kedalam sistem',
                                                html: '<p style="text-align:left;">Detail transaksi : <br>Harga Produk : Rp.'+number_format(data[0].harga)+'<br>Kode Unik    : Rp.'+data[0].kodeunik+'<br>Total Bayar  : <b>Rp.'+number_format(data[0].total)+'</b></p>',
                                                showConfirmButton: true,
                                                confirmButtonText:'Lanjutkan pembayaran',
                                            }).then(function(){
                                                window.location.href = "/shop/invoice/"+data[0].kodetrans;
                                            });
                                        }
                                    })
                                }else if(payment=="bca"){
                                    $.ajax({
                                        type:"POST",
                                        url:"<?php echo base_url();?>transaksi/transferbca",
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
                                            jenis:"Reseller",
                                            iduser:$("#iduser").val()
                                        },
                                        mimeType: 'multipart/form-data',
                                        dataType:'json',
                                        success: function(data) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Order sudah masuk kedalam sistem',
                                                html: '<p style="text-align:left;">Detail transaksi : <br>Harga Produk : Rp.'+number_format(data[0].harga)+'<br>Kode Unik    : Rp.'+data[0].kodeunik+'<br>Total Bayar  : <b>Rp.'+number_format(data[0].total)+'</b></p>',
                                                showConfirmButton: true,
                                                confirmButtonText:'Lanjutkan pembayaran',
                                            }).then(function(){
                                                window.location.href = "/shop/invoice/"+data[0].kodetrans;
                                            });
                                        }
                                    })
                                }else if((payment=="alfamart")||(payment=="indomaret")){
                                    var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
                                    $.ajax({
                                        type:"POST",
                                        url:"<?php echo base_url();?>transaksi/cstore",
                                        data:{
                                            channel:payment,
                                            name:buyer_name,
                                            phone:"089601908822",
                                            email:buyer_email,
                                            idgame:$("#idgame").val(),
                                            idproduct:$("#idproduct").val(),
                                            akun:$("#akunid").val(),    
                                            zone:$("#zona").val(),
                                            server:$("#server").val(),
                                            amount:harga,
                                            fee:fee,
                                            notifyUrl:unotifystore,
                                            jenis:"Publik",
                                        },
                                        beforeSend: function() {
                                            swal.fire({
                                                html: '<h5>Loading...</h5>',
                                                showConfirmButton: false,
                                                onRender: function() {
                                                    // there will only ever be one sweet alert open.
                                                    $('.swal2-content').prepend(sweet_loader);
                                                }
                                            });
                                        },
                                        mimeType: 'multipart/form-data',
                                        dataType:'json',
                                        success: function(data) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Order sudah masuk kedalam sistem',
                                                html: '<p style="text-align:left;">Detail transaksi : <br>Harga Produk : Rp.'+number_format(data[0].hargaproduk)+'<br>Fee    : Rp.'+data[0].fee+'<br>Total Bayar  : <b>Rp.'+number_format(data[0].harga)+'</b></p>',
                                                showConfirmButton: true,
                                                confirmButtonText:'Lanjutkan pembayaran',
                                            }).then(function(){
                                                window.location.href = "/shop/invoice_retail/"+data[0].referenceid;
                                            });
                                            
                                            // Swal.fire({
                                            //     icon: 'success',
                                            //     title: 'Order sudah masuk kedalam sistem',
                                            //     text: data[0].keterangan+' '+data[0].bayar,
                                            //     showConfirmButton: true,
                                            //     confirmButtonText:'Ok',
                                            // }).then(function(){
                                            //     window.location.reload();
                                            // });
                                        }
                                    })
                                }
                            }else{
                                window.location.reload();
                            }
                        });
                    }
                }); 
            });
        </script>