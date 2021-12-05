<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
?>
<?php
$limit = 4;
$blogs = $CMSNT->get_list(" SELECT * FROM `blog`  ORDER BY updatedDate DESC LIMIT ".$limit." OFFSET 0");
$numberPage = count($CMSNT->get_list(" SELECT * FROM `blog`"));
if($numberPage > $limit){
    $numberPage = ceil($numberPage/$limit);
}else{
    $numberPage = 0;
}
$page = 1;
if(isset($_GET['page'])){
    $page = $_GET['page'];
    $offset = 0;
    if($page > 1){
        $offset = ($page-1)*$limit;
    }
    $blogs = $CMSNT->get_list("SELECT * FROM `blog`  ORDER BY updatedDate DESC LIMIT ".$limit." OFFSET ".$offset);
}
?>
<?php include 'header.php';?>
    <div class="hero-wrap js-fullheight" style="background-image: url(<?=BASE_URL('page/iMuaBan/');?>/img/abadan-the-right-partner.jpg); background-position: 50% 0px;" data-stellar-background-ratio="0.5" id="banner-blog">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true" style="height: 296px;">
                <div class="col-md-12 ftco-animate fadeInUp ftco-animated content-banner">
                    <h1 class="mb-4 mb-md-0 mt-8"><?=langByVn('Tin tức');?></h1>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="text-banner">
                                <p><?=langByVn('Bán Clone Facebook - Hệ thống bán Clone Trên Toàn Thế Giới , Thẻ Ngoại Chạy Quảng Cáo Facebook');?></p>
                                <p><?=langByVn('Mua bán BM Facebook, BM Limit 50$, BM Limit 350$, BM 5TKQC, BM Xác minh doanh nghiệp');?></p>
                                <div class="mouse">
                                    <a href="#" class="mouse-icon">
                                        <div class="mouse-wheel">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section" id="section-blog">
        <div class="container">
            <input type="hidden" id="page" value="<?=$page;?>">
            <div class="row">
                <div class="col-md-12">
             <?php if(count($blogs) > 0){
                    foreach ($blogs as $row){ ?>
                    <div class="case item-blog">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-8 d-flex">
                                <a href="/blog/<?=$row['slug'];?>" class="img w-100 mb-3 mb-md-0" style="background-image:url(<?=$row['image'];?>)"></a>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4 d-flex">
                                <div class="text w-100 pl-md-3">
                                    <?php
                                        $category = $CMSNT->get_row("SELECT * FROM category_blog WHERE id = ".$row['categoryId']);
                                        if(count($category) > 0){
                                            $category['name'] = selectTableLang('category_blog','name',$row['categoryId'],$category['name']);
                                        }else{
                                            $category['name'] = 'Uncategorized';
                                        }
                                        $last_read = $row['last_read'];
                                        if($last_read == $row['createdDate']){
                                            $last_read = "Đã đọc 1 ".langByVn('phút trước');
                                        }
                                        $name = selectTableLang('blog','name',$row['id'],$row['name']) ?? '';
                                        $sumary = selectTableLang('blog','name',$row['id'],$row['sumary']) ?? '';
                                        if(strlen($row['sumary']) > 150){
                                            $sumary = substr($row['sumary'],0,150).'...';
                                        }
                                    ?>
                                    <span class="subheading"><?=selectTableLang('category_blog','name',$row['id'],$category['name'])?></span>
                                    <h2><a href="blog/<?=$row['slug'];?>"><?=$name;?></a></h2>
                                    <p class="text-description"><?=$sumary;?></p>
                                    <ul class="media-social list-unstyled">
                                        <li class="ftco-animate fadeInUp ftco-animated"><a href="#"><span><i class="fab fa-twitter"></i></span></a></li>
                                        <li class="ftco-animate fadeInUp ftco-animated"><a href="#"><span><i class="fab fa-facebook-f"></i></span></a></li>
                                        <li class="ftco-animate fadeInUp ftco-animated"><a href="#"><span><i class="fab fa-instagram"></i></span></a></li>
                                    </ul>
                                    <div class="meta">
                                        <p class="mb-0"><a href="javacript:void(0);"><?=date_format(date_create($row['createdDate']),"d/m/Y");?></a> | <a href="#"><?=$last_read;?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
             <?php }else{ ?>
                 <h4 class="text-center"><?=langByVn('Chưa có bài viết nào để hiển thị'); ?></h4>
             <?php } ?>
                </div>
            </div>
            <?php if($numberPage > 1){ ?>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul class="paginate-hd">
                            <li class="prev"><a href="javascript:void(0);">&lt;</a></li>
                            <?php for ($i = 1; $i <= $numberPage; $i++) {
                                    if ($i == $page){
                                        echo '<li class="active page-number"><span>'.$i.'</span></li>';
                                    }else{
                                        echo '<li class="page-number"><a href="javascript:void(0);">'.$i.'</a></li>';
                                    }
                            } ?>
                            <li class="next"><a href="javascript:void(0);">&gt;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
<?php include 'footer.php';?>