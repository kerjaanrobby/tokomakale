
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Profile</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <?php foreach($akun as $a){?>
                    <div class="card">
                        <div class="card-body">
                            <center class="m-t-30"> 
                                <h4 class="card-title m-t-10"><?php echo $a->username;?></h4>
                                <h6 class="card-subtitle"><?php echo $a->level;?></h6>
                            </center>
                        </div>
                        <div>
                            <hr> 
                            <div class="card-body"> 
                                <small class="text-muted">Email address </small>
                                <h6><?php echo $a->email;?></h6>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                        </ul>
                        <div class="tab-content">
                            <?php foreach($akun as $a){?>
                            <div class="tab-pane active" id="settings" role="tabpanel">
                                <form class="form-horizontal form-material" id="formProfil">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="col-md-12">Nama Lengkap</label>
                                            <div class="col-md-12">
                                                <input type="hidden" id="idadmin" name="idadmin" placeholder="Nama Lengkap" value="<?php echo $a->idadmin;?>" class="form-control form-control-line">
                                                <input type="text" id="username" name="username" placeholder="Nama Lengkap" value="<?php echo $a->username;?>" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $a->email;?>" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Password</label>
                                            <div class="col-md-12">
                                                <input type="password" id="password" name="password" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-sm btn-info">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            </div>
<?php echo $foot;?>
<script>
        $(function () {
            $('#formProfil').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php  echo base_url(); ?>home/updateprofile",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType:'json', 
                    success: function(data){
                        if(data.hasil==1){
                            Swal.fire({
                                icon: 'success',
                                title: data.pesan,
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: data.pesan,
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function(){
                                window.location.reload();
                                modal.modal('hide');
                            })
                        }
                        
                    }   
                });
            });
        });
</script>
</body>

</html>
