<ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/akun" role="tab">Top Up Saldo</a> </li>
                                <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>home/point" role="tab">Point</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/history" role="tab">Riwayat Transaksi</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/setakun" role="tab">Setting Akun</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <?php foreach($akun as $a){?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                <?php foreach($akun as $a){?>
                                <input type="hidden"  id="iduser" name="iduser" value="<?php echo $a->iduser;?>" class="form-control form-control-line" required>
                                <?php } ?>
                                    <div class="card-body">
                                        <div class="card text-white bg-warning">
                                            <div class="card-header">
                                                <h4 class="m-b-0 text-black">Point Kamu</h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title text-white" id="jumlahpoint"><b><?php echo $point;?></b></h1>
                                            </div>
                                        </div><br>
                                        <div class="card">
                                            <div class="card-header">
                                                Pilih Item untuk ditukar dengan point
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                <table id="tablereward" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Point</th>
                                                            <th class="text-center"><i class="fa fa-cog"></i></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="card">
                                            <div class="card-header">
                                                Riwayat Tukar Point
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                <table id="tableredeem" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>Item</th>
                                                            <th>Point</th>
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
                           