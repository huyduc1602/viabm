<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = lang(1).' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
?>
<style>
    .vodiapicker{
        display: none;
    }

    #langlg{
        padding-left: 0px;
        margin-bottom: 0;
    }

    #langlg img, .btn-select img{
        width: 35px;

    }

    #langlg li{
        list-style: none;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    #langlg li:hover{
        background-color: #F4F3F3;
    }

    #langlg li img{
        margin: 5px;
    }

    #langlg span, .btn-select li span{
        margin-left: 30px;
    }

    /* item list */

    .boxlang{
        display: none;
        width: 100%;
        max-width: 50px;
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        border: 1px solid rgba(0,0,0,.15);
        border-radius: 5px;
        overflow: hidden;
    }

    .lang-select .open{
        display: show !important;
    }

    .btn-select{
        margin-top: 10px;
        width: 100%;
        max-width: 50px;
        height: 50px;
        border-radius: 5px;
        background-color: #fff;
        border: 1px solid #ccc;

    }
    .btn-select li{
        list-style: none;
        float: left;
        padding-bottom: 0px;
    }

    .btn-select:hover li{
        margin-left: 0px;
    }

    .btn-select:hover{
        background-color: #F4F3F3;
        border: 1px solid transparent;
        box-shadow: inset 0 0px 0px 1px #ccc;


    }

    .btn-select:focus{
        outline:none;
    }

    .lang-select{
        margin-left: 50px;
        position: absolute;
        left: 5%;
        z-index: 999;
    }
    @media (max-width: 767px) {
        .lang-select{
            left: 50%;
            transform: translate(-50%, 0);
            margin-left: 0;
        }
        .boxlang{
            background: #2b65b1;
        }
    }

</style>
<body class="auth-wrapper">
    <select class="vodiapicker">
        <option value="vn" data-thumbnail="<?=BASE_URL('template/img/flags-icons/vn.png');?>"></option>
        <option value="en" class="test" data-thumbnail="<?=BASE_URL('template/img/flags-icons/en.png');?>"></option>
    </select>

    <div class="lang-select">
        <button class="btn-select" value=""></button>
        <div class="boxlang">
            <ul id="langlg"></ul>
        </div>
    </div>
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w"><a href="<?=BASE_URL('');?>"><img alt="" width="100%"
                        src="<?=$CMSNT->site('logo');?>"></a></div>
            <h4 class="auth-header"><?=lang(4);?></h4>
            <form action="">
                <div id="thongbao"></div>
                <div class="form-group"><label for=""><?=lang(5);?></label><input class="form-control" id="username"
                        placeholder="<?=lang(7);?>">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="form-group"><label for=""><?=lang(6);?></label><input class="form-control" id="password"
                        placeholder="<?=lang(8);?>" type="password">
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                </div>
                <div class="form-group">
                    <label for=""><a href="<?=BASE_URL('Auth/ForgotPassword');?>"><?=lang(122);?></a></label>
                </div>
                <div class="buttons-w"><button class="btn btn-primary btn-block" id="Login"
                        type="button"><?=lang(1);?></button>
                    <a class="btn btn-danger btn-block" href="<?=BASE_URL('Auth/Register');?>"
                        type="button"><?=lang(2);?></a>
                </div>
            </form>
        </div>

        <?php if($CMSNT->site('display_list_login') == 'ON') { ?>
        <br>
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
            <!--Chuyển sang dùng formBuy nên tắt đi-->
            <?php /*

            <?php foreach($CMSNT->get_list("SELECT * FROM `category` WHERE `display` = 'SHOW' ORDER BY `stt` ") as $category) { ?>
                <div class="element-wrapper">
                    <h6 class="element-header"><?=$category['title'];?></h6>
                    <div class="element-box">
                        <div class="table-responsive">
                            <table class="table table-padded">
                                <thead>
                                <tr>
                                    <th><?=lang(77);?></th>
                                    <th width="10%" class="text-center"><?=lang(85);?></th>
                                    <th width="10%" class="text-center"><?=lang(78);?></th>
                                    <?php if($CMSNT->site('display_sold') == 'ON') { ?>
                                        <!--                                <th width="10%" class="text-center">--><?//=lang(140);?><!--</th>-->
                                    <?php }?>
                                    <th width="10%" class="text-center"><?=lang(74);?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($CMSNT->get_list("SELECT * FROM `dichvu` WHERE
                                    `display` = 'SHOW' AND 
                                    `loai` = '".$category['title']."'  ORDER BY `stt` ASC ") as $row)
                                {
                                    $conlai = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `trangthai` = 'LIVE' AND `code` IS NULL ");
                                    $sold = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NOT NULL ");
                                    ?>
                                    <tr>
                                        <td><img src="<?=BASE_URL($category['img']);?>" width="30px"
                                                 title="<?=$category['title'];?>">
                                            <b data-content="<?=$row['mota'];?>" data-toggle="popover"
                                               title="<?=$row['dichvu'];?>"><?=$row['dichvu'];?></b>
                                        </td>
                                        <td class="text-center">
                                            <?php if($row['quocgia']) { ?>
                                                <img width="40px" src="<?=BASE_URL('template/flag/'.$row['quocgia'].'.svg');?>" />
                                            <?php }?>
                                        </td>
                                        <td class="text-center">
                                            <b style="color: red;;">
                                                <?=format_cash($conlai);?>
                                            </b>
                                        </td>
                                        <?php if($CMSNT->site('display_sold') == 'ON') { ?>
                                            <!--                                <td class="text-center">-->
                                            <!--                                    <b style="color: green;;">-->
                                            <!--                                        --><?//=format_cash($sold);?>
                                            <!--                                    </b>-->
                                            <!--                                </td>-->
                                        <?php }?>
                                        <td class="text-center">
                                            <b style="color: blue;"><?=format_currency($row['gia']);?></b>
                                        </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            <?php }?>
            */ ?>
            <!--Chuyển sang dùng formBuy nên tắt đi-->

        <?php }?>


    </div>
</body>

</html>


<?php if(!isset($_SESSION['thongbaonoi'])) { $_SESSION['thongbaonoi'] = True;?>
<div class="onboarding-modal modal fade animated" id="thongbaonoi" role="dialog" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">THÔNG BÁO</h5>
            </div>
            <div class="modal-body">
                <?=$CMSNT->site('thongbao');?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(e => {
        showlog()
    }, 500)
});

function showlog() {
    $('#thongbaonoi').modal({
        keyboard: true,
        show: true
    });
}
</script>
<?php }?>
<?=$CMSNT->site('script');?>
<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <script type="text/javascript">
$("#Login").on("click", function() {

    $('#Login').html('<?=lang(9);?>').prop('disabled',
        true);
    Swal.fire({
        title: '<?=lang(111);?>',
        text: '',
        imageUrl: '<?=BASE_URL('assets/img/loading.gif');?>',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
    })
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'Login',
            username: $("#username").val(),
            password: $("#password").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Login').html(
                    '<?=lang(1);?>')
                .prop('disabled', false);
        }
    });
});

//language
var langArray = [];
$('.vodiapicker option').each(function(){
    var img = $(this).attr("data-thumbnail");
    var text = this.innerText;
    var value = $(this).val();
    var item = '<li><img src="'+ img +'" alt="" value="'+value+'"/><span>'+ text +'</span></li>';
    langArray.push(item);
})

$('#langlg').html(langArray);

//Set the button value to the first el of the array
$('.btn-select').html(langArray[0]);
$('.btn-select').attr('value', 'en');

//change button stuff on click
$('#langlg li').click(function(){
    var img = $(this).find('img').attr("src");
    var value = $(this).find('img').attr('value');
    var text = this.innerText;
    var item = '<li><img src="'+ img +'" alt="" /><span>'+ text +'</span></li>';
    $('.btn-select').html(item);
    $('.btn-select').attr('value', value);
    $(".boxlang").toggle();
    if(value == 'en'){
        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/Lang.php");?>",
            method: "POST",
            data: {
                type: 'ChangeLanguage',
                lang: 'en'
            },
            success: function(response) {
                setTimeout(function() {
                    location.href = ""
                }, 0);
            }
        });
    }
    if(value == 'vn'){
        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/Lang.php");?>",
            method: "POST",
            data: {
                type: 'ChangeLanguage',
                lang: 'vn'
            },
            success: function(response) {
                setTimeout(function() {
                    location.href = ""
                }, 0);
            }
        });
    }
});

$(".btn-select").click(function(){
    $(".boxlang").toggle();
});

    </script>
<?php 
    //require_once("../../public/client/Footer.php");
?>