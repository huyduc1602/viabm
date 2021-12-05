<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?=$CMSNT->site('tenweb');?></title>
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <meta name="description" content="<?=$CMSNT->site('mota');?>">
    <meta name="keywords" content="<?=$CMSNT->site('tukhoa');?>">
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <!-- Open Graph data -->
    <meta property="og:title" content="<?=$CMSNT->site('tenweb');?>">
    <meta property="og:type" content="Website">
    <meta property="og:url" content="<?=BASE_URL('');?>">
    <meta property="og:image" content="<?=$CMSNT->site('anhbia');?>">
    <meta property="og:description" content="<?=$CMSNT->site('mota');?>">
    <meta property="og:site_name" content="<?=$CMSNT->site('tenweb');?>">
    <meta property="article:section" content="<?=$CMSNT->site('mota');?>">
    <meta property="article:tag" content="<?=$CMSNT->site('tukhoa');?>">
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="<?=$CMSNT->site('anhbia');?>">
    <meta name="twitter:site" content="CMSNT">
    <meta name="twitter:title" content="<?=$CMSNT->site('tenweb');?>">
    <meta name="twitter:description" content="<?=$CMSNT->site('mota');?>">
    <meta name="twitter:creator" content="CMSNT">
    <meta name="twitter:image:src" content="<?=$CMSNT->site('anhbia');?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=$CMSNT->site('favicon');?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=$CMSNT->site('favicon');?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$CMSNT->site('favicon');?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=$CMSNT->site('favicon');?>">
    <meta name="theme-color" content="#ffffff">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=281459696201789&autoLogAppEvents=1"
            nonce="Zqk3CX9Z"></script>

    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
<!--    <link rel='stylesheet' id='kk-star-ratings-css' href='css/kk-star-ratingsa352.css?ver=4.1.3' type='text/css' media='all'>-->
    <style id='kk-star-ratings-inline-css' type='text/css'>
        .kk-star-ratings .kksr-stars .kksr-star {
            margin-right: 5px;
        }
        [dir="rtl"] .kk-star-ratings .kksr-stars .kksr-star {
            margin-left: 5px;
            margin-right: 0;
        }
    </style>
    <style id='ez-toc-inline-css' type='text/css'>
        div#ez-toc-container p.ez-toc-title {font-size: 120%;}div#ez-toc-container p.ez-toc-title {font-weight: 500;}div#ez-toc-container ul li {font-size: 95%;}
    </style>
    <script>
        document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );
    </script>
    <!-- Hiện không có phiên bản amphtml nào cho URL này. -->
    <meta name="p:domain_verify" content="">
    <!-- Fav Icon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Stylesheets -->
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/font-awesome-all.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/flaticon.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/owl.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/animate.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/imagebg.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/color.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/blog.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/style.css" rel="stylesheet">
    <link href="<?=BASE_URL('page/iMuaBan/');?>css/responsive.css" rel="stylesheet">
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="<?=BASE_URL('page/JoBest/');?>assets/css/theme.css" rel="stylesheet" />
</head>
<!-- page wrapper -->

<body class="boxed_wrapper">
<!-- preloader -->
<div class="preloader"></div>
<!-- preloader -->
<!-- search-popup -->
<div id="search-popup" class="search-popup">
    <div class="close-search"><span><?=langByVn('Đóng');?></span>
    </div>
    <div class="popup-inner">
        <div class="overlay-layer"></div>
        <div class="search-form">
            <form role="search" method="get" class="search-form" action="<?=BASE_URL('/');?>">
                <div class="form-group">
                    <fieldset>
                        <input type="search" search-form-1 class="form-control" name="search-input" value="" placeholder="<?=langByVn('nhập nội dung tìm kiếm');?>" name="s" required>
                        <input type="submit" value="<?=langByVn('Tìm kiếm');?>" class="theme-btn style-four">
                    </fieldset>
                </div>
            </form>
            <h3><?=langByVn('Từ khoá tìm kiếm nhiều');?></h3>
            <ul class="recent-searches">
                <li><a href=""<?=BASE_URL('/');?>" data-wpel-link="internal"><?=langByVn('viabm.store');?></a>
                </li>
                <li><a href=""<?=BASE_URL('/');?>" data-wpel-link="internal"><?=langByVn('Mua bán Viabm');?></a>
                </li>
                <li><a href=""<?=BASE_URL('/');?>" data-wpel-link="internal"><?=langByVn('Mua Bán BM');?></a>
                </li>
                <li><a href=""<?=BASE_URL('/');?>" data-wpel-link="internal"><?=langByVn('Mua Bán Clone');?></a>
                </li>
                <li><a href=""<?=BASE_URL('/');?>" data-wpel-link="internal"><?=langByVn('Mua Bán Mail');?></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- search-popup end -->
<!-- main header -->
<header class="main-header">
    <div class="auto-container">
        <div class="header-upper">
            <div class="outer-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo">
                        <a href="<?=BASE_URL('/');?>" data-wpel-link="internal">
                            <img src="<?=$CMSNT->site('logo');?>" alt="">
                        </a>
                    </figure>
                </div>
                <div class="nav-box pull-right clearfix">
                    <div class="menu-area pull-left">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"> <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="current"><a href="/" data-wpel-link="internal"> <?=langByVn('Trang chủ');?></a>
                                    </li>
                                    <li class="dropdown"><a href="#" data-wpel-link="internal"> <?=langByVn('Dịch Vụ Mua Bán');?></a>
                                        <ul>
                                            <li><a href="<?=BASE_URL('Auth/Login');?>" data-wpel-link="internal"> <?=langByVn('Dịch Vụ Link BM');?></a>
                                            </li>
                                            <li><a href="<?=BASE_URL('Auth/Login');?>" data-wpel-link="internal"> <?=langByVn('Dịch Vụ Clone');?></a>
                                            </li>
                                            <li><a href="<?=BASE_URL('Auth/Login');?>" data-wpel-link="internal"> <?=langByVn('Dịch Vụ Mail');?></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="<?=BASE_URL('blogs');?>" data-wpel-link="internal"><?=langByVn('Tin tức');?></a></li>
                                    <li><a href="<?=BASE_URL('Auth/Login');?>" data-wpel-link="internal"><i class="fas fa-user"></i> <?=langByVn('Đăng nhập');?></a></li>
                                    <li><a href="<?=BASE_URL('Auth/Register');?>" data-wpel-link="internal"><i class="fas fa-user-plus"></i> <?=langByVn('Đăng ký');?></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="menu-right-content pull-left">
                        <div class="search-box-outer">
                            <div class="search-btn">
                                <button type="button" class="search-toggler"><span class="fas fa-search"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--sticky Header-->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <figure class="logo-box">
                <a href="#" data-wpel-link="internal">
                    <img class="logobox" src="<?=$CMSNT->site('logo');?>" alt="">
                </a>
            </figure>
            <div class="menu-area">
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->
<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i>
    </div>
    <nav class="menu-box">
        <div class="nav-logo">
            <a href="index-2.html" data-wpel-link="internal">
                <img src="<?=$CMSNT->site('logo');?>" alt="" title="">
            </a>
        </div>
        <div class="menu-outer">
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="contact-info">
            <h4>viabm.store</h4>
            <ul>
                <li>LH:<a href="tel:+84378199999" data-wpel-link="internal"> 03781.99999</a>
                </li>
                <li>Email: <a href="mailto:kevin97.digital@gmail.com">kevin97.digital@gmail.com</a>
                </li>
                <li>Facebook: <a href="https://www.facebook.com/kevinpham.digital" rel="nofollow external noopener noreferrer" data-wpel-link="external" target="_new">Kevin Phạm</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- End Mobile Menu -->