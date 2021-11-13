<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = langByVn('NẠP TIỀN QUA VÍ ZALO PAY').' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/BTC_Logo.svg" height="100px;" />
                        <br><br>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <h4><?=langByVn('THANH TOÁN BẰNG VÍ USDT');?></h4>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><?=langByVn('Tiền tệ (Coin)');?>: </td>
                                    <td style="text-align: left; color: #00cc99;">
                                        <b><?=$CMSNT->site('currency_usdt');?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><?=langByVn('Địa chỉ ví');?>:
                                    </td>
                                    <td style="text-align: left;">
                                        <b><?=$CMSNT->site('wallet_address_usdt');?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><?=langByVn('Mạng');?>:
                                    </td>
                                    <td style="text-align: left;">
                                        <b><?=$CMSNT->site('network_paypal');?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><?=langByVn('Mã QR CODE');?>:
                                    </td>
                                    <td style="text-align: left;">
                                        <img src="<?=$CMSNT->site('qrcode_usdt');?>" alt="<?=langByVn('Mã QR CODE');?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><?=langByVn('Nội dung chuyển tiền');?>:
                                    </td>
                                    <td style="text-align: left;">
                                        <b id="copy" style="color:red;"><?=$CMSNT->site("noidung_naptien").$getUser['id'];?></b> <a class="copy" data-clipboard-target="#copy"><i class="os-icon os-icon-copy"></i></a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="2"><b><?=$CMSNT->site('usdt_note');?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <h6 class="element-header"><?=langByVn('LỊCH SỬ NẠP USDT');?></h6>
                    <div class="element-box">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-padded">
                                <thead>
                                    <tr>
                                        <th><?=langByVn('Trạng thái');?></th>
                                        <th><?=langByVn('Thời gian');?></th>
                                        <th><?=langByVn('Nội dung');?></th>
                                        <th class="text-center"><?=langByVn('Mã GD');?></th>
                                        <th class="text-right"><?=langByVn('Số tiền');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($CMSNT->get_list("SELECT * FROM `zalo_pay` WHERE `username` = '".$getUser['username']."' ") as $momo) { ?>
                                    <tr>
                                        <td class="nowrap"><span class="status-pill smaller green"></span>
                                            <span><?=langByVn('Hoàn thành');?></span>
                                        </td>
                                        <td><span><?=$momo['time'];?></span></td>
                                        <td class="cell-with-media"><?=$momo['description'];?></td>
                                        <td class="text-center"><a class="badge badge-danger"
                                                href=""><?=$momo['transid'];?></a></td>
                                        <td class="text-right bolder nowrap"><span class="text-success">+
                                                <?=format_cash($momo['amount']);?></span></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script>
    $(function() {
        $("#datatable").DataTable();
    });
    </script>


    <?php 
    require_once("../../public/client/Footer.php");
?>