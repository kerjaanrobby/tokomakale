                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>home/akun" role="tab">Top Up Saldo</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/point" role="tab">Point</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/history" role="tab">Riwayat Transaksi</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/setakun" role="tab">Setting Akun</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <?php foreach($akun as $a){?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <div class="card text-black bg-warning">
                                            <div class="card-header">
                                                <h4 class="m-b-0 text-white">Saldo kamu</h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title text-white"><b>Rp <?php echo number_format($a->saldo);?></b></h1>
                                            </div>
                                        </div><br>
                                        <div class="card">
                                            <div class="card-header">
                                                Top Up Saldo
                                            </div>
                                            <div class="card-body">
                                                <form class="form-horizontal form-material" id="formtopup" method="post">
                                                    <input type="hidden" id="nama" name="nama" value="<?php echo $a->nama;?>" placeholder="Minimal Top Up 30,000" class="form-control form-control-line" required>
                                                    <input type="hidden" id="email" name="email" value="<?php echo $a->email;?>" placeholder="Minimal Top Up 30,000" class="form-control form-control-line" required>
                                                    <input type="hidden" id="phone" name="phone" value="<?php echo $a->nowa;?>" placeholder="Minimal Top Up 30,000" class="form-control form-control-line" required>
                                                    <input type="hidden" id="iduser" name="iduser" value="<?php echo $a->iduser;?>" placeholder="Minimal Top Up 30,000" class="form-control form-control-line" required>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-12">Nominal Top Up</label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="nominal" name="nominal" placeholder="Minimal Top Up 30,000" class="form-control form-control-line" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-12">Pembayaran Via</label>
                                                        <div class="col-sm-12">
                                                            <select id="payment" name="payment" class="form-control form-control-line" required>
                                                                <option>Pilih payment</option>
                                                            <?php foreach($payment as $a){
                                                                if($a->via!="Ipaymu"){
                                                                ?>
                                                                <option value="<?php echo $a->via;?>" data-idpay="<?php echo $a->idpayment;?>" data-foo="<?php echo $a->fee;?>"><?php echo $a->nama;?></option>
                                                            <?php }}?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button type="submit" id="btnTopUp" class="btn btn-success">Topup Saldo</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><br>
                                        <div class="card">
                                            <div class="card-header">
                                                Riwayat Top Up Saldo
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="tabletopup" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
                                                                <th>Nominal</th>
                                                                <th>Payment</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                           