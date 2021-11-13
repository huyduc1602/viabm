<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'CẤU HÌNH NGÔN NGỮ | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php


if(isset($_POST['btnSaveLangUS']) && $getUser['level'] == 'admin')
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    foreach ($_POST as $key => $value)
    {
        $CMSNT->update("lang", array(
            'en' => $value
        ), " `id` = '$key' ");
    }
    admin_msg_success('Lưu thành công', '', 500);
}

if(isset($_POST['btnSaveLangVN']) && $getUser['level'] == 'admin')
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    foreach ($_POST as $key => $value)
    {
        $CMSNT->update("lang", array(
            'vn' => $value
        ), " `id` = '$key' ");
    }
    admin_msg_success('Lưu thành công', '', 500);
}

if(isset($_POST['btnAddLang']) && $getUser['level'] == 'admin')
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    insert_lang_text($_POST['vn-text'],$_POST['en-text']);
    admin_msg_success('Lưu thành công', '', 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cấu hình ngôn ngữ quốc tế</h1>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-primary mt-sm-2 float-md-right btn-add-language" data-toggle="modal" data-target="#addLanguage">Thêm</button>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NGÔN NGỮ US</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>VN</th>
                                            <th>EN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($CMSNT->get_list("SELECT * FROM `lang` ") as $lang) { ?>
                                        <tr>
                                            <td width="5%"><?=$lang['id'];?></td>
                                            <td width="45%"><?=$lang['vn'];?></td>
                                            <td width="50%"><input type="text" name="<?=$lang['id'];?>" value="<?=$lang['en'];?>"
                                                    class="form-control"></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <button type="submit" name="btnSaveLangUS" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NGÔN NGỮ VN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="table-responsive">
                                <table id="datatable1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>US</th>
                                            <th>VN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($CMSNT->get_list("SELECT * FROM `lang` ") as $lang) { ?>
                                        <tr>
                                            <td width="5%"><?=$lang['id'];?></td>
                                            <td width="45%"><?=$lang['en'];?></td>
                                            <td width="50%"><input type="text" name="<?=$lang['id'];?>" value="<?=$lang['vn'];?>"
                                                    class="form-control"></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <button type="submit" name="btnSaveLangVN" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    <div class="modal fade" id="addLanguage" tabindex="-1" role="dialog" aria-labelledby="addLanguageLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm ngôn ngữ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="vn-text" class="col-form-label">Tiếng việt:</label>
                            <input type="text" class="form-control" id="vn-text" name="vn-text">
                        </div>
                        <div class="form-group">
                            <label for="en-text" class="col-form-label">Tiếng anh:</label>
                            <input type="text" class="form-control" id="en-text" name="en-text">
                        </div>
                        <button type="submit" name="btnAddLang" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
$(function() {
    // Summernote
    $('.textarea').summernote()
})
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
<script>
$(function() {
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
<?php 
    require_once("../../public/admin/Footer.php");
?>