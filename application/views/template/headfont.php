<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <!-- meta tag https://www.tokopetanionline.com/assets/image/metatag.jpeg

title : tokopetanionline pusat topup game
keywords : topup game, top up game mobile, topup murah , beli diamond mlbb, beli diamond freefire, tokopetanionline, topup murah , isi diamond, isi chip
description : tokopetanionline adalah pusat topup game online yang mudah dan murah dengan proses cepat,menerima berbagai media pembayaran -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="tokopetanionline adalah pusat topup game online yang mudah dan murah dengan proses cepat,menerima berbagai media pembayaran">
    <meta name="author" content="">
    <meta name="keywords" content="topup game, top up game mobile, topup murah , beli diamond mlbb, beli diamond freefire, tokopetanionline, topup murah , isi diamond, isi chip"/>
  
  	<meta property="og:url" content="https://www.tokopetanionline.com/" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="TOPUP Game TokoPetaniOnline" />
	<meta property="og:description" content="tokopetanionline adalah pusat topup game online yang mudah dan murah dengan proses cepat,menerima berbagai media pembayaran" />
	<meta property="og:image" content="http://www.tokopetanionline.com/assets/image/metatag.jpeg" />
  
    <meta property="og:image" content="https://www.tokopetanionline.com/assets/image/metatag.jpeg" />
    <meta property="og:image:secure_url" content="https://www.tokopetanionline.com/assets/image/metatag.jpeg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="1280" />
    <meta property="og:image:height" content="668" />
  
  
  
  <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/image/<?php echo $favicon;?>">

    <link href="<?php echo base_url();?>assets/theme/assets/node_modules/prism/prism.css" rel="stylesheet">
    <title><?php echo $nameapp;?></title>
    <link href="<?php echo base_url();?>assets/theme/assets/node_modules/prism/prism.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>assets/theme/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>assets/theme/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- This page CSS -->
    <link href="<?php echo base_url();?>assets/theme/assets/node_modules/owl.carousel/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/theme/assets/node_modules/owl.carousel/owl.theme.default.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/theme/distlanding/css/style.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/theme/assets/node_modules/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    .navbar {
    -webkit-box-shadow: 0 8px 6px -6px #999;
    -moz-box-shadow: 0 8px 6px -6px #999;
    box-shadow: 0 8px 6px -6px #999;

    /* the rest of your styling */
}
/* .carousel-item {
  height: 400px;
}

.carousel-item img {
    position: absolute;
    top: 0;
    left: 0;
    min-height: 400px;
} */
.box
 {
  width:100%;
  max-width: 650px;
  margin:0 auto;
 }
.carousel-item .img-fluid {

}
.carousel-item a {
  /* display: block; */
  /* width:100%; */
}
</style>
 <script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
</head>

<body>
    <div id="main-wrapper">
        <div class="container-fluid">
            <div class="navbar-fixed">
                <nav class="navbar navbar-expand-md navbar-light bg-white" style="padding-left:100px; padding-right:100px;">
                    <a class="navbar-brand" href="<?php echo base_url();?>">
                        <img src="<?php echo base_url();?>assets/image/<?php echo $logo;?>" alt="logo" width="100">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="col-sm-2">
                        
                        </div>
                        <div class="col-sm-6">
                        <!-- <div id="default-suggestions"> -->
                        <div id="prefetch">
                            <input type="text" name="search_box" id="search_box" class="form-control input-lg typeahead" placeholder="Search Here" />
                        </div>
                        <!-- </div> -->
                        </div>
                        <ul class="navbar-nav ml-auto">
                            <?php if(($this->session->userdata("logged_in")=="yes")&&(($this->session->userdata("rol")=="User")||($this->session->userdata("rol")=="Reseller")||($this->session->userdata("rol")=="VVIP"))){?>
                            <li class="nav-item">
                                <a href="<?php echo base_url();?>akun"  style="background-color: #FF8C32;border-color: #FF8C32;" class="btn btn-warning btn-rounded cs-btn">Akun</a>
                            </li>
                            <?php }else{ ?>
                            <li class="nav-item">
                                <!-- <a href="<?php echo base_url();?>" class="btn btn-primary btn-rounded cs-btn">Login/Register</a> -->
                                <a href="<?php echo base_url();?>loginuser"  style="background-color: #FF8C32;border-color: #FF8C32;" class="btn btn-warning btn-rounded cs-btn">Login/Register</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </div>