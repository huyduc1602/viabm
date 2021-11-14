<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    CheckLogin();
    CheckAdmin();
    $title = 'QUẢN LÝ DANH MỤC BÀI VIẾT | '.$CMSNT->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");

    if(isset($_POST['XoaDanhMuc']) && $getUser['level'] == 'admin' )
    {
        $id = check_string($_POST['id']);
        $row = $CMSNT->get_row("SELECT * FROM `category_blog` WHERE `id` = '$id' ");
        if(!$row)
        {
            msg_error2("ID cần xóa không tồn tại trong hệ thống !");
        }
        if($CMSNT->site('status_demo') == 'ON')
        {
            admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
        }
        // GHI LOG
        $file = @fopen('../../logs/XoaCategoryBlog.txt', 'a');
        if ($file)
        {
            $data = "[LOG] Danh mục ".$row['name']." đã bị xóa khỏi hệ thống vào lúc ".gettime().PHP_EOL;
            fwrite($file, $data);
            fclose($file);
        }
        $CMSNT->remove("category_blog", " `id` = '$id' ");
        admin_msg_success("Xóa thành công !", "", 1000);
    }
?>

<?php
if(isset($_POST['ThemDanhMuc']) && $getUser['level'] == 'admin' )
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    if(!isset($_POST['name']))
    {
        admin_msg_error("Vui lòng nhập tên danh mục", '', 1000);
    }
    if(!isset($_POST['slug']))
    {
        admin_msg_error("Vui lòng nhập slug danh mục", '', 1000);
    }
    $CMSNT->insert("category_blog", array(
        'name' => check_string($_POST['name']),
        'slug'     => check_string($_POST['slug']),
        'parentId'   => check_string($_POST['parentId'])
    ));
    admin_msg_success("Thêm thành công", '', 500);
}
if(isset($_POST['LuuDanhMuc']) && $getUser['level'] == 'admin' )
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    if(!isset($_POST['name']))
    {
        admin_msg_error("Vui lòng nhập tên danh mục", '', 1000);
    }
    if(!isset($_POST['slug']))
    {
        admin_msg_error("Vui lòng nhập slug danh mục", '', 1000);
    }
    $CMSNT->update("category_blog", array(
        'name' => check_string($_POST['name']),
        'slug'     => check_string($_POST['slug']),
        'parentId'   => check_string($_POST['parentId'])
    ), " `id` = '".check_string($_POST['id'])."' ");
    admin_msg_success("Lưu thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh mục bài viết</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM DANH MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id ="Id" class="form-control">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" id ="Name" class="form-control" placeholder="VD: Thủ thuật" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Slug(Đường dẫn)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="slug" id ="Slug" class="form-control" placeholder="VD: thu-thuat" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Danh mục cha</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="parentId" required>
                                        <?php foreach($CMSNT->get_list("SELECT * FROM `category_blog`") as $category) { ?>
                                            <option value="<?=$category['id'];?>"><?=$category['name'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="ThemDanhMuc" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH DANH MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="thongbao"></div>
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>TÊN DANH MỤC</th>
                                        <th>SLUG</th>
                                        <th>DANH MỤC CHA</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `category_blog` ORDER BY id DESC ") as $row){
                                        if($row['id'] == 1){
                                            continue;
                                        }
                                        if($row['parentId'] >= 1){
                                            $categoryParent = $CMSNT->get_row("SELECT * FROM `category_blog` WHERE `id` = '".$row['parentId']."' ");
                                        }else{
                                            $categoryParent = $CMSNT->get_row("SELECT * FROM `category_blog` WHERE `id` = '1' ");
                                        }
                                        ?>
                                    <tr>
                                        <td><?=$row['name'];?></td>
                                        <td><?=$row['slug'];?></td>
                                        <td><?=$categoryParent['name'];?></td>
                                        <td>
                                            <button class="btn btn-primary btnEdit" data-id="<?=$row['id'];?>"
                                                    data-name="<?=$row['name'];?>" data-slug="<?=$row['slug'];?>" data-parentId="<?=$row['parentId'];?>" >
                                                <i class="fas fa-edit"></i>
                                                <span>EDIT</span>
                                            </button>
                                            <button class="btn btn-danger btnDelete" id="XoaDanhMuc" data-id="<?=$row['id'];?>"><i
                                                    class="fas fa-trash"></i>
                                                <span>DELETE</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">EDIT CHUYÊN MỤC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tên</label>
                        <div class="col-sm-9">
                            <div class="form-line">
                                <input type="text" name="name" id="name" class="form-control" placeholder="VD: Thủ thuật" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Slug(Đường dẫn)</label>
                        <div class="col-sm-9">
                            <div class="form-line">
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="VD: thu-thuat" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Danh mục cha</label>
                        <div class="col-sm-9">
                            <select class="form-control show-tick" name="parentId" id="parentId" required>
                                <?php foreach($CMSNT->get_list("SELECT * FROM `category_blog`") as $category) { ?>
                                    <option value="<?=$category['id'];?>"><?=$category['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="LuuDanhMuc" class="btn btn-danger">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->


<script type="text/javascript">
$(".btnDelete").on("click", function() {
    Swal.fire({
        title: 'Xác nhận xóa danh mục',
        text: "Bạn có chắc chắn xóa danh mục này không ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'XÓA NGAY',
        cancelButtonText: 'HỦY'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "<?=BASE_URL("public/admin/CategoryBlogs.php");?>",
                method: "POST",
                data: {
                    XoaDanhMuc: true,
                    id: $(this).attr("data-id")
                },
                success: function(response) {
                    $("#thongbao").html(response);
                }
            });
        }
    })
});
</script>

<script type="text/javascript">
$('.btnEdit').on('click', function(e) {
    var btn = $(this);
    $("#name").val(btn.attr("data-name"));
    $("#slug").val(btn.attr("data-slug"));
    if(btn.attr("data-parentId") >= 1){
        $("#parentId").val(btn.attr("data-parentId"));
    }
    $("#id").val(btn.attr("data-id"));
    $("#staticBackdrop").modal();
    return false;
});
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable2").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
    <script>
        //Auto slug
        $(function () {
            $('#Name').keyup(function () {
                $slug = to_slug($('#Name').val());
                $('#Slug').val($slug);
            });
            $('#name').keyup(function () {
                $slug = to_slug($('#name').val());
                $('#slug').val($slug);
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


<?php 
    require_once(__DIR__."/Footer.php");
?>