<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'CHỈNH SỬA DANH MỤC TÀI KHOẢN | '.$CMSNT->site('tenweb');
CheckLogin();
CheckAdmin();
require_once("../../public/admin/Header.php");
require_once("../../public/admin/Sidebar.php");
require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $CMSNT->get_row(" SELECT * FROM `blog` WHERE `id` = '".check_string($_GET['id'])."' AND `userId` = '".$getUser['userId']."' ");
    if(!$row)
    {
        admin_msg_error("Bài viết không hợp lệ", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Bài viết không hợp lệ", BASE_URL(''), 0);
}

if(isset($_POST['btnSubmit']) && isset($_POST['name']) && isset($_POST['categoryId']) && isset($_POST['detail']) && $getUser['level'] == 'admin')
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    if($getUser['level'] != 'admin')
    {
        admin_msg_error('Chức năng này chỉ dành cho Admin.', '', 1000);
    }
    $row = $CMSNT->get_row(" SELECT * FROM `blog` WHERE `id` = '".check_string($_GET['id'])."' ");
    if(!$row) {
        admin_msg_error("Bài viết không hợp lệ", BASE_URL(''), 500);
    }

    $name = check_string($_POST['name']);
    if(strlen($name) < 2 || strlen($name) > 255)
    {
        admin_msg_error("Vui lòng nhập tên từ 2 đến 255 ký tự", '', 1000);
    }
    $slug = check_string($_POST['slug']);
    if(strlen($slug) < 2 || strlen($slug) > 255)
    {
        admin_msg_error("Vui lòng nhập slug từ 2 đến 255 ký tự", '', 1000);
    }
    if(!preg_match('/^[a-z][-a-z0-9]*$/', $slug)){
        admin_msg_error("Slug không hợp lệ (bao gồm chữ, số và dấu gạch nối)", '', 1000);
    }
    $categoryId = $_POST['categoryId'];
    if(!isset($categoryId))
    {
        admin_msg_error("Vui lòng chọn danh mục", '', 1000);
    }
    if(isset($_FILES["fileupload"])){
        $imgUpload = uploadImage($_FILES["fileupload"],'/uploads/image/');
    }else{
        $imgUpload = $row['image'];
    }

    $detail = $_POST['detail'];
    if(!isset($detail) || $detail == '')
    {
        admin_msg_error("Vui lòng nhập nội dung bài viết", '', 1000);
    }
    $sumary = check_string($_POST['sumary']);
    if(!isset($sumary) || $sumary == '')
    {
        admin_msg_error("Vui lòng nhập mô tả ngắn", '', 1000);
    }
    $display = $_POST['display'];
    if(!isset($status))
    {
        admin_msg_error("Vui lòng chọn 1 trạng thái", '', 1000);
    }


    $create = $CMSNT->update("blog", array(
        'name'      => $name,
        'slug'        => $slug,
        'image'           => $imgUpload,
        'detail'    => $detail,
        'sumary'          => $sumary,
        'categoryId'           => $categoryId,
        'display' => $display,
        'updatedDate'   => gettime()
    ), " `id` = '".check_string($_GET['id'])."' ");
    if($create)
    {
        admin_msg_success("Thay đổi thông tin bài viết thành công", "", 1000);
    }
    else
    {
        admin_msg_error("Không thể lưu, vui lòng thử lại sau.", "", 2000);
    }
}
?>



    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chỉnh sửa bài viết</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">EDIT BÀI VIẾT</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" enctype="multipart/form-data" method="POST">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tên bài viết (*)</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                        <textarea class="form-control h-150px" placeholder="VD: Hướng dẫn đăng nhập..." name="name" id="Name" rows="1"
                                                  required><?=$row['name'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Slug(Đường dẫn) </label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <input type="text" name="slug" id ="Slug" value="<?=$row['slug'];?>" placeholder="Ví dụ: huong-dan-dang-nhap"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ảnh</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <input type="file" name="fileupload" id="fileupload"  class="form-control" required>
                                            <img src="<?=BASE_URL($row['image']);?>" class="mt-2" width="100px" height="auto" id="showInputFile" alt="Image" onerror="this.src='https://lh3.googleusercontent.com/proxy/Di8xO7cS-XErquhA5cfZfMcrg6XI9wmFHuI3onblumgc7x31EBKRv15V-izLK2dxSj_TupccpjMFmKgjyY4YNv3CULXmZKCRuX1SdfU9YDjfYHitS6aU2MUdcu3S';">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Danh mục</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="categoryId" required>
                                            <option value="">* Chọn danh mục</option>
                                            <?php foreach($CMSNT->get_list("SELECT * FROM `category_blog` WHERE id > 1") as $category) { ?>
                                                <option value="<?=$category['id'];?>"><?=$category['name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mô tả ngắn</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                        <textarea class="form-control h-150px"
                                                  placeholder="Mô tả ngắn về bài viết" name="sumary"
                                                  rows="6" required><?=$row['sumary'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nội dung</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                        <textarea class="textarea" name="detail"
                                                  rows="6"><?=$row['detail'];?> </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Hiển thị</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="display" required>
                                            <option value="SHOW" <?=$row['display'] == 'SHOW' ? 'selected':'';?>>SHOW</option>
                                            <option value="HIDE" <?=$row['display'] == 'HIDE' ? 'selected':'';?>>HIDE</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="btnSubmit" class="btn btn-primary btn-block waves-effect">
                                    <span>THÊM NGAY</span>
                                </button>
                                <a type="button" href="<?=BASE_URL('Admin/Blogs');?>"
                                   class="btn btn-danger btn-block waves-effect">
                                    <span>TRỞ LẠI</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="modal fade" id="Listflag" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">DANH SÁCH QUỐC GIA</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>FLAG</th>
                                <th>FILE NAME</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = COUNT(dirToArray('../../template/flag/')); foreach(dirToArray('../../template/flag/') as $row){ ?>
                                <?php $path_parts = pathinfo('../../template/flag/'.$row); ?>
                                <tr>
                                    <td><?=$i--;?></td>
                                    <td><img width="40px" src="<?=BASE_URL('template/flag/'.$row);?>" />
                                    </td>
                                    <td><?=$path_parts['filename'];?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect"
                            data-dismiss="modal"><span>ĐÓNG</span></button>
                </div>
            </div>
        </div>
    </div>
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
            // Summernote
            $('.textarea').summernote()
        })
    </script>
    <!--    image show-->
    <script>
        fileupload.onchange = evt => {
            const [file] = fileupload.files
            if (file) {
                showInputFile.src = URL.createObjectURL(file);
            }
        }
    </script>
<?php
require_once("../../public/admin/Footer.php");
?>