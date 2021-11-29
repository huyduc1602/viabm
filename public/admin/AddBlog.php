<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THÊM BÀI VIẾT | '.$CMSNT->site('tenweb');
    require_once("../../public/admin/Header.php");
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php
if(isset($_POST['btnSubmit']) && isset($_POST['name']) && isset($_POST['categoryId']) && isset($_POST['detail']) && $getUser['level'] == 'admin')
{
    if($getUser['level'] != 'admin')
    {
        admin_msg_error('Chức năng này chỉ dành cho Admin.', '', 2000);
    }
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    if(!isset($_SESSION['username'])){
        admin_msg_success("Vui lòng đăng nhập", BASE_URL('Auth/Login'), 1000);
    }
    $userId =  $getUser['id'];
    $name = check_string($_POST['name']);
    if(strlen($name) < 2 || strlen($name) > 255)
    {
        admin_msg_error("Vui lòng nhập tên từ 2 đến 255 ký tự", '', 1000);
    }else{
        $name_en = check_string($_POST['name_en']);
        if(!isset($name_en) || $name_en == ''){
            $name_en = $name;
        }
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
//    $imgUpload = uploadImage($_FILES["fileupload"],'/uploads/image/');

//    if(check_img('img') == true)
//    {
//        $rand = random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 12);
//        $uploads_dir = '../../assets/storage/images';
//        $tmp_name = $_FILES['img']['tmp_name'];
//        $url_img = "/blog_".$rand.".png";
//        $create = move_uploaded_file($tmp_name, $uploads_dir.$url_img);
//        $imgUpload = 'assets/storage/images'.$url_img;
//    }else{
//        $imgUpload = 'template/img/default.jpg';
//    }
    $image = $_POST['image'];
    if(!isset($image))
    {
        admin_msg_error("Vui lòng chọn ảnh", '', 1000);
    }
    $detail = $_POST['detail'];
    if(!isset($detail) || $detail == '')
    {
        admin_msg_error("Vui lòng nhập nội dung bài viết", '', 1000);
    }else{
        $detail_en = check_string($_POST['detail_en']);
        if(!isset($detail_en) || $detail_en == ''){
            $detail_en = $detail;
        }
    }
    $sumary = check_string($_POST['sumary']);
    if(!isset($sumary) || $sumary == '')
    {
        admin_msg_error("Vui lòng nhập mô tả ngắn", '', 1000);
    }else{
        $sumary_en = check_string($_POST['sumary_en']);
        if(!isset($sumary_en) || $sumary_en == ''){
            $sumary_en = $sumary;
        }
    }
    $display = $_POST['display'];
    if(!isset($display))
    {
        admin_msg_error("Vui lòng chọn 1 trạng thái", '', 1000);
    }
    $create = $CMSNT->insert("blog", array(
        'name'      => $name,
        'slug'        => $slug,
        'image'           => $image,
        'detail'    => $detail,
        'sumary'          => $sumary,
        'categoryId'           => $categoryId,
        'userId'       => $userId,
        'display' => $display,
        'createdDate'   => gettime(),
        'updatedDate'   => gettime()
    ));

    if($create)
    {
        //Thêm ngôn ngữ
        $field_lang =   [
            ["name"=>"name","vi"=>$name,"en"=>$name_en],
            ["name"=>"detail","vi"=>$detail,"en"=>$detail_en],
            ["name"=>"sumary","vi"=>$sumary,"en"=>$sumary_en],
       ];
        $create_lang = insertOrUpdateTableLang('blog',$field_lang,0);
        if($create_lang){
            admin_msg_success("Tạo bài viết thành công", BASE_URL('Admin/Blogs'), 1000);
        }
    }
    else
    {
        admin_msg_error("Không thể thêm bài viết, vui lòng thử lại sau.", "", 2000);
    }
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm tin tức</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM BÀI VIẾT MỚI</h3>
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
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#name_vi" role="tab" aria-controls="name_vi" aria-selected="true">Việt</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="en-tab" data-toggle="tab" href="#name_en" role="tab" aria-controls="name_en" aria-selected="false">Anh</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="name_vi" role="tabpanel" aria-labelledby="home-tab">
                                              <textarea class="form-control h-150px" placeholder="VD: Hướng dẫn đăng nhập..." name="name" id="Name" rows="1"
                                                        required></textarea>
                                            </div>
                                            <div class="tab-pane fade" id="name_en" role="tabpanel" aria-labelledby="profile-tab">
                                                 <textarea class="form-control h-150px" placeholder="VD: Hướng dẫn đăng nhập..." name="name_en" id="Name_EN" rows="1"
                                                            ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Slug(Đường dẫn) </label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="slug" id ="Slug" value="" placeholder="Ví dụ: huong-dan-dang-nhap"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
<!--                                        <input type="file" name="img"-->
<!--                                            id="fileupload" class="form-control" required>-->
                                        <input type="text" name="image" id ="Image" value="" placeholder="Nhập đường link ảnh"
                                               class="form-control" required>
                                        <i>Upload ảnh lên <a target="_blank" href="https://imgur.com/upload?beta">đây</a>,
                                            sau đó copy địa chỉ hình ảnh dán vào ô trên.</i>
                                    </div>
                                    <img src="<?=BASE_URL('template/img/default.jpg');?>" class="mt-2" id="showInputFile" width="100px" height="auto" onerror="this.src='<?=BASE_URL('template/img/default.jpg');?>';" alt="Image">
                                    <p class="badge badge-info">Nên chọn cỡ ảnh width / height = 4/3</p>
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
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#sumary_vi" role="tab" aria-controls="sumary_vi" aria-selected="true">Việt</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="en-tab" data-toggle="tab" href="#sumary_en" role="tab" aria-controls="sumary_en" aria-selected="false">Anh</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="sumary_vi" role="tabpanel" aria-labelledby="home-tab">
                                                <textarea class="form-control h-150px"
                                                          placeholder="Mô tả ngắn về bài viết" name="sumary"
                                                          rows="6" required></textarea>
                                            </div>
                                            <div class="tab-pane fade" id="sumary_en" role="tabpanel" aria-labelledby="profile-tab">
                                                <textarea class="form-control h-150px"
                                                          placeholder="Mô tả ngắn về bài viết" name="sumary_en"
                                                          rows="6"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nội dung</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#detail_vi" role="tab" aria-controls="detail_vi" aria-selected="true">Việt</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="en-tab" data-toggle="tab" href="#detail_en" role="tab" aria-controls="detail_en" aria-selected="false">Anh</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="detail_vi" role="tabpanel" aria-labelledby="home-tab">
                                                <textarea class="textarea" name="detail"
                                                          rows="6"> </textarea>
                                            </div>
                                            <div class="tab-pane fade" id="detail_en" role="tabpanel" aria-labelledby="profile-tab">
                                                 <textarea class="textarea" name="detail_en"
                                                           rows="6"> </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="display" required>
                                        <option value="SHOW">SHOW</option>
                                        <option value="HIDE">HIDE</option>
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
<script>
    //Auto slug
    $(function () {
        $('#Name').keyup(function () {
            $slug = to_slug($('#Name').val());
            $('#Slug').val($slug);
            console.log($(this).val())
        });
    });
    function to_slug(str) {
        // Chuyển hết sang chữ thường
        str = str.toLowerCase();

        // xóa dấu
        str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
        str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
        str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
        str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
        str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
        str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
        str = str.replace(/(đ)/g, 'd');

        // Xóa ký tự đặc biệt
        str = str.replace(/([^0-9a-z-\s])/g, '');

        // Xóa khoảng trắng thay bằng ký tự -
        str = str.replace(/(\s+)/g, '-');

        // xóa phần dự - ở đầu
        str = str.replace(/^-+/g, '');

        // xóa phần dư - ở cuối
        str = str.replace(/-+$/g, '');

        // return
        return str;
    }
    </script>
    <!--    image show-->
    <script>
        // fileupload.onchange = evt => {
        //     const [file] = fileupload.files
        //     if (file) {
        //         showInputFile.src = URL.createObjectURL(file);
        //     }
        // }
        $('#Image').blur(function(){
            showInputFile.src = $('#Image').val();
        });
    </script>
<?php 
    require_once("../../public/admin/Footer.php");
?>