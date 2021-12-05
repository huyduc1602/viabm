<!--    Thêm nút liên hệ và messager-->
<div id="button-contact-vr" class="">
    <div id="gom-all-in-one">
<!--        <div id="zalo-vr" class="button-contact">-->
<!--            <div class="phone-vr">-->
<!--                <div class="phone-vr-circle-fill"></div>-->
<!--                <div class="phone-vr-img-circle">-->
<!--                    <a target="_blank" href="https://zalo.me/0985630916">-->
<!--                        <img data-lazyloaded="1" data-placeholder-resp="100x95" src="https://maitek.com.vn/wp-content/plugins/button-contact-vr/img/zalo.png" width="100" height="95" data-src="https://maitek.com.vn/wp-content/plugins/button-contact-vr/img/zalo.png" class="litespeed-loaded" data-was-processed="true">-->
<!--                        <noscript><img width="100" height="95" src="https://maitek.com.vn/wp-content/plugins/button-contact-vr/img/zalo.png" /></noscript>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div id="phone-vr" class="button-contact">
            <div class="phone-vr">
                <div class="phone-vr-circle-fill"></div>
                <div class="phone-vr-img-circle">
                    <a href="tel:0985630916">
                        <img data-lazyloaded="1" data-placeholder-resp="50x50" src="https://maitek.com.vn/wp-content/plugins/button-contact-vr/img/phone.png" width="50" height="50" data-src="https://maitek.com.vn/wp-content/plugins/button-contact-vr/img/phone.png" class="litespeed-loaded" data-was-processed="true">
                        <noscript><img width="50" height="50" src="https://maitek.com.vn/wp-content/plugins/button-contact-vr/img/phone.png" /></noscript>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--    Thêm nút liên hệ và messager-->


<?php if($CMSNT->site('right_panel') == 'ON') { ?>
<div class="content-panel">
    <div class="content-panel-close"><i class="os-icon os-icon-close"></i></div>
    <div class="element-wrapper">
        <h6 class="element-header"><?=lang(38);?></h6>
        <div class="element-box-tp">
            <div class="profile-tile"><a class="profile-tile-box" href="<?=BASE_URL('Auth/Profile');?>">
                    <div class="pt-avatar-w"><img alt="" src="<?=BASE_URL('template/');?>img/avatar1.jpg"></div>
                    <div class="pt-user-name"><?=$getUser['username'];?></div>
                </a>
                <div class="profile-tile-meta">
                    <ul>
                        <li><?=lang(40);?>:</br><strong style="color: green;" class="active-user"><?=lang(39);?></strong></li>
                        <li><?=lang(41);?>:<strong style="color: red;"><?=$getUser['chietkhau'];?>%</strong></li>
                        <li><?=lang(31);?>:<strong><?=format_currency($getUser['money']);?></strong></li>
                        <li><?=lang(30);?>:<strong><?=format_currency($getUser['total_money']);?></strong>
                        </li>
                        <li><?=lang(32);?>:<strong><?=format_currency($getUser['used_money']);?></strong></li>
                    </ul>
                    <div class="pt-btn"><a class="btn btn-danger btn-block"
                            href="<?=BASE_URL('Auth/Logout');?>"><?=lang(63);?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="element-wrapper">
        <h6 class="element-header"><?=lang(42);?></h6>
        <div class="element-box-tp">
            <div class="activity-boxes-w">
                <?php foreach($CMSNT->get_list("SELECT * FROM `orders` ORDER BY id DESC limit 10 ") as $orders) { ?>
                <div class="activity-box-w">
                    <div class="activity-time"><?=timeAgo($orders['time']);?></div>
                    <div class="activity-box">
                        ****<?=substr($orders['username'], 4);?> <?=lang(158);?> <?=$orders['soluong'];?> <?=lang(159);?>
                        <?=$orders['dichvu'];?>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?php }?>
</div>
</div>
</div>

<?php if(!isset($_SESSION['thongbaonoi'])) { $_SESSION['thongbaonoi'] = True;?>
<div class="onboarding-modal modal fade animated" id="thongbaonoi" role="dialog" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang(160);?></h5>
            </div>
            <div class="modal-body">
                <?=$CMSNT->site('thongbao');?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?=lang(76);?></button>
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



<?php if($getUser['phone'] == '') { ?>
<div id="thongbao"></div>
<div class="onboarding-modal modal fade animated" id="addphone" role="dialog" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang(138);?></h5>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?=lang(67);?>:</label>
                        <div class="col-sm-9">
                            <input type="text" id="phone" value="<?=$getUser['phone'];?>" placeholder="<?=lang(139);?>"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add_phone">Lưu Ngay</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(e => {
        showaddphone()
    }, 0)
});

function showaddphone() {
    $('#addphone').modal({
        keyboard: true,
        show: true
    });
}
</script>
<script type="text/javascript">
$("#add_phone").on("click", function() {

    $('#add_phone').html('<?=lang(9);?>').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/add-phone.php");?>",
        method: "POST",
        data: {
            phone: $("#phone").val()
        },
        success: function(response)
        {
            $("#thongbao").html(response);
            $('#add_phone').html(
                    'Lưu Ngay')
                .prop('disabled', false);
        }
    });
});
</script>
<?php }?>

<!--Thêm messager-->
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "110302188130824");
        chatbox.setAttribute("attribution", "biz_inbox");

        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v12.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
<!--Thêm messager-->

<?=$CMSNT->site('script');?>
<script src="<?=BASE_URL('template/');?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/popper.js/dist/umd/popper.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/moment/moment.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/chart.js/dist/Chart.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/ckeditor/ckeditor.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap-validator/dist/validator.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/dropzone/dist/dropzone.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/editable-table/mindmup-editabletable.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/tether/dist/js/tether.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/slick-carousel/slick/slick.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/util.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/alert.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/button.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/carousel.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/collapse.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/dropdown.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/modal.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/tab.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/tooltip.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/popover.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/toastr/toastr.min.js"></script>
<script src="<?=BASE_URL('template/');?>js/main.js?version=4.5.0"></script>
<script src="<?=BASE_URL('template/');?>js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script src="<?=BASE_URL('template/');?>js/papaparse.min.js"></script>
<script src="<?=BASE_URL('template/');?>js/coder-update.js?version=1.0.0"></script>
<script>
new ClipboardJS('.copy');
</script>
</body>

</html>