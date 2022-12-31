                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link " href="<?php echo base_url();?>home/akun" role="tab">Top Up Saldo</a> </li>
                                <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>home/history" role="tab">Riwayat Transaksi</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/setakun" role="tab">Setting Akun</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <?php foreach($akun as $a){?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <input type="hidden" id="idtrans" value="<?php echo $idtrans;?>">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>home/history">Riwayat Transaksi</a></li>
                                                <li class="breadcrumb-item"><a href="javascript:void(0)">Detail</a></li>
                                            </ol>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                Detail Transaksi 
                                            </div>
                                            <div class="card-body">
                                                <form action=""  enctype="multipart/form-data" id="formInput" method="POST" class="form-horizontal" role="form">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Akun ID</label>
                                                                <input type="text" name="akun" id="akun" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Zona</label>
                                                                <input type="text" name="zone" id="zone" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Server</label>
                                                                <input type="text" name="server" id="server" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Game</label>
                                                                <input type="text" name="game" id="game" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Nominal/Produk</label>
                                                                <input type="text" name="nominal" id="nominal" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Harga</label>
                                                                <input type="text" name="harga" id="harga" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Kode Transaksi</label>
                                                                <input type="text" name="trx_id" id="trx_id" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Email</label>
                                                                <input type="text" name="email" id="email" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Payment</label>
                                                                <input type="text" name="payment" id="payment" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div>
                                                                <label>Approve By</label>
                                                                <input type="text" name="admin" id="admin" class="form-control" readonly required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <hr>
                                            <div class="card-header">
                                                Data History Payment
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="tabletransaksi" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
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
                           