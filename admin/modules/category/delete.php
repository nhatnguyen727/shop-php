<?php 
    $open = "category";

    require_once __DIR__. "/../../autoload/autoload.php";
    
    $id = intval((getInput('id')));
    
    $editCategory = $db->fetchID("category",$id);
    if(empty($editCategory)){
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("category");
    }
    /**
     * kiểm tra xem danh mục có sản phẩm
     */
    $is_product = $db ->fetchOne("product"," category_id = $id ");
    if($is_product == null){
        $num = $db -> delete("category",$id);
        if($num>0){
            $_SESSION['success'] = "Xóa thành công";
            redirectAdmin("category");
        }else{
            $_SESSION['error'] = "Xóa thất bại";
            redirectAdmin("category");
        }
    }else{
        $_SESSION['error'] = "Danh mục có sản phẩm. Xóa thất bại";
        redirectAdmin("category");
    }

    
    
?>