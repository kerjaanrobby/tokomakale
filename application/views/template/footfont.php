<footer class="footer">
                    <div class="fix-width">
                        <div class="row">
                            <div class="col-md-3 col-sm-6"><img src="<?php echo base_url();?>assets/image/<?php echo $logo;?>" width="80"/>
                                <p class="m-t-30">
                                    <font class="text-white"><?php echo $nameapp;?></font> topup kredit game terlengkap di indonesia.
                                    
                                </p>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                &nbsp;
                            </div>
                            <div class="col-md-3 col-sm-6">

                            </div>
                            <div class="col-md-3 col-sm-6">
                                <ul class="footer-link list-icons">
                                    <li><a href="<?php echo base_url();?>kemitraanreseller"><i class="ti-angle-right text-megna"></i> Kemitraan Reseller</a></li>
                                    <li><a href="<?php echo base_url();?>syaratketentuan"><i class="ti-angle-right text-megna"></i> Syarat & Ketentuan</a></li>
                                    <li><a href="<?php echo base_url();?>hubungikami"><i class="ti-angle-right text-megna"></i> Hubungi Kami</a></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-9 sub-footer">
                                <span>Copyright 2021. All Rights Reserved by <a class="text-white" href="<?php echo base_url();?>"><?php echo $nameapp;?></a></span>
                            </div>
                            <div class="col-md-3 sub-footer">
                                <div class="row center">
                                    <div class="col-sm-3">
                                        <i class="fab fa-instagram fa-lg"></i>
                                    </div>
                                    <div class="col-sm-3">
                                        <i class="fab fa-facebook fa-lg"></i>
                                    </div>
                                    <div class="col-sm-3">
                                        <i class="fab fa-twitter fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!--Start of Tawk.to Script-->
<!--End of Tawk.to Script-->
</body>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?php echo base_url();?>assets/theme/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="<?php echo base_url();?>assets/theme/assets/node_modules/popper/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/theme/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/theme/assets/node_modules/owl.carousel/owl.carousel.js"></script>
<!-- jQuery for typing -->
<script src="<?php echo base_url();?>assets/theme/assets/node_modules/typed.js-master/dist/typed.min.js"></script>
<script src="<?php echo base_url();?>assets/theme/distlanding/js/custom.js"></script>
    <!--Wave Effects -->
<script src="<?php echo base_url();?>assets/theme/university/dist/js/waves.js"></script>
<script src="<?php echo base_url();?>assets/theme/assets/node_modules/prism/prism.js"></script>
<script src="<?php echo base_url();?>assets/theme/assets/node_modules/prism/prism.js"></script>
  

<script>
    $(function () {
        
        $(".banner-title").typed({
            strings: ["Cryptocurrency Demo Added", "Multipurpose Admin template with Bootstrap 4",
                "Build Your backend in No-Time for any plateform",
                "Powerfull webapp kit with countless features"
            ],
            typeSpeed: 100,
            loop: true
        });
    });
    function number_format (number, decimals, decPoint, thousandsSep) { 
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
        var s = ''

        var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
            .toFixed(prec)
        }

        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }
</script>

</html>