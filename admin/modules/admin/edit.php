<?php 
    $open = "admin";

    require_once __DIR__. "/../../autoload/autoload.php";
    $id = intval((getInput('id')));
    
    $editAdmin = $db->fetchID("admin",$id);
    if(empty($editAdmin)){
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("admin");
    }

    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $data = 
        [
            "name" => postInput('name'),
            
            "email" => postInput('email'),
            "phone" => postInput('phone'),
            "address" => postInput('address'),
            "level" => postInput('level'),

        ];
        $error = [];
        if(postInput('name') == ''){
            $error['name'] = "Mời bạn nhập họ và tên";
        }
        if(postInput('email') == ''){
            $error['email'] = "Mời bạn nhập email";
        }
        else{
            if(postInput("email") != $editAdmin['email']){
                $is_check = $db ->fetchOne("admin", " email = '".$data['email']."' ");
                if($is_check != null){
                $error['email'] = "email đã tồn tại";
            }
            }
        }
       
        if(postInput('address') == ''){
            $error['address'] = "Mời bạn nhập địa chỉ";
        }
        if(postInput('phone') == ''){
            $error['phone'] = "Mời bạn nhập số điện thoại";
        }
        if(postInput('password') != null && postInput('re_password') != null  ){
            if(postInput('password') != postInput('re_password')){
                $error['password'] ="Mật khẩu thay đổi không khớp";
            }else{
                $data['password'] = MD5(postInput("password"));
            }
        }       
        

        // error trống nghĩa là k có lỗi
        if(empty($error)){
             
            $id_update = $db -> update("admin",$data,array("id" => $id));
            if($id_update >0){
                $_SESSION['success'] = "Cập nhật thành công";
                redirectAdmin("admin");
            }else{
                $_SESSION['error'] = "TCập nhật thất bại";
                redirectAdmin("admin");

            }
        }
    }
    
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <!-- Page Heading NOI DUNG -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Cập nhật người dùng
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li>
                    <i></i>  <a href="">Admin</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Cập nhật
                </li>
            </ol>
            <div class="clearfix"></div>
            <!-- thông báo lỗi -->
            <?php require_once __DIR__. "/../../../partials/notification.php"; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Họ và tên</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Họ và tên" name="name"   value="<?php echo $editAdmin['name'] ?>">
                        <?php if(isset($error['name'])): ?>
                            <p class="text-danger"><?php echo $error['name'] ?></p>
                        <?php endif?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="example@gmail.com" name="email" value="<?php echo $editAdmin['email'] ?>">
                        <?php if(isset($error['email'])): ?>
                            <p class="text-danger"><?php echo $error['email'] ?></p>
                        <?php endif?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="address" name="address" value="<?php echo $editAdmin['address'] ?>">
                        <?php if(isset($error['address'])): ?>
                            <p class="text-danger"><?php echo $error['address'] ?></p>
                        <?php endif?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="0910123456" name="phone" value="<?php echo $editAdmin['phone'] ?>">
                        <?php if(isset($error['phone'])): ?>
                            <p class="text-danger"><?php echo $error['phone'] ?></p>
                        <?php endif?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="inputEmail3" placeholder="password" name="password" value="<?php echo $editAdmin['password'] ?>">
                        <?php if(isset($error['password'])): ?>
                            <p class="text-danger"><?php echo $error['password'] ?></p>
                        <?php endif?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Config Password</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="inputEmail3" placeholder="password" name="re_password" value="<?php echo $editAdmin['password'] ?>">
                        <?php if(isset($error['re_password'])): ?>
                            <p class="text-danger"><?php echo $error['re_password'] ?></p>
                        <?php endif?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Level</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="level" >
                            <option value="1" <?php echo isset($editAdmin['level']) && $editAdmin['level'] == 1 ? "selected = 'selected'" : '' ?>>CTV</option>
                            <option value="1" <?php echo isset($editAdmin['level']) && $editAdmin['level'] == 2 ? "selected = 'selected'" : '' ?>>Admin</option>
                        </select>
                        <?php if(isset($error['level'])): ?>
                            <p class="text-danger"><?php echo $error['level'] ?></p>
                        <?php endif?>
                    </div>
                    
                </div>
                                
                <div class="form-group">
                    <div class="col-sm-offset-2  col-sm-10">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row -->
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>