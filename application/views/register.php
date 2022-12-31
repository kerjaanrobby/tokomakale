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
    <title><?php echo $nameapp;?>- Register</title>
    
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
                    <form class="form-horizontal form-material" id="registerform" method="post">
                        <h3 class="text-center m-b-10">Register</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="email" id="email" required="" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="nama" id="nama" required="" placeholder="Nama Lengkap">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="nowa" id="nowa" required="" placeholder="Nomor Whatsapp">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" id="password" required="" placeholder="Password">
                                <small id="warningpasswd" class="form-control-feedback" style="display:none;">Password harus sama</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="repassword" id="repassword" required="" placeholder="Ulangi Password">
                                <small id="warningrepasswd" class="form-control-feedback" style="display:none;">Password harus sama</small>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-0">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" id="btnRegister"  style="background-color: #FF8C32;border-color: #FF8C32;" type="submit">Register</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Sudah punya akun ? <a href="<?php echo base_url();?>loginuser"  style="color: #FF8C32 !important;;" class="text-info m-l-5"><b>Login</b></a>
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
        $("#password").on('input',function(){
            var pass = this.value;
            var repass = $("#repassword").val();
            if(pass!=repass)
            {
                document.getElementById("btnRegister").disabled=true;
                document.getElementById("warningpasswd").style.display="unset";
                document.getElementById("warningrepasswd").style.display="unset";
                
            }else{
                document.getElementById("btnRegister").disabled = false;
                document.getElementById("warningpasswd").style.display="none";
                document.getElementById("warningrepasswd").style.display="none";

            }
        });
        $("#repassword").on('input',function(){
            var repass = this.value;
            var pass = $("#password").val();
            if(pass!=repass)
            {
                document.getElementById("btnRegister").disabled=true;
                document.getElementById("warningpasswd").style.display="unset";
                document.getElementById("warningrepasswd").style.display="unset";
                
            }else{
                document.getElementById("btnRegister").disabled = false;
                document.getElementById("warningpasswd").style.display="none";
                document.getElementById("warningrepasswd").style.display="none";

            }
        });
        $(function() {
            $('#registerform').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo base_url(); ?>home/prosesregister",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.hasil=="1") {
                            Swal.fire(
                                'Berhasil Register!',
                                data.pesan,
                                'success'
                            ).then(function() {
                                window.location.href = "<?php echo base_url(); ?>loginuser";
                            });
                        } else {
                            Swal.fire(
                                'Gagal Register!',
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