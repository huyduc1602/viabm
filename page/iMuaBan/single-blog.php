<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
?>
<?php
if(isset($_GET['slug']))
{
    $row = $CMSNT->get_row(" SELECT * FROM `blog` WHERE `slug` = '".check_string($_GET['slug']). "'");
    if(!$row)
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //Chi tiết bài viết
    $name = selectTableLang('blog','name',$row['id'],$row['name']);
    if(strlen($name) > 50 ){
        $name_cut = substr($name,0,150).'...';
    }else{
        $name_cut = $name;
    }
    $detail = selectTableLang('blog','name',$row['id'],$row['detail']);
    $image = BASE_URL('/').$row['image'];
    //Danh mục bài viết
    $categoryBlog = $CMSNT->get_list(" SELECT * FROM `category_blog` WHERE slug <> 'uncategorized' ORDER BY id DESC");
    //Bài viết liên quan
    $limit = 4;
    $categoryId = $row['categoryId'];
    $blogReleated = $CMSNT->get_list(" SELECT * FROM `blog` WHERE categoryId=".$categoryId."  ORDER BY updatedDate DESC LIMIT ".$limit." OFFSET 0");
    //Cập nhật lượt xem
    $viewCount = $row['view_count'];
    try {
        $CMSNT->update("blog", array(
            'view_count' => $viewCount + 1,
        ), " `id` = '".$row['id']."' ");
    } catch (ErrorException $e){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}
else
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
<?php include 'header.php';?>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url(<?=BASE_URL('page/iMuaBan/');?>/img/abadan-the-right-partner.jpg);" data-stellar-background-ratio="0.5" id="banner-single-blog">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center content-banner" style="height: 307px;">
                <div class="col-md-7">
                    <div class="text-banner">
                        <p><?=langByVn('Bán Clone Facebook - Hệ thống bán Clone Trên Toàn Thế Giới , Thẻ Ngoại Chạy Quảng Cáo Facebook');?></p>
                        <p><?=langByVn('Mua bán BM Facebook, BM Limit 50$, BM Limit 350$, BM 5TKQC, BM Xác minh doanh nghiệp');?></p>
                    </div>
                </div>
                <div class="col-md-9 ftco-animate pb-5 text-center fadeInUp ftco-animated content-banner">
<!--                    <h1 class="mb-3 bread">--><?//=$name_cut ?><!--</h1>-->
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?=BASE_URL('/');?>"><?=langByVn('Trang chủ');?> <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="<?=BASE_URL('blogs');?>"><?=langByVn('Tin tức');?> <i class="ion-ios-arrow-forward"></i></a></span> <span><?=$name_cut?> <i class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate fadeInUp ftco-animated">
                    <p class="mb-5">
                        <img src="<?=$image;?>" alt="<?=$name;?>" class="img-fluid img-blog">
                    </p>
                    <h2 class="mb-3"><?=$name;?></h2>
                    <div class="detail-content-blog">
                        <?php if(isset($detail) && $detail != ''){
                            echo $detail;
                        }else{ ?>
                            <h4 class="text-center"><?=langByVn('Chưa có nội dung nào để hiển thị'); ?></h4>
                        <?php } ?>
                    </div>
<!--                    <div class="tag-widget post-tag-container mb-5 mt-5">-->
<!--                        <div class="tagcloud">-->
<!--                            <a href="#" class="tag-cloud-link">Life</a>-->
<!--                            <a href="#" class="tag-cloud-link">Sport</a>-->
<!--                            <a href="#" class="tag-cloud-link">Tech</a>-->
<!--                            <a href="#" class="tag-cloud-link">Travel</a>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="about-author d-flex p-4 bg-light">
                        <div class="bio mr-5">
                            <img src="https://preview.colorlib.com/theme/readit/images/xperson_1.jpg.pagespeed.ic.e9rH06n9-0.webp" alt="Image placeholder" class="img-fluid mb-4">
                        </div>
                        <div class="desc">
                            <h3>Kevin Phạm</h3>
                            <p><?=langByVn('Because we value our customers, we work hard to provide the excellent service they deserve. The evidence of this hard work can be found in our decreased estimated bills, improved billing timeliness and accuracy'); ?></p>
                        </div>
                    </div>
                    <div class="pt-5 mt-5">
                        <h3 class="mb-5"><?=langByVn('Bình luận'); ?></h3>
                        <div class="comment-content">
                            <div class="fb-comments" data-href="https://viabm.store/" data-width="100%" data-numposts="5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 sidebar pl-lg-5 ftco-animate fadeInUp ftco-animated">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon icon-search"></span>
                                <input type="search" id="search-blog" class="form-control" placeholder="<?=langByVn('Nhập ít nhất một từ khóa và nhấn enter')?>">
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
                        <div class="categories">
                            <?php if(count($categoryBlog) > 0){?>
                                <h3><?=langByVn('Danh mục')?></h3>
                                <?php foreach ($categoryBlog as $row){ ?>
                                <li><a href="#"><?=selectTableLang('blog','category_blog',$row['id'],$row['name'])?> <span class="ion-ios-arrow-forward"></span></a></li>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
                        <?php if(count($blogReleated) > 0){?>
                            <h3><?=langByVn('Bài viết liên quan')?></h3>
                            <?php foreach ($blogReleated as $row){ ?>
                                <?php
                                $userCreated['username'] = 'Admin';
                                if($row['userId'] >= 1){
                                    $userCreated = $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '".$row['userId']."' ");
                                }
                                ?>
                                <div class="block-21 mb-4 d-flex">
                                    <a class="blog-img mr-4" style="background-image:url(<?=BASE_URL('/').$row['image'];?>)"></a>
                                    <div class="text">
                                        <h3 class="heading"><a href="/blog/<?=$row['slug'];?>"><?=selectTableLang('blog','name',$row['id'],$row['name'])?></a></h3>
                                        <div class="meta">
                                            <div><a href="javascript:void(0);"><span class="far fa-calendar-alt"></span> <?=date_format(date_create($row['createdDate']),"d/m/Y");?></a></div>
                                            <div><a href="javascript:void(0);"><span class="fas fa-user-alt"></span> <?=$userCreated['username'];?></a></div>
                                            <div><a href="javascript:void(0);"><span class="fas fa-eye"></span> <?=$row['view_count']?></a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
<!--                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">-->
<!--                        <h3>Tag Cloud</h3>-->
<!--                        <div class="tagcloud">-->
<!--                            <a href="#" class="tag-cloud-link">cat</a>-->
<!--                            <a href="#" class="tag-cloud-link">abstract</a>-->
<!--                            <a href="#" class="tag-cloud-link">people</a>-->
<!--                            <a href="#" class="tag-cloud-link">person</a>-->
<!--                            <a href="#" class="tag-cloud-link">model</a>-->
<!--                            <a href="#" class="tag-cloud-link">delicious</a>-->
<!--                            <a href="#" class="tag-cloud-link">desserts</a>-->
<!--                            <a href="#" class="tag-cloud-link">drinks</a>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
                        <h3><?=langByVn('Tìm chúng tôi trên facebook')?></h3>
                        <div class="fb-page" data-href="https://www.facebook.com/viabm.store/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/viabm.store/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/viabm.store/">Viabm.store - Hệ thống Mua Bán Via - BM Giá Rẻ Uy Tín</a></blockquote></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include 'footer.php';?>