<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <?php foreach($akun as $a){?>
                <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"> <span class="hide-menu">
                    <?php if(strlen($a->username)>10) { echo substr($a->username,0,10)."..."; }else{ echo $a->username;}?></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url();?>home/profil"><i class="ti-user"></i> Profil</a></li>
                        <li><a href="javascript:void(0)"><i class="ti-email"></i> Log History</a></li>
                        <li><a href="javascript:logout();"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li class="nav-small-cap">--- Transaksi</li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>transaksi"><i class="fas fa-shopping-cart"></i><span class="hide-menu">Transaksi</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>transaksi/history"><i class="fas fa-history"></i><span class="hide-menu">History</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>topup"><i class="fas fa-upload"></i><span class="hide-menu">Top Up</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>withdraw"><i class="fas fa-download"></i><span class="hide-menu">Withdraw</span></a></li>
            </ul>
        </nav>
    </div>
</aside>