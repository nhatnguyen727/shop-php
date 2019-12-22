<?php 
    $open = "category";

    require_once __DIR__. "/../../autoload/autoload.php";
    
    $id = intval((getInput('id')));
    
    $editProduct = $db->fetchID("product",$id);
    if(empty($editProduct)){
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("product");
    }

    $category = $db -> fetchAll("category");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        

        $data = 
        [
            "name" => postInput('name'),
            "slug" => to_slug(postInput('name')),
            "category_id" => postInput('category_id'),
            "price" => postInput('price'),
            "number" => postInput('number'),
            "content" => postInput('content'),
            "sale" => postInput("sale")

        ];
        $error = [];
        if(postInput('name') == ''){
            $error['name'] = "Mời bạn nhập tên danh mục";
        }
        if(postInput('category_id') == ''){
            $error['category_id'] = "Mời bạn chọn tên danh mục";
        }
        if(postInput('price') == ''){
            $error['price'] = "Mời bạn nhập giá";
        }
        if(postInput('content') == ''){
            $error['content'] = "Mời bạn nhập số lượng sản phẩm";
        }
        if(postInput('number') == ''){
            $error['number'] = "Mời bạn nhập nội dung sản phẩm";
        }
        
        if(! isset($_FILES['thunbar'])){
            $error['thunbar'] = "Mời bạn chọn hình ảnh ";
        }

        // error trống nghĩa là k có lỗi
        if(empty($error)){

            if(isset($_FILES['thunbar'])){
                $file_name = $_FILES['thunbar']['name'];
                $file_tmp = $_FILES['thunbar']['tmp_name'];
                $file_type = $_FILES['thunbar']['type'];
                $file_erro = $_FILES['thunbar']['error'];

                if($file_erro == 0){
                    $part = ROOT ."product/";
                    $data['thunbar'] = $file_name;
                }
            }

            $update = $db -> update("product",$data,array("id"=>$id));
            if($update>0){
                move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success'] = "Cập nhật thành công";
                redirectAdmin("product");
            }else{
                $_SESSION['error'] = "Cập nhật thất bại";
                redirectAdmin("product");

            }
            
        }
    }
    
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <!-- Page Heading NOI DUNG -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Cập nhật Sản phẩm
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li>
                    <i></i>  <a href="">Sản phẩm</a>
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
                    <label for="inputEmail3" class="col-sm-2 control-label">Danh mục sản phẩm</label>
                    <div class="col-sm-4">
                        <select class="form-control col-md-8" name="category_id"> 
                            <option value=""> - Mời bạn chọn danh mục sản phẩm - </option>
                            <?php foreach ($category as $item): ?>
                                <option value="<?php echo $item['id'] ?>"<?php echo $editProduct['category_id'] == $item['id'] ? "selected = 'selected'" : " " ?>><?php echo $item['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <?php if(isset($error['category'])): ?>
                            <p class="text-danger"><?php echo $error['category'] ?></p>
                        <?php endif?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩm</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Tên sản phẩm" name="name" value="<?php echo $editProduct['name'] ?>">
                        <?php if(isset($error['name'])): ?>
                            <p class="text-danger"><?php echo $error['name'] ?></p>
                        <?php endif?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Giá sản phẩm</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="VND" name="price" value="<?php echo $editProduct['price'] ?>">
                        <?php if(isset($error['price'])): ?>
                            <p class="text-danger"><?php echo $error['price'] ?></p>
                        <?php endif?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Số lượng</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="100" name="number" value="<?php echo $editProduct['number'] ?>">
                        <?php if(isset($error['number'])): ?>
                            <p class="text-danger"><?php echo $error['number'] ?></p>
                        <?php endif?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Giảm giá</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="10%" name="sale" value="0" value="<?php echo $editProduct['sale'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Hình ảnh</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" id="inputEmail3" name="thunbar">
                        <?php if(isset($error['thunbar'])): ?>
                            <p class="text-danger"><?php echo $error['thunbar'] ?></p>
                        <?php endif?>
                        <img src="<?php echo uploads() ?>product/<?php echo $editProduct['thunbar'] ?>" width="80px" height="80px">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" name="content" rows="5" ><?php echo $editProduct['content'] ?>"</textarea>
                        <?php if(isset($error['content'])): ?>
                            <p class="text-danger"><?php echo $error['content'] ?></p>
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