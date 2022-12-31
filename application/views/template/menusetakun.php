                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/akun" role="tab">Top Up Saldo</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/point" role="tab">Point</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/history" role="tab">Riwayat Transaksi</a> </li>
                                <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>home/setakun" role="tab">Setting Akun</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="settings" role="tabpanel">
                                    <div class="card-body">
                                    <?php foreach($akun as $a){?>
                                        <form class="form-horizontal form-material" method="post" id="formakun">
                                            <div class="form-group">
                                            <input type="hidden"  id="iduser" name="iduser" value="<?php echo $a->iduser;?>" class="form-control form-control-line" required>
                                                <label class="col-md-12">Nama Lengkap</label>
                                                <div class="col-md-12">
                                                    <input type="text"  id="nama" name="nama" value="<?php echo $a->nama;?>" class="form-control form-control-line" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email"  id="email" name="email" value="<?php echo $a->email;?>" class="form-control form-control-line" name="example-email" id="example-email" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Nomor Whatsapp</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder=""  id="nowa" name="nowa"  value="<?php echo $a->nowa;?>" class="form-control form-control-line" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                    <input type="password"  id="password" name="password" class="form-control form-control-line">
                                                    <small id="warningpasswd" class="form-control-feedback" style="display:none;">Password harus sama</small>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Ulangi Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" id="repassword" name="repassword" class="form-control form-control-line">
                                                    <small id="warningrepasswd" class="form-control-feedback" style="display:none;">Password harus sama</small>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success" type="submit" id="btnUpdate" >Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>