<ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link " href="<?php echo base_url();?>home/akun" role="tab">Top Up Saldo</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/point" role="tab">Point</a> </li>
                                <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>home/history" role="tab">Riwayat Transaksi</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/setakun" role="tab">Setting Akun</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <?php foreach($akun as $a){?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <div class="card">
                                            <div class="card-header">
                                                Riwayat 
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                <input type="hidden" id="iduser" name="iduser" value="<?php echo $a->iduser;?>" placeholder="Minimal Top Up 30,000" class="form-control form-control-line" required>

                                                    <table id="tablehistory" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
                                                                <th>Game</th>
                                                                <th>Produk</th>
                                                                <th>Payment</th>
                                                                <th>Harga</th>
                                                                <th>Status</th>
                                                                <th class="text-center"><i class="fa fa-cog"></i></th>
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
                           