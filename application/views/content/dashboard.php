
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Dashboard</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="example">
                                            <h5 class="box-title">Tanggal</h5>
                                            <div class="input-daterange input-group" id="date-range">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="start" id="start" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-info b-0 text-white text-center">Sampai</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="end" id="end" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-block btn-info" id="tampilData">Tampil</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Uang masuk</h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2> <i class="fa fa-chart-line"></i></h2>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-right">
                                            <h2 id="txtUangMasuk">0</h2>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-success">&nbsp;&nbsp;</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Modal</h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2> <i class="fa fa-chart-line"></i></h2>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-right">
                                            <h2  id="txtUangModal">0</h2>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-success">&nbsp;&nbsp;</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Keuntungan</h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h2> <i class="fa fa-chart-line"></i></h2>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-right">
                                            <h2 id="txtUangUntung">0</h2>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-success">&nbsp;&nbsp;</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- End Info box -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Over Visitor, Our income , slaes different and  sales prediction -->
                <!-- ============================================================== -->
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title text-uppercase">Transaksi<br><small class="text-muted">Semua transaksi di Rupiah</small></h5>
                                    <div class="ml-auto">
                                        <ul class="list-inline font-12">
                                            <li><i class="fa fa-circle text-info"></i> Keuntungan</li>
                                            <li><i class="fa fa-circle text-success"></i> Uang Masuk</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="morris-bar-chart" style="height:375px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Transaksi</h5>
                                        <div id="morris-donut-chart" class="ecomm-donute"></div>
                                        <ul class="list-inline m-t-30 text-center mb-1 d-flex">
                                            <li class="list-inline-item p-r-20">
                                                <h5 class="text-muted"><i class="fa fa-circle" style="color: #fb9678;"></i> Publik</h5>
                                                <h4 class="m-b-0" id="label-publik"></h4>
                                            </li>
                                            <li class="list-inline-item p-r-20">
                                                <h5 class="text-muted"><i class="fa fa-circle" style="color: #01c0c8;"></i> Reseller</h5>
                                                <h4 class="m-b-0" id="label-reseller"></h4>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pembayaran via</h5>
                                        <div id="morris-donut-chart-payment" class="ecomm-donute"></div>
                                        <ul id="legend-payment" class="list-inline m-t-30 text-center mb-1 d-flex">
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php echo $foot;?>

    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/theme/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/theme/assets/node_modules/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/theme/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
    jQuery('#date-range').datepicker({
        toggleActive: true,
        format: 'dd/mm/yyyy',
        autoclose: true,
        'default': 'now',
        todayHighlight: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    $(function () {
        setDateRange();
        showDataCard();
    });
    function setDateRange()
    {
        var datenow="<?php echo date('d/m/Y');?>";
        var start = $("#start").val(datenow);
        var end = $("#end").val(datenow);
    };
    function generateLightColorHex() {
        let color = "#";
        for (let i = 0; i < 3; i++)
            color += ("0" + Math.floor(((1 + Math.random()) * Math.pow(16, 2)) / 2).toString(16)).slice(-2);
        return color;
    }
    function showDataCard()
    {
        var start = $("#start").val();
        var end = $("#end").val();
        $.ajax({
            type: "POST",
            url: '<?php  echo base_url(); ?>dashboard/dashboard_data',
            data:{
                start:start,
                end:end,
            },
            dataType:'json',
            success: function(data) {
                $('#legend-payment').empty();
                var arr=[];
                var arrr=[];
                var colorarr=[];
                // '#fb9678', 
                //     '#01c0c8',
                //     '#00a5e5',
                //     '#00c292',
                //     '#fec107'
                var legend="";
                var colors="";
                var datapublik= "";
                var datareseller= "";
                if(data.publik==null)
                {
                    datapublik=0;
                }else{
                    datapublik=data.publik;
                }
                if(data.reseller==null)
                {
                    datareseller=0;
                }else{
                    datareseller=data.reseller;
                }
                $("#txtUangMasuk").text("Rp. "+number_format(data.uangmasuk));
                $("#txtUangModal").text("Rp. "+number_format(data.modal));
                $("#txtUangUntung").text("Rp. "+number_format(data.untung));
                $("#label-publik").text("Rp. "+number_format(data.publik));
                $("#label-reseller").text("Rp. "+number_format(data.reseller));
                Morris.Donut({
                    element: 'morris-donut-chart',
                    data: [{
                        label: "Publik",
                        value: datapublik,

                    }, {
                        label: "Reseller",
                        value: datareseller,
                    }],
                    resize: true,
                    colors:['#fb9678', '#01c0c8']
                });
                var carr=data.transaksilist.length;
                var carrr=data.paymentlist.length;
                $.each(data.transaksilist,function(i,v){
                    arr.push({
                        y: v.tanggal, 
                        keuntungan: v.untung,
                        masuk: v.uangmasuk
                    });
                    if(arr.length==carr){
                        Morris.Bar({
                            element: 'morris-bar-chart',
                            data: arr,
                            xkey: 'y',
                            ykeys: [ 'keuntungan', 'masuk'],
                            labels: [ 'Keuntungan', 'Uang Masuk'],
                            barColors: [ '#00a5e5', '#00c292'],
                            labelTop: true,
                            gridLineColor: '#eef0f2',
                            resize: true
                        });
                    }
                });
                $.each(data.paymentlist,function(i,v){
                    colors=generateLightColorHex();
                    // colors="#"+Math.floor(Math.random()*16777215).toString(16);
                    arrr.push({
                        label: v.via, 
                        value: v.uangmasuk
                    });
                    colorarr.push(colors);
                    legend = "<li class='list-inline-item p-r-20'>"+
                                    "<h5 class='text-muted'>"+
                                        "<i class='fa fa-circle' style='color: "+colors+";'></i> "+v.via+""+
                                    "</h5>"+
                                    "<h4 class='m-b-0'>"+number_format(v.uangmasuk)+"</h4>"+
                                "</li>";

                    $('#legend-payment').append(legend);
                    if(arrr.length==carrr){
                        Morris.Donut({
                            element: 'morris-donut-chart-payment',
                            data: arrr,
                            resize: true,
                            colors:colorarr
                        });
                    }
                });
            }
        });
    }
    $("#tampilData").on('click',function(){
        var start = $("#start").val();
        var end = $("#end").val();
        $.ajax({
            type: "POST",
            url: '<?php  echo base_url(); ?>dashboard/dashboard_data',
            data:{
                start:start,
                end:end,
            },
            dataType:'json',
            success: function(data) {
                $("#morris-bar-chart").empty();
                $("#morris-donut-chart-payment").empty();
                $('#legend-payment').empty();
                $("#morris-donut-chart").empty();
                var arr=[];
                var arrr=[];
                var colorarr=[];
                var legend="";
                var colors="";
                $("#txtUangMasuk").text("Rp. "+number_format(data.uangmasuk));
                $("#txtUangModal").text("Rp. "+number_format(data.modal));
                $("#txtUangUntung").text("Rp. "+number_format(data.untung));
                $("#label-publik").text("Rp. "+number_format(data.publik));
                $("#label-reseller").text("Rp. "+number_format(data.reseller));
                Morris.Donut({
                    element: 'morris-donut-chart',
                    data: [{
                        label: "Publik",
                        value: data.publik,

                    }, {
                        label: "Reseller",
                        value: data.reseller,
                    }],
                    resize: true,
                    colors:['#fb9678', '#01c0c8']
                });
                var carr=data.transaksilist.length;
                var carrr=data.paymentlist.length;
                $.each(data.transaksilist,function(i,v){
                    arr.push({
                        y: v.tanggal, 
                        keuntungan: v.untung,
                        masuk: v.uangmasuk
                    });
                    if(arr.length==carr){
                        Morris.Bar({
                            element: 'morris-bar-chart',
                            data: arr,
                            xkey: 'y',
                            ykeys: [ 'keuntungan', 'masuk'],
                            labels: [ 'Keuntungan', 'Uang Masuk'],
                            barColors: [ '#00a5e5', '#00c292'],
                            labelTop: true,
                            gridLineColor: '#eef0f2',
                            resize: true
                        });
                    }
                });
                $.each(data.paymentlist,function(i,v){
                    colors=generateLightColorHex();
                    arrr.push({
                        label: v.via, 
                        value: v.uangmasuk
                    });
                    colorarr.push(colors);
                    legend = "<li class='list-inline-item p-r-20'>"+
                                    "<h5 class='text-muted'><i class='fa fa-circle' style='color: "+colors+";'></i> "+v.via+"</h5>"+
                                                "<h4 class='m-b-0'>"+number_format(v.uangmasuk)+"</h4></li>";

                    $('#legend-payment').append(legend);
                    if(arrr.length==carrr){
                        Morris.Donut({
                            element: 'morris-donut-chart-payment',
                            data: arrr,
                            resize: true,
                            colors:colorarr
                        });
                    }
                });
            }
        });
    });
    $('.daterange').daterangepicker();
    
   
    
    </script>