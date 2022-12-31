<?php echo $head;?>
    <?php 
    
    if(($this->session->userdata("logged_in")=="yes")&&($this->session->userdata("rol")=="Reseller"))
    {
        $urlgame = "game_reseller";
    }else if($this->session->userdata("rol")=="User"){
        // $urlgame = "game_nonreseller";
        $urlgame="game_nonreseller";
    }else{
        $urlgame="game";
    }?>
            <div class="page-wrapper" style="margin-top:-75px;" >
                <div class="container-fluid">
                    
                    <div class="row m-t-40">
                        <div class="col-md-12 m-t-40 m-b-40">
                            <div class="fix-width">
                                <div class="text-center">
                                    <h2 class="text-title">Syarat & Ketentuan</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fix-width">
                        <div class="row m-t-10 v-top">
                            <?php foreach($tos as $t){?>
                            <!-- .col -->
                            <div class="col-md-12 col-sm-12 text-left">
                                <h4 class="text-title"></h4>
                                <p><?php echo $t->text;?></p>
                            </div>
                            <?php } ?>
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