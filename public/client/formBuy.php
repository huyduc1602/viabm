<? if (!defined('IN_SITE')) die ('The Request Not Found'); ?>

<?php
$buy = $CMSNT->get_list("SELECT * FROM `category` WHERE `display` = 'SHOW' ORDER BY `stt`");
foreach($buy as $category) { ?>
<div class="col-sm-12">
    <div class="element-wrapper">
        <h6 class="element-header"><?=strtoupper($category['title']);?></h6>
        <div class="element-box-tp">
            <!--box product-->
            <div id="CATEGORY_<?=$category['id']?>" class="tab-pane fade container p-0 active show box-product" role="tabpanel">
                <div class="row">
                    <?php
                    $cat = $CMSNT->get_list("SELECT * FROM `dichvu` WHERE `display` = 'SHOW' AND `loai` = '".$category['title']."'  ORDER BY `gia` ASC LIMIT 10");
                    foreach($cat as $row){ ?>
                        <?php $conlai = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `trangthai` = 'LIVE' AND `code` IS NULL ");
                        if($conlai > 0){
                            $textconlai = format_cash($conlai) > 99 ? format_cash($conlai).'+':format_cash($conlai);
                        }else{
                            $textconlai = langByVn('Hết </br> hàng');
                        }
                        ?>

                        <?php if($CMSNT->site('right_panel') == 'ON') { ?>
                        <div class="col-md-6 pr-2 pl-2 col-mobile-tablet item-product">
                        <?php }else { ?>
                        <div class="col-md-4 pr-2 pl-2 col-mobile-tablet item-product">
                        <?php } ?>
                            <div class="rounded p-3 m-0 mb-3 d-block hvr-underline-from-center">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="custom-control-label p-2" for="type-select-7">
                                                       <span class="d-flex align-items-center">
                                                          <div class="item item-circle bg-black-5 text-primary-light" style="min-width: 65px;">
                                                              <?php if($conlai > 0){ ?>
                                                                  <span class="text-danger text-center font-weight-bolder" style="font-size: 20px; font-weight:500"> <?=$textconlai;?> </span>
                                                              <?php }else{ ?>
                                                                  <span class="text-secondary text-center font-weight-bolder" style="font-size: 14px; font-weight:500; line-height: 1.2;" disabled=""><?=$textconlai; ?></span>
                                                              <?php } ?>
                                                          </div>
                                                           <!-- <img class="img-fluid" src="/img/101.png" alt="VPN"style="display:block" width="65px"> -->
                                                          <span class="text-truncate ml-2">
                                                             <h4 class="font-w700" style="font-size:14px;color:#045699" data-content="<?=$row['mota'];?>" data-toggle="popover"
                                                                 title="<?=$row['dichvu'];?>"><img src="<?=BASE_URL($category['img']);?>" width="30px"
                                                                                                   title="<?=$category;?>"> <?=$row['dichvu'];?></h4>
                                                             <span class="d-block font-size-sm text-muted">
                                                                <h5 style="font-weight:600; font-size:13px; color:#626568; margin-bottom:3px"><?=$row['loai'];?></h5>
                                                                <span class="d-block font-size-sm text-muted">
                                                                   <!--<span class="d-block font-size-sm" style="font-size:13px" data-toggle="tooltip" data-placement="top" title data-original-title="<p>Quốc gia: Thái Lan</p><p>Trạng thái xác minh danh tính:&nbsp;<span style="font-weight: 700; font-size: 1rem;"><font color="#ff0000">NO</font></span></p><p>Năm tạo: 2020 -> 2021</p><p>Số lượng bạn bè: Random</p><p>Trạng thái bật 2FA:&nbsp;<span style="color: rgb(57, 123, 33); font-weight: bolder; font-size: 1rem;">YES</span></p><p>File backup:&nbsp;<span style="color: rgb(57, 123, 33); font-weight: bolder; font-size: 1rem;">YES</span></p><p>Xác minh mail:&nbsp;<span style="font-weight: bolder;"><font color="#397b21">YES</font></span></p>"><p>Quốc gia: Thái Lan</p><p>Trạng thái xác minh danh tính:&nbsp;<span style="font-weight: 700; font-size: 1rem;"><font color="#ff0000">NO</font></span></p><p>Năm tạo: 2020 -> 2021</p><p>Số lượng bạn bè: Random</p><p>Trạng thái bật 2FA:&nbsp;<span style="color: rgb(57, 123, 33); font-weight: bolder; font-size: 1rem;">YES</span></p><p>File backup:&nbsp;<span style="color: rgb(57, 123, 33); font-weight: bolder; font-size: 1rem;">YES</span></p><p>Xác minh mail:&nbsp;<span style="font-weight: bolder;"><font color="#397b21">YES</font></span></p></span>-->
                                                                   <span class="d-block font-size-sm text-muted">
                                                                   <strong class="text-danger" style="font-size:14px"><?=format_currency($row['gia']);?></strong></span>
                                                                </span>
                                                             </span>
                                                          </span>
                                                       </span>
                                        </label>
                                    </div>
                                    <div class="col-md-12 d-flex">
                                        <div class="col-lg-6 p-1">
                                            <div class="float-right align-middle mt-1">
                                                <button type="button" class="btn-info-pr" data-toggle="modal" data-target="#modal_thongtin_<?=$row['id'];?>"><i class="fas fa-info-circle"></i> THÔNG TIN</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-1">
                                            <div class="float-left align-middle mt-1">
                                                <?php if($conlai != 0) { ?>
                                                    <button type="button" class="btn-mua-ngay btn-buy" conlai="<?=$conlai;?>"
                                                            gia="<?=$row['gia'];?>" data-id="<?=$row['id'];?>"
                                                            mota="<?=$row['mota'];?>"><?=lang(83);?></button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-stock" disabled><?=lang(84);?></button>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- The Modal Thông Tin -->
                        <div class="modal" id="modal_thongtin_<?=$row['id'];?>" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header" style="background-color: #2b65b1">
                                        <h4 class="modal-title text-light"><?=$row['dichvu'];?></h4>
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <?php if($row['quocgia']) { ?>
                                            <p><?=lang(85);?>: </p>
                                            <img width="40px" class="display-inline-block mb-2"
                                                 src="<?=BASE_URL('template/flag/'.$row['quocgia'].'.svg');?>" />
                                        <?php }?>

                                        <p><?=lang(52);?>: <strong><?=$row['loai'];?></strong></p>
                                        <p><?=lang(78);?>: <b style="color: red;;"><?=format_cash($conlai);?></b> </p>
                                        <p><?=lang(74);?>:  <b style="color: blue;"><?=format_currency($row['gia']);?></b></p>
                                        <div class="text-center">
                                            <button type="button" class="btn-close-thongtin" data-dismiss="modal"><b>OK</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--box product-->
            <?php if(count($cat) > 10){ ?>
            <a class="btn btn-link btn-underlined float-right mb-2" href="<?=BASE_URL('Category/'.$category['id']);?>">
                <span><?=langByVn('Xem thêm')?></span>
                <i class="os-icon os-icon-arrow-right4"></i>
            </a>
            <?php }?>
        </div>
    </div>
</div>
<?php }?>