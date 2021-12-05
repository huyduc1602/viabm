<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = 'NẠP THẺ | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-7">
                <div class="element-wrapper">
                    <div class="element-header"> <?=langByVn('NẠP THẺ CÀO');?></div>
                    <div class="element-box">
                        <div id="thongbao"></div>
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label"><?=langByVn('Loại thẻ');?>:</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select" id="loaithe" required="">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label"><?=langByVn('Mệnh giá');?>:</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select" id="menhgia" required="">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label"><?=langByVn('Nhập seri');?>:</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" type="text" id="seri" placeholder="10006139342354">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label"><?=langByVn('Nhập mã thẻ');?>:</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" type="text" id="pin" placeholder="313036630666891">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" id="NapThe" class="btn btn-primary btn-block">
                                    <span><?=langByVn('NẠP NGAY');?></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="element-wrapper">
                    <div class="element-header"> <?=langByVn('LƯU Ý');?></div>
                    <div class="alert alert-warning borderless">
                        <?=$CMSNT->site('luuy_naptien');?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <h6 class="element-header"><?=langByVn('LỊCH SỬ NẠP THẺ');?></h6>
                    <div class="element-box">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-padded">
                                <thead>
                                    <tr>
                                        <th><?=langByVn('STT');?></th>
                                        <th><?=langByVn('SERI');?></th>
                                        <th><?=langByVn('PIN');?></th>
                                        <th><?=langByVn('LOẠI THẺ');?></th>
                                        <th><?=langByVn('MỆNH GIÁ');?></th>
                                        <th><?=langByVn('THỰC NHẬN');?></th>
                                        <th><?=langByVn('THỜI GIAN');?></th>
                                        <th><?=langByVn('TRẠNG THÁI');?></th>
                                        <th><?=langByVn('GHI CHÚ');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `cards` WHERE `username` = '".$getUser['username']."'  ORDER BY id DESC ") as $row){ ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$row['seri'];?></td>
                                        <td><?=$row['pin'];?></td>
                                        <td><span class="badge badge-danger"><?=$row['loaithe'];?></span></td>
                                        <td><?=format_cash($row['menhgia']);?></td>
                                        <td><?=format_cash($row['thucnhan']);?></td>
                                        <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                        <td><?=status($row['status']);?></td>
                                        <td><?=$row['note'];?></td>
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


    <script type="text/javascript">
    $(document).ready(function() {
        setTimeout(e => {
            GetCard24()
        }, 0)
    });

    function GetCard24() {
        $.ajax({
            url: "<?=BASE_URL('api/loaithe.php');?>",
            method: "GET",
            success: function(response) {
                $("#loaithe").html(response);
            }
        });
        $.ajax({
            url: "<?=BASE_URL('api/menhgia.php');?>",
            method: "GET",
            success: function(response) {
                $("#menhgia").html(response);
            }
        });

    }
    </script>

    <script type="text/javascript">
    $("#NapThe").on("click", function() {
        $('#NapThe').html('ĐANG XỬ LÝ').prop('disabled',
            true);
        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/NapThe.php");?>",
            method: "POST",
            data: {
                loaithe: $("#loaithe").val(),
                menhgia: $("#menhgia").val(),
                seri: $("#seri").val(),
                pin: $("#pin").val()
            },
            success: function(response) {
                $("#thongbao").html(response);
                $('#NapThe').html(
                        'NẠP NGAY')
                    .prop('disabled', false);
            }
        });
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