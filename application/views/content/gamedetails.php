<?php echo $head;?>
    <div class="page-wrapper" style="margin-top:-50px;background-color:#FF8C32;">
    <?php foreach($game as $g){?>
        <div class="row" id="choose-demo" style="background-color:#FF8C32;">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card" >
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
                                        <div class="card-header" style="background-color: #FF8C32;color: #fff;">
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
                                                        <option>Pilih <?php echo $g->server_label;?></option>
                                                        <?php foreach($server as $s){?>
                                                        <option value="<?php echo $s->nama;?>"> <?php echo $s->nama;?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php } else {?>
                                                    <input type="text" class="form-control" name="server" id="server" required>
                                                    <?php } ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="card">
                                        <div class="card-header" style="background-color: #FF8C32;color: #fff;">
                                            <h4 class="box-title"><b>2.Pilih Nominal Top Up</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                            <?php foreach($product as $p){?>
                                                <?php if($leveluser=="Reseller"){?>
                                                <div class="col-6 col-md-6 col-lg-4" style="margin-bottom:5px;" onclick="pilihNominal('<?php echo $p->nama;?>',<?php echo $p->harga_reseller;?>)">
                                                <?php }else if($leveluser=="VVIP"){?>
                                                <div class="col-6 col-md-6 col-lg-4" style="margin-bottom:5px;" onclick="pilihNominal('<?php echo $p->nama;?>',<?php echo $p->harga_vvip;?>)">
                                                <?php }else{ ?>
                                                <div class="col-6 col-md-6 col-lg-4" style="margin-bottom:5px;" onclick="pilihNominal('<?php echo $p->nama;?>',<?php echo $p->harga_jual;?>)">
                                                <?php } ?>
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
                                    </div><br>
                                    <div class="card">         
                                        <div class="card-header" style="background-color: #FF8C32;color: #fff;">
                                            <h4 class="box-title"><b>3.Pilih Metode Pembayaran</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php if($leveluser=="Reseller"){?>
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-9">
                                                                    <h3 class="card-title">Bayar dengan saldo kamu</h3>
                                                                    <p class="card-text">Saldo kamu : <b>Rp <?php echo number_format($saldo);?></b><p>
                                                                </div>
                                                                <div class="col-sm-3 text-right">
                                                                    <span class="text-left" id="hargalabelsaldo" style="display:none;">Harga Reseller</span><br>
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
                                                <?php }else if($leveluser=="VVIP"){?>
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
                                                <?php }else if($leveluser=="User"){?>
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-9">
                                                                    <h3 class="card-title">Bayar dengan saldo kamu</h3>
                                                                    <p class="card-text">Saldo kamu : <b>Rp <?php echo number_format($saldo);?></b><p>
                                                                </div>
                                                                <div class="col-sm-3 text-right">
                                                                    <span class="text-left" id="hargalabelsaldo" style="display:none;">Harga</span><br>
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

                                                <?php } ?>
                                                <?php foreach($payment as $pay){?>
                                                <div class="col-sm-12">
                                                    <div class="card" >
                                                        <div class="card-pay" id="card-pay<?php echo $pay->idpayment;?>">
                                                            <a class="card-body stretched-link text-decoration-none" href="javascript:pilihpayment('<?php echo $pay->idpayment;?>','<?php echo $pay->nama;?>','<?php echo $pay->via;?>');">
                                                                <div class="row">
                                                                    <div class="col-sm-9">
                                                                        <img src="<?php echo base_url();?>assets/image/payment/<?php echo $pay->logo;?>" width="100"/>
                                                                    </div>
                                                                    <div class="col-sm-3 text-left">
                                                                        <span class="text-left text-info" id="hargalabel<?php echo $pay->idpayment;?>" style="display:none;">Harga</span><br>
                                                                        <span class="text-left text-info" id="harga-<?php echo $pay->idpayment;?>"><b></b></span>
                                                                        <span class="text-left text-info" style="display:none;" id="harganum-<?php echo $pay->idpayment;?>"><b></b></span>
                                                                        <span class="text-left text-info" style="display:none;" id="feenum-<?php echo $pay->idpayment;?>"><b></b></span>
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
                                            <input type="hidden" id="harga" name="harga" required/>
                                            <input type="hidden" id="fee" name="harga" required/>
                                            <input type="hidden" id="paymentvia" name="paymentvia" required/>
                                            <input type="hidden" id="paymentlabel" name="paymentlabel" required/>
                                            <input type="hidden" id="payment" name="payment" required/>
                                            <input type="hidden" id="product" name="product" required/>
                                            <input type="hidden" id="idgame" name="idgame" value="<?php echo $g->idgame;?>"/>
                                            <input type="hidden" id="idproduct" name="idproduct" required/>
                                        </div>  
                                    </div><br>
                                    <div class="card">         
                                        <div class="card-header" style="background-color: #FF8C32;color: #fff;">
                                            <h4 class="box-title"><b>4.Beli !</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <p>Optional: Jika anda ingin mendapatkan bukti pembayaran atas pembelian anda, harap mengisi alamat emailnya</p>
                                            <div class="form-group">
                                                <label>Alamat Email</label>
                                                <input type="text" class="form-control" name="email" id="email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">
                                        <button class="btn btn-lg btn-info" style="background-color: #FF8C32;border-color: #FF8C32;" type="submit"> Beli Sekarang</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div><br>
        </div>
    <?php }?>
    <?php echo $footer;?>
    <script src="<?php echo base_url();?>assets/theme/assets/node_modules/typeahead.js-master/dist/typeahead.bundle.min.js"></script>
    <script>
        function pilihPaymentBalance()
        { 
            var iduser = "";
            if(<?php echo $iduser;?>!="kosong")
            {
                iduser = <?php echo $iduser;?>;
            }else{
                iduser ="";
            }
            
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
                                iduser:iduser,
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
                                }else{
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Mohon maaf saldo kamu tidak cukup',
                                        showConfirmButton: true,
                                        confirmButtonText:'Transaksi Gagal',
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
        $(document).ready(function(){
            if("<?php echo $status;?>"=="Non Aktif"){
                Swal.fire({
                    icon: 'warning',
                    title: 'Mohon Maaf Produk ini tidak tersedia',
                    showConfirmButton: true,
                }).then(function(){
                    window.location.href = "<?php echo base_url();?>";
                });
            }
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
        function pilihNominal(product,harga)
        {
            <?php foreach($payment as $pay){?>
                var fee = <?php echo $pay->fee;?>;
                var persenfee = harga*fee/100;
                hargaakhir = harga+persenfee;
                if(<?php echo $saldo;?> >0){
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
                }
                


                document.getElementById("hargalabel<?php echo $pay->idpayment;?>").style="display:unset;";
                document.getElementById("harga-<?php echo $pay->idpayment;?>").textContent="Rp. "+number_format(hargaakhir);
                document.getElementById("harganum-<?php echo $pay->idpayment;?>").textContent=hargaakhir;
                document.getElementById("feenum-<?php echo $pay->idpayment;?>").textContent=persenfee;

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
            refreshpilihpayment();
        }
        function refreshpilihpayment()
        {
            var card = document.getElementsByClassName("card-pay");
            changeColor(card, '#fff');
            $("#harga").val();
            $("#fee").val();
            $("#payment").val();
            $("#paymentlabel").val();
            $("#paymentvia").val();
        }
        function pilihpayment(idpayment,paymentlabel,via)
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
                document.getElementById("card-pay"+idpayment).style.background="#e9ecef";
                var harga = document.getElementById("harganum-"+idpayment).textContent;
                var fee = document.getElementById("feenum-"+idpayment).textContent;
                $("#harga").val(harga);
                $("#fee").val(fee);
                $("#payment").val(idpayment);
                $("#paymentlabel").val(paymentlabel);
                $("#paymentvia").val(via);
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
                var paymentlabel = $("#paymentlabel").val();
                var paymentvia = $("#paymentvia").val();
                var paymentname="";
                var jenisvar = "";
                jenisvar = '<?php echo $leveluser;?>';
                if(jenisvar=="Reseller")
                {
                    jenisvar="Reseller";
                }else if(jenisvar=="VVIP")
                {
                    jenisvar="VVIP";
                }else{
                    jenisvar="Publik";
                }
                var zone="";
                var server="";
                    zone = $("#zona").val();
                    server = $("#server").val();

                if(buyer_name!=""){ akunidtemp = 'ID :'+ buyer_name+'<br>'; }else{ akunidtemp=""; }; 
                if(typeof zone!=="undefined"){ zonetemp = 'Zone :'+ zone+'<br>'; }else{ zonetemp=""; }; 
                if(typeof server!=="undefined"){ servertemp = 'Server :'+ server+'<br>'; }else{ servertemp=""; }; 
                var htmltext = '<p>' +akunidtemp+' '+zonetemp+' '+servertemp+
                            'Harga : Rp' +number_format(harga)+'<br>'+
                            'Bayar dengan : '+paymentlabel+'<br>';
                if((harga=="")||(product=="")||(paymentlabel==""))
                {
                    if(harga==""){
                        Swal.fire({
                            title: 'Mohon isi data dengan lengkap',
                            text: "Pilih Nominal Top Up",
                            icon: 'warning',
                            showCancelButton: false
                        });
                    }
                    if(paymentlabel=="")
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
                        confirmButtonText: 'Konfirmasi'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if(paymentvia=="Ipaymu")
                            {
                                if((paymentlabel=="Link Aja")||(paymentlabel=="Gopay")||(paymentlabel=="Dana")||(paymentlabel=="Ovo"))
                                {
                                    if(harga<=1000)
                                    {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'QRIS tidak bisa untuk transaksi dibawah 1.000',
                                            showConfirmButton: true,
                                            confirmButtonText:'Oke',
                                        }).then(function(){
                                            location.reload();
                                        });
                                    }else{
                                        $.ajax({
                                            type:"POST",
                                            url:"<?php echo base_url();?>transpayment/ipaymu",
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
                                                jenis:jenisvar,
                                            },
                                            mimeType: 'multipart/form-data',
                                            dataType:'json',
                                            success: function(data) {
                                                if(data.pesan=="success")
                                                {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Order sudah masuk kedalam sistem silahkan lakukan pembayaran',
                                                        showConfirmButton: true,
                                                        confirmButtonText:'Lanjutkan Pembayaran',
                                                    }).then(function(){
                                                        window.open(
                                                            data.linkpayment,
                                                            '_blank' // <- This is what makes it open in a new window.
                                                        );
                                                        window.location.href = "https://www.tokopetanionline.com/invoice/sendEmailInvoice/"+data.kode;
                                                    });
                                                }
                                            }
                                        });
                                    }
                                }else{
                                    $.ajax({
                                        type:"POST",
                                        url:"<?php echo base_url();?>transpayment/ipaymu",
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
                                            jenis:jenisvar,
                                        },
                                        mimeType: 'multipart/form-data',
                                        dataType:'json',
                                        success: function(data) {
                                            if(data.pesan=="success")
                                            {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Order sudah masuk kedalam sistem silahkan lakukan pembayaran',
                                                    showConfirmButton: true,
                                                    confirmButtonText:'Lanjutkan Pembayaran',
                                                }).then(function(){
                                                    window.open(
                                                        data.linkpayment,
                                                        '_blank' // <- This is what makes it open in a new window.
                                                    );
                                                    window.location.href = "https://www.tokopetanionline.com/invoice/sendEmailInvoice/"+data.kode;
                                                });
                                            }
                                        }
                                    });
                                }
                                
                            }else if(paymentvia=="Cek Mutasi")
                            {
                                $.ajax({
                                    type:"POST",
                                    url:"<?php echo base_url();?>transpayment/cekmutasi",
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
                                        jenis:jenisvar,
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
                                });
                            }else if(paymentvia=="Manual")
                            {
                                $.ajax({
                                    type:"POST",
                                    url:"<?php echo base_url();?>transpayment/manual",
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
                                        jenis:jenisvar,
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
                                            window.location.href = "https://www.tokopetanionline.com/invoice/sendEmailInvoice/"+data[0].kodetrans;
                                            // window.location.href = "/shop/invoice/"+data[0].kodetrans;
                                        });
                                    }
                                });
                            }
                            
                        }else{
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>