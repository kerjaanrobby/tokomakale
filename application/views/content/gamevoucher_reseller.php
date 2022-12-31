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
                                <div class="white-box text-center">
                                    <img src="<?php echo base_url().'/assets/image/'.$g->gambar;?>" class="img-responsive">
                                </div>
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
                                            <h4 class="box-title"><b>1.Pilih Voucher</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php foreach($product as $p){?>
                                                <div class="col-sm-4" style="margin-bottom:5px;">
                                                    <div class="card">
                                                        <div class="card-product" id="card-product<?php echo $p->idvoucher;?>" onclick="pilihvoucher(<?php echo $p->idvoucher;?>)">
                                                            <div class="card-body text-center">
                                                                <?php echo $p->nama;?>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                Stok <?php echo $p->stok;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card">         
                                        <div class="card-header" style="background-color: #1d6294;color: #fff;">
                                            <h4 class="box-title"><b>2.Jumlah Voucher</b></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4"></div>
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
                                                <div class="col-sm-4"></div>
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
                                                                    <span class="text-left" id="hargalabelsaldo" style="display:none;">Harga Reseller</span><br>
                                                                    <span class="text-left" id="hargasaldo"></span><br><br>
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
                                                            <a class="card-body stretched-link text-decoration-none" href="javascript:pilihpayment('<?php echo $pay->kode;?>','<?php echo $pay->nama;?>');">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <img src="<?php echo base_url();?>assets/image/payment/<?php echo $pay->logo;?>" width="100"/>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <div class="col-sm-5">
                                                                            <span class="text-right text-info" id="hargalabel-<?php echo $pay->kode;?>"style="display:none;">Harga Reseller</span><br>
                                                                            <span class="text-right text-info">Harga Voucher</span><br>
                                                                            <span class="text-right text-info">Fee Payment</span><br>
                                                                            <span class="text-right text-info">Harga Total</span><br>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <span class="text-right text-info">&nbsp;</span><br>
                                                                            <span class="text-right text-info">Rp</span><br>
                                                                            <span class="text-right text-info">Rp</span><br>
                                                                            <span class="text-right text-info">Rp</span><br>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <span class="text-right text-info">&nbsp;</span><br>
                                                                            <span class="text-right text-info" id="harga-<?php echo $pay->kode;?>"></span><br>
                                                                            <span class="text-right text-info" id="hargafee-<?php echo $pay->kode;?>"></span><br>
                                                                            <span class="text-right text-info" id="total-<?php echo $pay->kode;?>"></span><br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                            <!-- <div class="col-sm-3 text-left">
                                                                                <span class="text-left" id="hargalabel<?php echo $pay->kode;?>" style="display:none;">Harga Reseller</span><br>
                                                                                <span class="text-left" id="harga-<?php echo $pay->kode;?>"><b></b></span><span class="text-left" id="jumlahbeli-<?php echo $pay->kode;?>"><b></b></span>
                                                                                <span class="text-left" id="hargafee-<?php echo $pay->kode;?>"><b></b></span>
                                                                            </div> -->
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
                                        <button class="btn btn-lg btn-warning" type="submit"> Beli Sekarang</button>
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
            // function showPayment()
            // {
            //     <?php foreach($payment as $pay){?>
            //         hargasubtotal = (parseInt(hargaproduk)*parseInt(jumlahbeliInt))+hargaongkirberat;
            //         feepayment = (hargasubtotal*<?php echo $pay->fee;?>)/100;
            //         hargatotal = parseInt(hargasubtotal)+parseInt(feepayment)+parseInt(hargaongkirberat);
            //         document.getElementById("hargaproduklbl-<?php echo $pay->kode;?>").textContent=""+number_format(hargasubtotal);
            //         document.getElementById("ongkoskirimlbl-<?php echo $pay->kode;?>").textContent=""+number_format(hargaongkirberat);
            //         document.getElementById("feepatmentlbl-<?php echo $pay->kode;?>").textContent=""+number_format(feepayment);
            //         document.getElementById("harga-<?php echo $pay->kode;?>").textContent=""+number_format(hargatotal);
            //     <?php }?>
            // }
    </script>
    <script>
            var harga_normal;
            var harga_reseller;
            var stok;
            var jumlahbeli = $("#jum").text();
            var jumlahbeliInt = parseInt(jumlahbeli);
            var idvoucher="";
            var namavoucher="";
            var feepaymentpersent;
            var feepayment;
            var subtotal;
            var total;
            var totalbayar;
            var voucherbayar;
            var paymentbayar;
            var jenispayment;
            var payment;

            function pilihvoucher(id)
            {
                $.ajax({
                    type: "POST",
                    url: '<?php  echo base_url(); ?>voucher/datadetail',
                    data:{
                        id:id
                    },
                    dataType:'json',
                    success: function(data) {
                        $.each(data.hasildata,function(i,v){
                            harga_normal = v.harga_reseller;
                            harga_reseller = v.harga_reseller;
                            stok = v.stok;
                            idvoucher = id;
                            namavoucher = v.nama;
                        });
                        if(stok>0)
                        {
                            showPayment();
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: 'Stok voucher habis',
                                showConfirmButton: true,
                                confirmButtonText:'Pilih voucher lain',
                            }).then(function(){
                                window.location.reload();
                            });
                            
                        }
                    }
                });
                var card = document.getElementsByClassName("card-product");
                changeColor(card, '#fff');
                document.getElementById("card-product"+id).style.background="#1d6294";
                document.getElementById("card-product"+id).style.color="#fff";
                
            }
            $("#plusjum").on('click', function (){
                if(idvoucher==""){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilih voucher dulu',
                        showConfirmButton: true,
                    });
                }else{
                    $.ajax({
                        type: "POST",
                        url: '<?php  echo base_url(); ?>voucher/datadetail',
                        data:{
                            id:idvoucher
                        },
                        dataType:'json',
                        success: function(data) {
                            $.each(data.hasildata,function(i,v){
                                stok = v.stok;
                            });
                            if(stok>jumlahbeliInt)
                            {
                                jumlahbeliInt+=1;
                                $("#jum").text(jumlahbeliInt);
                                showPayment();
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Stok voucher tidak cukup',
                                    showConfirmButton: true,
                                });
                                
                            }
                        }
                    });
                    
                }
            });
            $("#minjum").on('click', function (){
                if(idvoucher==""){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pilih voucher dulu',
                        showConfirmButton: true,
                    });
                }else{
                    if(jumlahbeliInt>1)
                    {
                        jumlahbeliInt-=1;
                        $("#jum").text(jumlahbeliInt);
                        showPayment();
                    }
                }
            });
            function showPayment()
            {
                <?php foreach($payment as $pay){?>
                    feepaymentpersent = <?php echo $pay->fee;?>;
                    feepayment = harga_normal*feepaymentpersent/100;
                    subtotal = harga_normal*jumlahbeliInt;
                    total = subtotal+feepayment;

                    if(subtotal>=<?php echo $saldo;?>){
                        document.getElementById("balancelow").style="display:unset;";
                        document.getElementById("paywithbalance").style="display:none;";
                    }else{
                        document.getElementById("balancelow").style="display:none;";
                        document.getElementById("paywithbalance").style="display:unset;";
                    }
                    
                    document.getElementById("hargalabelsaldo").style="display:unset;";
                    document.getElementById("hargasaldo").textContent="Rp. "+number_format(subtotal);

                    document.getElementById("hargalabel-<?php echo $pay->kode;?>").style="display:unset;";
                    document.getElementById("harga-<?php echo $pay->kode;?>").textContent=""+number_format(subtotal);
                    document.getElementById("hargafee-<?php echo $pay->kode;?>").textContent=""+number_format(feepayment);
                    document.getElementById("total-<?php echo $pay->kode;?>").textContent=""+number_format(total);
                <?php } ?>
            }
            function pilihPaymentBalance()
            {
                var htmltext = '<p>'+
                                'Voucher : ' +namavoucher+ '<br>'+
                                'Jumlah  : '+jumlahbeliInt+ '<br>'+
                                'Harga   : Rp. ' +number_format(harga_normal)+' x '+jumlahbeliInt+'<br>'+
                                'Total Bayar : Rp. ' +number_format(subtotal)+'<br>'+
                                'Bayar dengan : Potong saldo<br></p>';
                Swal.fire({
                        title: 'Detail Pembelian',
                        text: "Klik konfrim jika detail pembelian sudah sesuai",
                        icon: 'info',
                        html: htmltext,
                        showCancelButton: true,
                        confirmButtonText: 'Konfirm'
                }).then((result) => {
                        
                });
            }
            
            function pilihpayment(kodepayment,nama)
            {
                
                if((idvoucher=="")||(namavoucher==""))
                {
                    Swal.fire({
                        title: 'Mohon isi data dengan lengkap',
                        text: "Pilih voucher dulu",
                        icon: 'warning',
                        showCancelButton: false
                    });
                }else{
                    var card = document.getElementsByClassName("card-pay");
                    changeColor(card, '#fff');
                    document.getElementById("card-pay"+kodepayment).style.background="#e9ecef";

                    
                    voucherbayar = (document.getElementById("harga-"+kodepayment).textContent).replace(/,/g, '');
                    paymentbayar = (document.getElementById("hargafee-"+kodepayment).textContent).replace(/,/g, '');
                    totalbayar = (document.getElementById("total-"+kodepayment).textContent).replace(/,/g, '');
                    jenispayment = nama;
                    payment = kodepayment;
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
                    var unotify = "<?php echo base_url();?>/transaksi/unotify_voucher";
                    var unotifystore = "<?php echo base_url();?>/transaksi/unotifycstore";
                    var buyer_phone = "0";
                    var buyer_name = $("#email").val();
                    var buyer_email = $("#email").val();
                    var paymentname=jenispayment;
                    var htmltext ="<p style='text-align:right'>"+
                                    "<table>"+
                                    "<tr>"+
                                    "<td style='text-align:left'>Harga Voucher</td>"+
                                    "<td>:</td>" +
                                    "<td>"+number_format(harga_normal)+" x "+jumlahbeliInt+" = "+number_format(subtotal)+"</td>"+
                                    "</tr>"+
                                    "<tr>"+
                                    "<td style='text-align:left'>Fee Payment</td>"+
                                    "<td>:</td>" +
                                    "<td>"+number_format(feepayment)+"</td>"+
                                    "</tr>"+
                                    "<tr>"+
                                    "<td style='text-align:left'>Total Bayar</td>"+
                                    "<td>:</td>" +
                                    "<td><b>"+number_format(totalbayar)+"</b></td>"+
                                    "</tr>"+
                                    "<tr>"+
                                    "<td style='text-align:left'>Bayar Dengan</td>"+
                                    "<td>:</td>" +
                                    "<td>"+paymentname+"</td>"+
                                    "</tr>"+
                                    "</table></p>";
                    if((totalbayar=="")||(namavoucher=="")||(paymentname==""))
                    {
                        if(namavoucher=="")
                        {
                            Swal.fire({
                                title: 'Mohon isi data dengan lengkap',
                                text: "Pilih Voucher",
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
                                        url:"<?php echo base_url();?>transaksi/qris_voucher",
                                        data:{
                                            name:buyer_name,
                                            phone:buyer_phone,
                                            email:buyer_email,
                                            amount:totalbayar,
                                            notifyUrl:unotify,
                                            idgame:$("#idgame").val(),
                                            idproduct:idvoucher,
                                            jumlah:jumlahbeliInt,
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
                                }else if((payment=="bri")||(payment=="bni")){
                                    $.ajax({
                                        type:"POST",
                                        url:"<?php echo base_url();?>transaksi/transfer",
                                        data:{
                                            name:buyer_name,
                                            phone:buyer_phone,
                                            email:buyer_email,
                                            amount:totalbayar,
                                            payment:payment,
                                            notifyUrl:unotify,
                                            jumlah:jumlahbeliInt,
                                            kategori:"Voucher",
                                            idgame:$("#idgame").val(),
                                            idproduct:idvoucher,
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
                                                window.location.href = "/shop/invoice_voucher/"+data[0].kodetrans;
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
                                            amount:totalbayar,
                                            notifyUrl:unotify,
                                            jumlah:jumlahbeliInt,
                                            kategori:"Voucher",
                                            idgame:$("#idgame").val(),
                                            idproduct:idvoucher,
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
                                            idproduct:idvoucher,
                                            jumlah:jumlahbeliInt,
                                            kategori:"Voucher",
                                            amount:totalbayar,
                                            fee:feepayment,
                                            notifyUrl:unotifystore,
                                            jenis:"Reseller",
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