<!-- main-footer -->
<footer class="main-footer">
    <div class="footer-top">
        <div id="starshine">
            <div class="shine shine shine-1"></div>
            <div class="shine shine shine-2"></div>
        </div>
        <div class="bg-layer" style="background-image: url(<?=BASE_URL('page/iMuaBan/');?>img/pattern-6.png);"></div>
        <div class="auto-container">
            <div class="widget-section">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="logo-widget footer-widget wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <figure class="footer-logo">
                                <a href="#" data-wpel-link="internal">
                                    <img src="<?=$CMSNT->site('logo');?>" height="45" alt="">
                                </a>
                            </figure>
                            <div class="widget-content">
                                <ul class="clearfix">
                                    <li><i class="fas fa-map-marker-alt"></i><?=langByVn('viabm.store - Hà Nội');?></li>
                                    <li><i class="fas fa-phone"></i><a href="tel:+84378199999" data-wpel-link="internal"><?=langByVn('Liên hệ');?>: 03781.99999</a>
                                    </li>
                                    <li><strong><?=langByVn('Giờ Hoạt Động');?>:</strong>
                                        <br><?=langByVn('8h - 23h Hàng ngày');?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <h5 class="widget-title">
                                <span><?=langByVn('Liên kết');?></span>
                                <i></i>
                            </h5>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    <li><a href="<?=BASE_URL('Auth/Login');?>" data-wpel-link="internal"><?=langByVn('Dịch Vụ Mua Bán');?></a></li>
                                    <li><a href="<?=BASE_URL('blogs');?>" data-wpel-link="internal"><?=langByVn('Tin tức');?></a></li>
                                    <li><a href="<?=BASE_URL('Auth/Login');?>" data-wpel-link="internal"><?=langByVn('Đăng Nhập');?></a></li>
                                    <li><a href="<?=BASE_URL('Auth/Register');?>" data-wpel-link="internal"><?=langByVn('Đăng ký');?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 footer-column">
                        <div class="subscribe-widget footer-widget wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <h3 class="widget-title">
                                <span><?=langByVn('Mạng xã hội');?></span>
                                <i></i>
                            </h3>
                            <ul class="social-links clearfix">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                                <li><a href="#"><i class="fab fa-skype"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <div class="auto-container">
            <div class="copyright">
                <p>2020 &copy; Design by <a href="#" data-wpel-link="internal">viabm.store</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- main-footer end -->
<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html"> <span class="fa fa-arrow-up"></span>
</button>
<!-- jequery plugins -->
<script src="<?=BASE_URL('page/iMuaBan/');?>js/jquery.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/popper.min.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/bootstrap.min.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/owl.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/wow.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/validation.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/jquery.fancybox.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/appear.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/scrollbar.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/isotope.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/parallax.min.js"></script>
<script src="<?=BASE_URL('page/iMuaBan/');?>js/tilt.jquery.js"></script>
<!-- main-js -->
<script src="<?=BASE_URL('page/iMuaBan/');?>js/script.js"></script>
<script>
    $(function () {
        $(".news-block-pa").slice(0, 6).show();
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $(".news-block-pa:hidden").slice(0, 6).slideDown();
            if ($(".news-block-pa:hidden").length == 0) {
                $("#load").fadeOut('slow');
            }
            $('html,body').animate({
                scrollTop: $(this).offset().bottom
            }, 1500);
        });
    });
</script>
</body>
<script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
</script>
</html>