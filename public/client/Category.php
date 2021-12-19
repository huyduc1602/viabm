<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = $_GET['title'].' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    //CheckLogin();
?>
<?php 
    if(isset($_GET['title']))
    {
        $category = $CMSNT->get_row("SELECT * FROM `category` WHERE `id` = '".check_string($_GET['title'])."' AND `display` = 'SHOW' ");
    }
    else
    {
        die('URL không tồn tại');
    }
?>
<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper compact pt-4">
                    <div class="element-actions"><a class="btn btn-primary btn-sm" href="<?=BASE_URL('History');?>"><i
                                class="os-icon os-icon-rotate-cw"></i><span><?=lang(36);?></span></a><a
                            class="btn btn-success btn-sm" href="<?=BASE_URL('Recharge-Bank');?>"><i
                                class="os-icon os-icon-dollar-sign"></i><span><?=lang(37);?></span></a></div>
                    <h6 class="element-header"><?=lang(54);?></h6>
                    <div class="element-box-tp">
                        <div class="row">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="alert alert-warning borderless">
                                    <?php
                                    $thongbao = $CMSNT->site('thongbao');
                                    $thongbaorutgon = $CMSNT->site('thongbaorutgon');
                                    ?>
                                    <div class="content-notify">
                                        <?php
                                        if(strlen($thongbao) > strlen($thongbaorutgon)){
                                            $read = 'MORE';
                                        }else{
                                            $read = 'LESS';
                                        }
                                        ?>
                                        <div class="readmore <?=$read=='MORE'?'':'hide'?>">
                                            <?=$thongbaorutgon?>
                                            <a href="javascript:void(0);" class="linkreadmore font-weight-bold" data-content="toggle-text"><?=langByVn('Xem thêm')?></a>
                                        </div>
                                        <div class="readless <?=$read=='LESS'?'':'hide'?>"">
                                        <?=$thongbao?>
                                        <a href="javascript:void(0);" class="linkreadless font-weight-bold" data-content="toggle-text"><?=langByVn('Rút gọn')?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <h6 class="element-header"><?=strtoupper($category['title']);?></h6>
                    <div class="element-box-tp">
                    <!--box product-->
                        <div id="CATEGORY_<?=$category['id']?>" class="tab-pane fade container p-0 active show box-product" role="tabpanel">
                            <div class="row">
                                    <?php foreach($CMSNT->get_list("SELECT * FROM `dichvu` WHERE `display` = 'SHOW' AND `loai` = '".$category['title']."'  ORDER BY `gia` ASC ") as $row){ ?>
                                    <?php $conlai = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `trangthai` = 'LIVE' AND `code` IS NULL ");
                                        if($conlai > 0){
                                            $textconlai = format_cash($conlai) > 99 ? format_cash($conlai).'+':format_cash($conlai);
                                        }else{
                                            $textconlai = langByVn('Hết </br> hàng');
                                        }
                                    ?>
                                    <div class="col-md-6 pr-2 pl-2 col-mobile-tablet item-product">
                                        <div class="rounded p-3 m-md-3 m-0 mb-3 d-block hvr-underline-from-center">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <div id="thongbao"></div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01"><?=lang(45);?></label>
                            </div>
                            <input type="number" min="1" value="1" class="form-control" id="modal-soluong"
                                style="font-size: 16px;font-weight: bold;text-align: right;">
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="modal-gia"><?=lang(74);?></label>
                            </div>
                            <input type="text" value="" readonly class="form-control" id="modal-gia"
                                style="font-size: 16px;font-weight: bold;text-align: right;">
                            <input type="hidden" value="" readonly class="form-control" id="modal-available-amount">
                            <input type="hidden" value="" readonly class="form-control" id="modal-type-id">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="modal-gia"><?=lang(41);?></label>
                            </div>
                            <input type="text" value="<?=$getUser['chietkhau'];?>%" readonly class="form-control"
                                style="font-size: 16px;font-weight: bold;text-align: right;">
                            <input type="hidden" value="" readonly class="form-control" id="modal-available-amount">
                            <input type="hidden" value="" readonly class="form-control" id="modal-type-id">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="modal-gia"><?=lang(75);?></label>
                            </div>
                            <input type="text" value="" readonly class="form-control" id="modal-total"
                                style="font-size: 16px;color: red;font-weight: bold;text-align: right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea readonly class="form-control" id="modal-type-name"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn-buy-now"><?=lang(46);?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=lang(76);?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <script type="text/javascript">
    $('.btn-buy').on('click', function(e) {
        var btn = $(this);
        if ($(this).attr("conlai") > 0) {
            $("#modal-soluong").val(1);
            $("#modal-gia").val(parseFloat(btn.attr("gia")));
            $("#modal-type-name").val(btn.attr("mota"));
            $("#modal-available-amount").val(btn.attr("conlai"));
            $("#modal-type-id").val(btn.attr("data-id"));
            $("#modal-total").val(parseFloat(btn.attr("gia")));
            $("#staticBackdrop").modal();
        } else {
            alert("<?=lang(82);?> !");
        }
        return false;
    });
    $('#modal-soluong').on("keyup", function() {
        var price = $("#modal-gia").val();
        var qty = $("#modal-soluong").val();
        var avaiable = $("#modal-available-amount").val();
        if (qty > avaiable) {
            //$("#modal-soluong").val(avaiable);
            //qty = avaiable;
        }
        var ck_discount = <?=$getUser['chietkhau'];?>;
        var total = 0;
        total = qty * price;
        total = total - total * ck_discount / 100;
        $("#modal-total").val(total);


    });
    $('#btn-buy-now').on('click', function(e) {
        var qty = $("#modal-soluong").val();
        var avaiable = $("#modal-available-amount").val();
        var typeid = $("#modal-type-id").val();
        $('#btn-buy-now').addClass('btn btn-info').html(
            '  <span class="spinner-grow spinner-grow-sm"></span> <?=lang(81);?>').prop('disabled',
            true);

        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/Buy.php");?>",
            method: "POST",
            data: {
                value: qty,
                dichvu: typeid
            },
            success: function(response) {
                $("#thongbao").html(response);
                $('#btn-buy-now').html('<?=lang(46);?>').prop(
                    'disabled', false);
            }
        });
        return false;
    });
    </script>
    <script>
    $(function() {
        $("#datatable").DataTable();
    });
    </script>


    <?php 
    require_once("../../public/client/Footer.php");
?>