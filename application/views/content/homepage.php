    <?php echo $head;?>
    <?php 
    
    // if(($this->session->userdata("logged_in")=="yes")&&($this->session->userdata("rol")=="Reseller"))
    // {
    //     $urlgame = "game_reseller";
    // }else if($this->session->userdata("rol")=="User"){
    //     // $urlgame = "game_nonreseller";
    //     $urlgame="game_nonreseller";
    // }else{
    //     $urlgame="game";
    // }?>
    <?php $urlgame="games"; ?>

            <div class="page-wrapper" style="margin-top:-75px;background-color:#FF8C32;" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" style="background-color:#FF8C32;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                            
                                            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                <?php $no=0;
                                                    foreach($banner as $b){
                                                        $no++;
                                                ?>
                                                    <li data-target="#carouselExampleIndicators2" data-slide-to="<?php echo $no-1;?>"<?php if($no==1){ echo 'class="active"'; }?>></li>
                                                        
                                                    <?php } ?>
                                                </ol>
                                                <div class="carousel-inner" role="listbox">
                                                    <?php $no=0;
                                                        foreach($banner as $b){
                                                            $no++; 
                                                    ?>
                                                    <div class="carousel-item <?php if($no==1){ echo 'active'; };?>">
                                                        <a href="<?php echo $b->url;?>"><img style="min-width:100%;max-width:80%;max-height:300px;height:auto;min-height:0;" class="img-fluid img-responsive" src="<?php echo base_url();?>assets/image/<?php echo $b->banner;?>" alt="<?php echo $b->nama;?>" alt="First slide"></a>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="fix-width">
                                    <div class="row">
                                        <div class="col-md-12 text-center mb-5 m-t-30">
                                            <h2 class="text-white"><b>Game Pilihan</b></h2>
                                        </div>
                                        <?php foreach($gamepop as $g){?>
                                        <div class="col-md-3 col-sm-4 col-xs-6 col-6 m-b-40 text-center">
                                            <div class="white-box" style="border-radius: 5%;" >
                                                <img style="border-radius: 5%;" src="<?php echo base_url();?>assets/image/<?php echo $g->icon;?>" class="img-responsive" width="90%">
                                                <div class="img-ovrly"><a class="btn btn-rounded btn-warning"  style="background-color: #FF8C32;border-color: #FF8C32;"
                                                        href="<?php echo base_url();?>shop/<?php echo $urlgame;?>/<?php echo $g->idgame;?>">Lihat Detail</a></div>
                                            </div>
                                            <h5 class="m-t-20 text-title text-white"><?php echo $g->nama;?></h5>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 text-center mb-5 m-t-30">
                                            <h2 class="text-white"><b>Top Up Game</b></h2>
                                        </div>
                                        <?php foreach($game as $g){?>
                                        <div class="col-md-3 col-sm-4 col-xs-6 col-6 m-b-40  text-center">
                                            <div class="white-box">
                                                <img style="border-radius: 5%;"  src="<?php echo base_url();?>assets/image/<?php echo $g->icon;?>" class="img-responsive" width="90%">
                                                <div class="img-ovrly">
                                                <?php if($g->kategori == "Voucher"){?>
                                                    <a class="btn btn-rounded btn-info"  style="background-color: #FF8C32;border-color: #FF8C32;" href="<?php echo base_url();?>shop/game_voucher/<?php echo $g->idgame;?>">Lihat Detail</a>
                                                <?php }else{ ?>
                                                    <a class="btn btn-rounded btn-info"  style="background-color: #FF8C32;border-color: #FF8C32;" href="<?php echo base_url();?>shop/<?php echo $urlgame;?>/<?php echo $g->idgame;?>">Lihat Detail</a>
                                                <?php } ?>
                                                
                                                </div>
                                            </div>
                                            <h5 class="m-t-20 text-title text-white"><?php echo $g->nama;?></h5>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="fix-width">
                                <div class="col-md-12 text-center mb-5 m-t-30">
                                    <h2 class="text-white"><b>Berita Terbaru dari kami</b></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="fix-width top-features m-t-20">
                                <div id="owl-demo2" class="owl-carousel owl-theme">
                                    <?php foreach($news as $n){?>
                                    <div class="item">
                                        <small class="text-info"><?php echo $n->tanggalf;?></small>
                                        <h3 class="text-white"><?php echo $n->judul;?></h3>
                                        <p class="text-white"><?php echo substr($n->isi,0,100)."...";?></p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php echo $footer;?>

    <script src="<?php echo base_url();?>assets/theme/assets/node_modules/prism/prism.js"></script>
  

    <!-- Typehead Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/theme/assets/node_modules/typeahead.js-master/dist/typeahead.bundle.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/theme/assets/node_modules/typeahead.js-master/typeahead.init.js"></script> -->
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
                    
                    suggestion:Handlebars.compile('<div onclick="direct({{idgame}})" class="row"><div class="col-md-2" style=""><img src="assets/image/{{icon}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="margin-top:-8px;"><br><h4>{{nama}}</h4></div></div>')
                }
            });
        });
        function direct(idgame)
        {
            location.href='<?php echo base_url();?>shop/game/'+idgame;
        }
    </script>