<?php echo $head;?>
        <div class="page-wrapper" style="margin-top:-50px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <?php foreach($datatrans as $dt){?>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <p class="text-muted m-l-5">
                                                Email                : <?php echo $dt->email;?>
                                                <br/> Kode Transaksi : <?php echo $dt->kode;?>
                                                <br/> Tanggal        : <?php echo $dt->tanggalf;?>
                                            </p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
                                            Status : 
                                            <?php if($dt->status=="Belum Bayar"){?>
                                                <label class="label label-warning">Belum Bayar</label>
                                            <?php }else if($dt->status=="Sudah Bayar"){?>
                                                <label class="label label-success">Sudah Bayar</label>
                                            <?php }else if($dt->status=="Selesai"){?>
                                                <label class="label label-info">Selesai</label>
                                            <?php } else {?>
                                                <label class="label label-danger">Undifined</label>
                                            <?php } ?>
                                            
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Nominal</th>
                                                    <th class="text-right">Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center"><?php echo $dt->nama;?></td>
                                                    <td class="text-center">Rp <?php echo number_format($dt->topup-$dt->fee);?></td>
                                                    <td class="text-right"> Rp <?php echo number_format($dt->topup);?> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6  col-6">
                                            <p>Pembayaran melalui QIRS dapat melalui link <a href="<?php echo $dt->linkpayment;?>" target="_blank" >Link Pembayaran</a>
                                            </p>
                                        </div>
                                        <div class="col-sm-6 col-xs-6  col-6">
                                            <div class="pull-right m-t-30 text-right">
                                                <p>Harga: Rp. <?php echo number_format($dt->topup-$dt->fee);?></p>
                                                <p>Fee : <?php echo number_format($dt->fee);?> </p>
                                                <hr>
                                                <h3><b>Total Bayar : Rp. <?php echo number_format($dt->topup);?></b></h3>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="clearfix"></div>
                                    <div class="text-right">
                                        <!-- <button class="btn btn-danger" type="submit"> Proceed to payment </button> -->
                                        <button id="print" onclick="cetak()" class="btn btn-info" type="button"> <span><i class="fa fa-print"></i> Cetak Invoice</span> </button>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

<br>
    <script>
        function cetak(){
            window.print();
        }
        </script>
<?php echo $footer;?>
<script src="<?php echo base_url();?>assets/theme/assets/node_modules/typeahead.js-master/dist/typeahead.bundle.min.js"></script>
        <script>
        $(document).ready(function(){
            var sample_data = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch:'<?php echo base_url(); ?>home/datagamelist',
                remote:{
                    url:'<?php echo base_url(); ?>home/datagamelist/%QUERY',
                    wildcard:'%QUERY'
                }
            });
            

            $('#prefetch .typeahead').typeahead(null, {
                name: 'sample_data',
                display: 'nama',
                source:sample_data,
                limit:10,
                templates:{
                    
                    suggestion:Handlebars.compile('<div onclick="direct({{idgame}})" class="row"><div class="col-md-2" style=""><img src="<?php echo base_url();?>/assets/image/{{icon}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="margin-top:-8px;"><br><h4>{{nama}}</h4></div></div>')
                }
            });
        });
        function direct(idgame)
        {
            location.href='<?php echo base_url();?>shop/game/'+idgame;
        }
    </script>