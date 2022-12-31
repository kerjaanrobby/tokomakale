<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/image/<?php echo $favicon; ?>">
    <title><?php echo $nameapp; ?></title>

    <!-- page css -->
    <link href="<?php echo base_url(); ?>assets/theme/university/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/theme/university/dist/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"><?php echo $instansi; ?></p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(<?php echo base_url(); ?>assets/theme/assets/images/background/bgloginbahtera.webp);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material text-center" id="loginform" method="post">
                    <a href="javascript:void(0)" class="db"><img width="100" src="<?php echo base_url(); ?>assets/image/<?php echo $logo; ?>" alt="Home" /><br /></a>
                    <p><?php echo $nameapp; ?><br></p>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" required="" name="email" id="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" name="pass" id="pass" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <!-- <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember me</label> -->
                                </div>
                                <div class="ml-auto">
                                    <a href="javascript:void(0)" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i> Lupa Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(); ?>assets/theme/dist/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/theme/dist/assets/node_modules/popper/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/theme/dist/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        // Swal.fire(
        //                         'Gagal Login!',
        //                         "coba aja",
        //                         'warning'
        //                     );
        $(function() {
            $(".preloader").fadeOut();
        });
        // $(function() {
        //     $('[data-toggle="tooltip"]').tooltip()
        // });
        $(function() {
            $('#loginform').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo base_url(); ?>home/loginproses",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.hasil=="1") {
                            Swal.fire(
                                'Berhasil Login!',
                                data.pesan,
                                'success'
                            ).then(function() {
                                window.location.href = "<?php echo base_url(); ?>home/dashboard";
                            });
                        } else {
                            Swal.fire(
                                'Gagal Login!',
                                data.pesan,
                                'error'
                            );
                        }
                        document.getElementById("formLogin").reset();
                    }
                });
            });
        });
    </script>

</body>

</html>