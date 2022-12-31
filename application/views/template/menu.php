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
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>dashboard"><i class="fas fa-chart-area"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="nav-small-cap">--- Master Data</li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>game"><i class="fas fa-gamepad"></i><span class="hide-menu">Game Top Up</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>voucher"><i class="fas fa-ticket-alt"></i><span class="hide-menu">Voucher</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>server"><i class="fas fa-server"></i><span class="hide-menu">Server Game</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>user"><i class="fas fa-users"></i><span class="hide-menu">User</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>rewardpoint"><i class="fas fa-gifts"></i><span class="hide-menu">Reward Point</span></a></li>
                <li class="nav-small-cap">--- Transaksi</li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>transaksi"><i class="fas fa-shopping-cart"></i><span class="hide-menu">Transaksi Top Up</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>transaksi/voucher"><i class="fas fa-shopping-cart"></i><span class="hide-menu">Transaksi Voucher</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>transaksi/history"><i class="fas fa-history"></i><span class="hide-menu">History</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>topup"><i class="fas fa-upload"></i><span class="hide-menu">Top Up</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>withdraw"><i class="fas fa-download"></i><span class="hide-menu">Withdraw</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>transaksireward"><i class="fas fa-gift"></i><span class="hide-menu">Transaki Point</span></a></li>
                <li class="nav-small-cap">--- Konten</li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>banner"><i class="fas fa-images"></i><span class="hide-menu">Banner</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>fitur"><i class="fas fa-clipboard-list"></i><span class="hide-menu">Fitur</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>news"><i class="fas fa-newspaper"></i><span class="hide-menu">News</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>kontak"><i class="fas fa-phone-square"></i><span class="hide-menu">Kontak</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>daftarreseller"><i class="fas fa-sitemap"></i><span class="hide-menu">Daftar Reseller</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>tos"><i class="fas fa-check-circle"></i><span class="hide-menu">Syarat Ketentuan</span></a></li>
                <li class="nav-small-cap">--- Pengaturan</li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>point"><i class="fas fa-poll"></i><span class="hide-menu">Setting Point</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>payment"><i class="fas fa-cash-register"></i><span class="hide-menu">Payment</span></a></li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>admin"><i class="fas fa-user-secret"></i><span class="hide-menu">Admin</span></a></li>
                <!-- <li> <a class="waves-effect waves-dark" href="<?php echo base_url();?>sistem"><i class="fas fa-box-open"></i><span class="hide-menu">Sistem</span></a></li> -->
            </ul>
        </nav>
    </div>
</aside>