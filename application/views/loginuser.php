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
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title><?php echo $nameapp;?>- Login</title>
    
    <!-- page css -->
    <link href="<?php echo base_url(); ?>assets/theme/university/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/theme/university/dist/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
</head>

<body class="skin-default card-no-border">
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
    <section id="wrapper">
        <div class="login-register" style="background-image:url(<?php echo base_url(); ?>assets/theme/assets/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform"  method="post">
                        <h3 class="text-center m-b-20">Login</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="email" id="email" required="" placeholder="Email"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="pass" id="pass" required="" placeholder="Password"> </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <!-- <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember me</label> -->
                                    </div> 
                                    <div class="ml-auto">
                                        <a href="<?php echo base_url();?>forgetpass" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i> Lupa Password?</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded"  style="background-color: #FF8C32;border-color: #FF8C32;" type="submit">Login</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Belum punya akun ? <a href="<?php echo base_url();?>register"  class="text-warning m-l-5"><b>Daftar</b></a>
                            </div>
                        </div>
                    </form>
                </div>
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
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $(function() {
            $('#loginform').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo base_url(); ?>home/loginuserproses",
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
                                window.location.href = "<?php echo base_url(); ?>home/akun";
                            });
                        } else {
                            if(data.url!="")
                            {
                                Swal.fire({
                                    title: 'Gagal Login!',
                                    text: data.pesan,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: data.button
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = data.url;
                                        }
                                    })
                            }else{
                                Swal.fire(
                                    'Gagal Login!',
                                    data.pesan,
                                    'error'
                                );
                            }
                           
                        }
                        document.getElementById("loginform").reset();
                    }
                });
            });
        });
    </script>
    
</body>

</html>