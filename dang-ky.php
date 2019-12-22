<?php
    require_once __DIR__. "/autoload/autoload.php";
    $data = 
        [
            "name" => postInput('name'),
            "password" => MD5(postInput('password')),
            "email" => postInput('email'),
            "phone" => postInput('phone'),
            "address" => postInput('address')

        ];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            $error = [];
            if(postInput('name') == ''){
                $error['name'] = "Mời bạn nhập họ và tên";
            }
            if(postInput('email') == ''){
                $error['email'] = "Mời bạn nhập email";
            }else{
                $is_check = $db ->fetchOne("users", " email = '".$data['email']."' ");
                if($is_check != null){
                    $error['email'] = "email đã tồn tại";
                }
            }
            if(postInput('password') == ''){
                $error['password'] = "Mời bạn nhập password";
            }else{
                $data['password']= MD5(postInput("password"));
            }
            if(postInput('address') == ''){
                $error['address'] = "Mời bạn nhập địa chỉ";
            }
            if(postInput('phone') == ''){
                $error['phone'] = "Mời bạn nhập số điện thoại";
            }
            
            
    
            // error trống nghĩa là k có lỗi
            if(empty($error)){
                            
                $id_insert = $db -> insert("users",$data);
                if($id_insert > 0){
                    $_SESSION['success'] = "Đăng ký thành công. Mời bạn đăng nhập !";
                    header("location: dang-nhap.php");                  
                }else{
                    
                }
            }
        }
    
?>
<?php require_once __DIR__. "/layouts/header.php"; ?>

    <div class="col-md-9 bor">
                       
        <section class="box-main1">
            <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)">Đăng ký thành viên</a> </h3>
            <!-- noi dung -->
            <form action="" method="POST" class="form-horizontal " role="form" style="margin-top: 20px;">
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Tên thành viên</label>
                    <div class="col-md-8">
                        <input type="text" name="name" placeholder="Nguyễn Văn A" class="form-control" value="<?php echo $data['name'] ?>">
                        <?php if(isset($error['name'])): ?>
                            <p class="text-danger" style="color: red;"><?php echo $error['name'] ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Email</label>
                    <div class="col-md-8">
                        <input type="email" name="email" placeholder="example@gmail.com" class="form-control" value="<?php echo $data['email'] ?>">
                        <?php if(isset($error['email'])): ?>
                            <p class="text-danger" style="color: red;"><?php echo $error['email'] ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Password</label>
                    <div class="col-md-8">
                        <input type="password" name="password" placeholder="*****" class="form-control">
                        <?php if(isset($error['password'])): ?>
                            <p class="text-danger" style="color: red;"><?php echo $error['password'] ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Số điện thoại</label>
                    <div class="col-md-8">
                        <input type="number" name="phone" placeholder="0913012345" class="form-control" value="<?php echo $data['phone'] ?>">
                        <?php if(isset($error['phone'])): ?>
                            <p class="text-danger" style="color: red;"><?php echo $error['phone'] ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Địa chỉ</label>
                    <div class="col-md-8">
                        <input type="text" name="address" placeholder="address" class="form-control" value="<?php echo $data['address'] ?>">
                        <?php if(isset($error['address'])): ?>
                            <p class="text-danger" style="color: red;"><?php echo $error['address'] ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success col-md-2 col-md-offset-3" style="margin-bottom: 20px;">Đăng ký</button>
            </form>                            
        </section>
    </div>
    
    <?php require_once __DIR__. "/layouts/footer.php"; ?>               