<?php echo $head;?>
    <div class="page-wrapper" style="margin-top:-50px;background-color:#1d6294;">
    <?php foreach($game as $g){?>
        <div class="row" id="choose-demo" style="background-color:#1d6294;">
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
                                        <div class="card-header" style="background-color: #1d6294;color: #fff;">
                                            <h4 class="box-title"><b>1.Pilih Produk</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                            <?php foreach($product as $p){?>
                                                <div class="col-sm-4" style="margin-bottom:5px;">
                                                    <div class="card">
                                                        <div class="card-product" id="card-product<?php echo $p->idproduct;?>" onclick="pilihproduct(<?php echo $p->idproduct;?>)">
                                                            <div class="card-body text-center">
                                                                <?php echo $p->nama;?>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                Berat <?php echo ($p->berat/1000);?> Kg
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="card">
                                        <div class="card-header" style="background-color: #1d6294;color: #fff;">
                                            <h4 class="box-title"><b>2.Jumlah</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4">

                                                </div>
                                                <div class="col-sm-4" style="margin-bottom:5px;">
                                                    <div class="row">
                                                        <div class="col-3"></div>
                                                        <div class="col-2">
                                                                <button type="button" class="btn btn-info btn-sm" id="minjum"><i class="fa fa-minus"></i></button>
                                                        </div>
                                                        <div class="col-2">
                                                            <p class="text-center" id="jum"><b>1</b></p>
                                                        </div>
                                                        <div class="col-2">
                                                                <button type="button" class="btn btn-info btn-sm" id="plusjum"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">

                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="card">
                                        <div class="card-header" style="background-color: #1d6294;color: #fff;">
                                            <h4 class="box-title"><b>3. Alamat Pengiriman</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <select class="form-control"  name="provinsi" id="provinsi" required>
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach($province->rajaongkir->results as $prov)
                                                        {?>
                                                            <option value="<?php echo $prov->province_id;?>"><?php echo $prov->province;?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3" style="margin-bottom:5px;">
                                                    <select class="form-control"  name="kota" id="kota" required>
                                                        <option value="">Pilih Kota</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2" style="margin-bottom:5px;">
                                                    <select class="form-control"  name="courier" id="courier" required>
                                                        <option value="">Kurir</option>
                                                        <option value="jne">JNE</option>
                                                        <option value="tiki">TIKI</option>
                                                        <option value="pos">POS</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3" style="margin-bottom:5px;">
                                                    <select class="form-control"  name="service" id="service" required>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12" style="margin-bottom:5px;">
                                                    <textarea class="form-control"  name="alamat_lengkap" id="alamat_lengkap" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="card">         
                                        <div class="card-header" style="background-color: #1d6294;color: #fff;">
                                            <h4 class="box-title"><b>4.Pilih Metode Pembayaran</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php foreach($payment as $pay){?>
                                                <div class="col-sm-12">
                                                    <div class="card" >
                                                        <div class="card-pay" id="card-pay<?php echo $pay->kode;?>">
                                                            <a class="card-body stretched-link text-decoration-none" href="javascript:pilihpayment('<?php echo $pay->kode;?>');">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <img src="<?php echo base_url();?>assets/image/payment/<?php echo $pay->logo;?>" width="100"/>
                                                                    </div>
                                                                    <span class="text-right text-info" id="namapayment-<?php echo $pay->kode;?>" style="display:none;"><?php echo $pay->nama;?></span><br>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <div class="col-sm-5">
                                                                                <span class="text-info">Harga Produk</span><br>
                                                                                <span class="text-info">Ongkos Kirim</span><br>
                                                                                <span class="text-info">Fee Payment</span><br>
                                                                                <span class="text-info">Harga Total</span><br>
                                                                                <span class="text-info"><b></b></span>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <span class="text-info">Rp</span><br>
                                                                                <span class="text-info">Rp</span><br>
                                                                                <span class="text-info">Rp</span><br>
                                                                                <span class="text-info">Rp</span><br>
                                                                                <span class="text-info"><b></b></span>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <span class="text-right text-info" id="hargaproduklbl-<?php echo $pay->kode;?>"></span><br>
                                                                                <span class="text-right text-info" id="ongkoskirimlbl-<?php echo $pay->kode;?>"></span><br>
                                                                                <span class="text-right text-info" id="feepatmentlbl-<?php echo $pay->kode;?>"></span>
                                                                                <span class="text-right text-info" id="hargalabel<?php echo $pay->kode;?>" style="display:none;"></span><br>
                                                                                <span class="text-right text-info" id="harga-<?php echo $pay->kode;?>"><b></b></span>
                                                                            </div>
                                                                        </div>
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
                                            <!-- <input type="hidden" id="harga" name="harga" required/>
                                            <input type="hidden" id="hargaproduk" name="hargaproduk" required/>
                                            <input type="hidden" id="fee" name="harga" required/>
                                            <input type="hidden" id="payment" name="payment" required/>
                                            <input type="hidden" id="product" name="product" required/>
                                            <input type="hidden" id="idgame" name="idgame" value="<?php echo $g->idgame;?>"/>
                                            <input type="hidden" id="idproduct" name="idproduct" required/> -->
                                        </div>
                                    </div><br>
                                    <div class="card">         
                                        <div class="card-header">
                                            <h4 class="box-title"><b>5.Beli !</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <p>Optional: Jika anda ingin mendapatkan bukti pembayaran atas pembelian anda, harap mengisi alamat emailnya</p>
                                            <div class="form-group">
                                                <label>Alamat Email</label>
                                                <input type="text" class="form-control" name="email" id="email" required>
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
            </div><br>
        </div>
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
        var prov = $("#provinsi").val();
        var kota = $("#kota").val();
        var courier = $("#courier").val();
        var provinsitext;
        var kotatext;
        var kurirtext;
        var servicetext;
        var hargaongkir;
        var hargaongkirberat;
        var idproduk;
        var namaproduk;
        var idgame;
        var jumlahbeli;
        var hargaproduk;
        var beratproduk;
        var jumlahbeli = $("#jum").text();
        var jumlahbeliInt = parseInt(jumlahbeli);

        var hargapayment;
        var feepayment;
        var hargasubtotal;
        var hargatotal;

        var produkbayar;
        var ongkirbayar;
        var totalbayar;
        var feebayar;

        var jenispayment;
        function pilihproduct(idprod)
        {
            var card = document.getElementsByClassName("card-product");
            changeColor(card, '#fff');
            document.getElementById("card-product"+idprod).style.background="#25a9f3";
            idproduk = idprod;
            $.ajax({
                type:"POST",
                url:"<?php echo base_url();?>shop/detailproduct",
                data:{
                    idproduk:idproduk
                },
                mimeType: 'multipart/form-data',
                dataType:'json',
                success: function(data) {
                    console.log(data);
                    $.each(data.hasildata,function(i,v){
                        hargaproduk=v.harga_jual;
                        idgame = v.idgame;
                        beratproduk=(v.berat/1000);
                        namaproduk =v.nama;
                    });
                },
                complete: function() {
                    showPayment();
                },
            });
        }
        $("#plusjum").on('click', function (){
            jumlahbeliInt+=1;
            $("#jum").text(jumlahbeliInt);
            showPayment();
        });
        $("#minjum").on('click', function (){
            if(jumlahbeliInt>1)
            {
                jumlahbeliInt-=1;
                $("#jum").text(jumlahbeliInt);
                showPayment();
            }
        });
        $("#provinsi").change(function (){
            provinsitext = $(this).find("option:selected").text();
            $("#courier").val("");
            $("#service").val("").trigger('change');
            showPayment();
            var url = "<?php echo site_url('shop/kota_select');?>/"+$(this).val();
            $('#kota').load(url);
            return false;
        });
        $("#kota").change(function (){
            kotatext = $(this).find("option:selected").text();
            $("#courier").val("");
            $("#service").val("").trigger('change');
            showPayment();
        });
        $("#courier").change(function (){
            kurirtext= $(this).find("option:selected").text();
            prov = $("#provinsi").val();
            kota = $("#kota").val();
            courier = $("#courier").val();
            var url = "<?php echo site_url('shop/service_kurir');?>/"+prov+"/"+kota+"/"+courier;
            $('#service').load(url);
            return false;
        });
        $("#service").change(function (){
            servicetext  = $(this).find("option:selected").text();
            hargaongkir=0;
            var selected = $(this).find('option:selected');
            hargaongkir = parseInt(selected.data('foo'));
            showPayment();
        });
        function showPayment()
        {
            hargaongkirberat =hargaongkir*(beratproduk*jumlahbeliInt);
            console.log(hargaongkir);
            <?php foreach($payment as $pay){?>
                hargasubtotal = (parseInt(hargaproduk)*parseInt(jumlahbeliInt))+hargaongkirberat;
                feepayment = (hargasubtotal*<?php echo $pay->fee;?>)/100;
                hargatotal = parseInt(hargasubtotal)+parseInt(feepayment)+parseInt(hargaongkirberat);
                document.getElementById("hargaproduklbl-<?php echo $pay->kode;?>").textContent=""+number_format(hargasubtotal);
                document.getElementById("ongkoskirimlbl-<?php echo $pay->kode;?>").textContent=""+number_format(hargaongkirberat);
                document.getElementById("feepatmentlbl-<?php echo $pay->kode;?>").textContent=""+number_format(feepayment);
                document.getElementById("harga-<?php echo $pay->kode;?>").textContent=""+number_format(hargatotal);
            <?php }?>
        }
        
        function pilihpayment(kodepayment)
        {
            var alamat= $("textarea#alamat_lengkap").val();
            if(idproduk=="")
            {
                Swal.fire({
                    title: 'Informasi',
                    text: "Pilih Produk terlebih dahulu",
                    icon: 'warning',
                    showCancelButton: false
                });
            }
            else if((prov=="")||(kota=="")||(courier=="")||(servicetext=="")||(alamat=="")){
                Swal.fire({
                    title: 'Informasi',
                    text: "Mohon isi alamat dengan lengkap",
                    icon: 'warning',
                    showCancelButton: false
                });
            }else{
                var card = document.getElementsByClassName("card-pay");
                changeColor(card, '#fff');
                document.getElementById("card-pay"+kodepayment).style.background="#e9ecef";
                totalbayar = (document.getElementById("harga-"+kodepayment).textContent).replace(/,/g, '');
                feebayar = (document.getElementById("feepatmentlbl-"+kodepayment).textContent).replace(/,/g, '');
                produkbayar = (document.getElementById("hargaproduklbl-"+kodepayment).textContent).replace(/,/g, '');
                ongkirbayar= (document.getElementById("ongkoskirimlbl-"+kodepayment).textContent).replace(/,/g, '');
                jenispayment = document.getElementById("namapayment-"+kodepayment).textContent;
            }
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
                var unotify = "<?php echo base_url();?>/transaksi/unotify";
                var unotifystore = "<?php echo base_url();?>/transaksi/unotifycstore";
                var buyer_name = $("#email").val();
                var buyer_email = $("#email").val();
                var buyer_phone = "0";
                var payment = jenispayment;
                var htmltext = '<p>Nama Produk :' +namaproduk+ '<br>'+
                            'Harga Produk: Rp' +number_format(produkbayar)+'<br>'+
                            'Ongkos Kirim: Rp' +number_format(ongkirbayar)+'<br>'+
                            'Fee Payment: Rp' +number_format(feebayar)+'<br>'+
                            'Total Bayar: Rp' +number_format(totalbayar)+'<br>'+
                            'Bayar dengan : '+payment;
                if((totalbayar=="")||(namaproduk=="")||(payment==""))
                {
                    if(totalbayar=="")
                    {
                        Swal.fire({
                            title: 'Mohon isi data dengan lengkap',
                            text: "Pilih Nominal Top Up",
                            icon: 'warning',
                            showCancelButton: false
                        });
                    }
                    if(payment=="")
                    {
                        Swal.fire({
                            title: 'Mohon isi data dengan lengkap',
                            text: "Pilih Metode Pembayaran",
                            icon: 'warning',
                            showCancelButton: false
                        });
                    }
                }else{
                    alert(jumlahbeliInt);
                    // Swal.fire({
                    //     title: 'Detail Pembelian',
                    //     text: "Klik konfrim jika detail pembelian sudah sesuai",
                    //     icon: 'info',
                    //     html: htmltext,
                    //     showCancelButton: true,
                    //     confirmButtonText: 'Konfirm'
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         if((payment=="Gopay")||(payment=="Dana")||(payment=="Ovo")||(payment=="Link Aja"))
                    //         { 
                    //             $.ajax({
                    //                 type:"POST",
                    //                 url:"<?php echo base_url();?>transaksi/qris",
                    //                 data:{
                    //                     name:buyer_name,
                    //                     phone:buyer_phone,
                    //                     email:buyer_email,
                    //                     hargaproduk:produkbayar,
                    //                     ongkoskirim:ongkirbayar,
                    //                     feepayment:feebayar,
                    //                     amount:totalbayar,
                    //                     notifyUrl:unotify,
                    //                     idgame:idgame,
                    //                     idproduct:idproduk,
                    //                     jumlah:jumlahbeliInt,
                    //                     jenis:"Publik",
                    //                 },
                    //                 mimeType: 'multipart/form-data',
                    //                 dataType:'json',
                    //                 success: function(data) {
                    //                     urlpayment=data[0].QrTemplate;
                    //                     if(data[0].pesan=="success")
                    //                     {
                    //                         Swal.fire({
                    //                             icon: 'success',
                    //                             title: 'Order sudah masuk kedalam sistem silahkan lakukan pembayaran',
                    //                             showConfirmButton: true,
                    //                             confirmButtonText:'Lanjutkan Pembayaran',
                    //                         }).then(function(){
                    //                             window.location.href = "/shop/invoice_merchant_qirs/"+data[0].ReferenceId+"/"+data[0].trx_id;
                    //                         });
                    //                     }
                    //                 }
                    //             })
                    //         }else if(payment=="BRI"){
                    //             $.ajax({
                    //                 type:"POST",
                    //                 url:"<?php echo base_url();?>transaksi/transfer",
                    //                 data:{
                    //                     name:buyer_name,
                    //                     phone:buyer_phone,
                    //                     email:buyer_email,
                    //                     hargaproduk:produkbayar,
                    //                     ongkoskirim:ongkirbayar,
                    //                     feepayment:feebayar,
                    //                     amount:totalbayar,
                    //                     notifyUrl:unotify,
                    //                     idgame:idgame,
                    //                     idproduct:idproduk,
                    //                     jumlah:jumlahbeliInt,
                    //                     jenis:"Publik",
                    //                 },
                    //                 mimeType: 'multipart/form-data',
                    //                 dataType:'json',
                    //                 success: function(data) {
                    //                     Swal.fire({
                    //                         icon: 'success',
                    //                         title: 'Order sudah masuk kedalam sistem',
                    //                         showConfirmButton: true,
                    //                         confirmButtonText:'Lanjutkan pembayaran',
                    //                     }).then(function(){
                    //                         window.location.href = "/shop/invoice_merchant/"+data[0].kodetrans;
                    //                     });
                    //                 }
                    //             })
                    //         }else if(payment=="BCA"){
                    //             $.ajax({
                    //                 type:"POST",
                    //                 url:"<?php echo base_url();?>transaksi/transferbca",
                    //                 data:{
                    //                     name:buyer_name,
                    //                     phone:buyer_phone,
                    //                     email:buyer_email,
                    //                     hargaproduk:produkbayar,
                    //                     ongkoskirim:ongkirbayar,
                    //                     feepayment:feebayar,
                    //                     amount:totalbayar,
                    //                     notifyUrl:unotify,
                    //                     idgame:idgame,
                    //                     idproduct:idproduk,
                    //                     jumlah:jumlahbeliInt,
                    //                     jenis:"Publik",
                    //                 },
                    //                 mimeType: 'multipart/form-data',
                    //                 dataType:'json',
                    //                 success: function(data) {
                    //                     Swal.fire({
                    //                         icon: 'success',
                    //                         title: 'Order sudah masuk kedalam sistem',
                    //                         showConfirmButton: true,
                    //                         confirmButtonText:'Lanjutkan pembayaran',
                    //                     }).then(function(){
                    //                         window.location.href = "/shop/invoice_merchant/"+data[0].kodetrans;
                    //                     });
                    //                 }
                    //             })
                    //         }else if((payment=="Alfamart")||(payment=="Indomaret")){
                    //             var sweet_loader = '<div class="sweet_loader"><svg viewBox="0 0 140 140" width="140" height="140"><g class="outline"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="rgba(0,0,0,0.1)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"></path></g><g class="circle"><path d="m 70 28 a 1 1 0 0 0 0 84 a 1 1 0 0 0 0 -84" stroke="#71BBFF" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-dashoffset="200" stroke-dasharray="300"></path></g></svg></div>';
                    //             if(payment=="Alfamart")
                    //             {
                    //                 payment="alfamart";
                    //             }else{
                    //                 payment="indomaret";
                    //             }
                    //             $.ajax({
                    //                 type:"POST",
                    //                 url:"<?php echo base_url();?>transaksi/cstore",
                    //                 data:{
                    //                     channel:payment,
                    //                     name:buyer_name,
                    //                     phone:"089601908822",
                    //                     email:buyer_email,
                    //                     hargaproduk:produkbayar,
                    //                     ongkoskirim:ongkirbayar,
                    //                     fee:feebayar,
                    //                     amount:totalbayar,
                    //                     notifyUrl:unotifystore,
                    //                     idgame:idgame,
                    //                     idproduct:idproduk,
                    //                     jumlah:jumlahbeliInt,
                    //                     jenis:"Publik",
                    //                 },
                    //                 beforeSend: function() {
                    //                     swal.fire({
                    //                         html: '<h5>Loading...</h5>',
                    //                         showConfirmButton: false,
                    //                         onRender: function() {
                    //                             $('.swal2-content').prepend(sweet_loader);
                    //                         }
                    //                     });
                    //                 },
                    //                 mimeType: 'multipart/form-data',
                    //                 dataType:'json',
                    //                 success: function(data) {
                    //                     Swal.fire({
                    //                         icon: 'success',
                    //                         title: 'Order sudah masuk kedalam sistem',
                    //                         // html: '<p style="text-align:left;">Detail transaksi : <br>Harga Produk : Rp.'+number_format(data[0].hargaproduk)+'<br>Fee    : Rp.'+data[0].fee+'<br>Total Bayar  : <b>Rp.'+number_format(data[0].harga)+'</b></p>',
                    //                         showConfirmButton: true,
                    //                         confirmButtonText:'Lanjutkan pembayaran',
                    //                     }).then(function(){
                    //                         window.location.href = "/shop/invoice_merchant_retail/"+data[0].referenceid;
                    //                     });
                    //                 }
                    //             })
                    //         }
                    //     }else{
                    //         window.location.reload();
                    //     }
                    // }); 
                }
            }); 
        });
    </script>