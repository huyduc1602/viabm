<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    CheckLogin();
    CheckAdmin();
    $title = 'DANH MỤC TÀI KHOẢN | '.$CMSNT->site('tenweb');
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
    
    if(isset($_POST['XoaBaiViet']) && $getUser['level'] == 'admin' )
    {
        $id = check_string($_POST['id']);
        if(!$row = $CMSNT->get_row("SELECT * FROM `blog` WHERE `id` = '$id' "))
        {
            msg_error2("ID cần xóa không tồn tại trong hệ thống !");
        }
        if($CMSNT->site('status_demo') == 'ON')
        {
            admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
        }
        // GHI LOG
        $file = @fopen('../../logs/XoaBaiViet.txt', 'a');
        if ($file)
        if ($file)
        {
            $data = "[LOG] Baì viết ID ".$row['id']." đã bị xóa khỏi hệ thống vào lúc ".gettime().PHP_EOL;
            fwrite($file, $data);
            fclose($file);
        }
        $CMSNT->remove("blog", " `id` = '$id' ");
        admin_msg_success("Xóa thành công !", "", 1000);
    }

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách bài viết</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">QUẢN LÝ BÀI VIẾT</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                    <div id="thongbao"></div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>TÊN</th>
                                        <th>SLUG</th>
                                        <th>DANH MỤC</th>
                                        <th>NGƯỜI TẠO</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($CMSNT->get_list(" SELECT * FROM `blog` ORDER BY id DESC ") as $row){
                                        if($row['categoryId'] >= 1){
                                            $categoryParent = $CMSNT->get_row("SELECT * FROM `category_blog` WHERE `id` = '".$row['categoryId']."' ");
                                        }else{
                                            $categoryParent = $CMSNT->get_row("SELECT * FROM `category_blog` WHERE `id` = '1' ");
                                        }
                                        $userCreated['username'] = 'Không tìm thấy';
                                        if($row['userId'] >= 1){
                                           $userCreated = $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '".$row['userId']."' ");
                                        }
                                        ?>
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td><b><?=$row['name'];?></b></td>
                                        <td><?=$row['slug'];?></td>
                                        <td><?=$categoryParent['name'];?></td>
                                        <td><?=$userCreated['username'];?></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Admin/Blog/Edit/');?><?=$row['id'];?>"
                                                class="btn bg-black">
                                                <span>EDIT</span></a>

                                            <button class="btn btn-danger btnDelete" id="XoaBaiViet" data-id="<?=$row['id'];?>"><i
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
    </section>
</div>


<script type="text/javascript">
$(".btnDelete").on("click", function() {
    Swal.fire({
        title: 'Xác nhận xóa bài viết',
        text: "Bạn có chắc chắn xóa bài viết này không ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'XÓA NGAY',
        cancelButtonText: 'HỦY'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "<?=BASE_URL("public/admin/Blogs.php");?>",
                method: "POST",
                data: {
                    XoaBaiViet: true,
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
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>

<?php 
    require_once("../../public/admin/Footer.php");
?>