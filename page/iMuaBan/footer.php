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
                                    <li><i class="fas fa-map-marker-alt"></i>viabm.store - Hà Nội</li>
                                    <li><i class="fas fa-phone"></i><a href="tel:+84378199999" data-wpel-link="internal">LH: 03781.99999</a>
                                    </li>
                                    <li><strong>Giờ Hoạt Động:</strong>
                                        <br>8h - 23h Hàng ngày</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <h5 class="widget-title">
                                <span>Links</span>
                                <i></i>
                            </h5>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    <li><a href="#" data-wpel-link="internal">Liên kết</a></li>
                                    <li><a href="#" data-wpel-link="internal">Liên kết</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 footer-column">
                        <div class="subscribe-widget footer-widget wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <h3 class="widget-title">
                                <span>Socials</span>
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
<script type='text/javascript' src='js/kk-star-ratingsa352.js?ver=4.1.3'></script>
<script type='text/javascript' src='js/wp-embed.minca80.js?ver=4.9.15'></script>
<script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
</script>
<script data-ad-client="ca-pub-5210489224967357" async src="../../pagead2.googlesyndication.com/pagead/js/f.txt"></script>
</html>