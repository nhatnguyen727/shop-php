<?php
    require_once __DIR__. "/autoload/autoload.php";
    $user = $db -> fetchID("users", intval($_SESSION['name_id']));
    if($_SERVER['REQUEST_METHOD']  == "POST"){
        $data =
        [
            'amount' => $_SESSION['total'],
            'users_id' => $_SESSION['name_id'],
            'note' => postInput("note")
        ];
        _debug($data);
        $idtran = $db -> insert("transaction",$data);
        if($idtran > 0){
            foreach($_SESSION['cart'] as $key => $values){
                $data2 = [
                    'transaction_id' => $idtran,
                    'product_id' => $key,
                    'qty' => $values['qty'],
                    'price' => $values['price']
                    
                ];

                $id_insert = $db ->insert("orders",$data2);
            }
            unset($_SESSION['cart']);
            unset($_SESSION['total']);
            $_SESSION['success'] = " Lưu thông tin đơn hàng thành công ! Chúng tôi sẽ liên hệ với bạn sớm nhất ";
            header("location: thong-bao.php");
        }
    }
?>
<?php require_once __DIR__. "/layouts/header.php"; ?>

    <div class="col-md-9 bor">
                       
        <section class="box-main1">
            <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Thanh toán đơn hàng </a> </h3>
            <!-- noi dung -->
            <form action="" method="POST" class="form-horizontal " role="form" style="margin-top: 20px;">
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Tên thành viên</label>
                    <div class="col-md-8">
                        <input type="text" readonly="" name="name" placeholder="Nguyễn Văn A" class="form-control" value="<?php echo $user['name'] ?>">
                        
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Email</label>
                    <div class="col-md-8">
                        <input type="email" readonly="" name="email" placeholder="example@gmail.com" class="form-control" value="<?php echo $user['email'] ?>">
                        
                    </div>
                </div>
                
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Số điện thoại</label>
                    <div class="col-md-8">
                        <input type="number" readonly="" name="phone" placeholder="0913012345" class="form-control" value="<?php echo $user['phone'] ?>">
                        
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Địa chỉ</label>
                    <div class="col-md-8">
                        <input type="text" readonly="" name="address" placeholder="address" class="form-control" value="<?php echo $user['address'] ?>">
                        
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Số tiền</label>
                    <div class="col-md-8">
                        <input type="text" readonly="" name="total" placeholder="" class="form-control" value="<?php echo formatPrice($_SESSION['total']) ?>">
                        
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-2 col-md-offset-1" style="margin-top: 10px;">Ghi chú</label>
                    <div class="col-md-8">
                        <input type="text"  name="note" placeholder="giao hàng tận nơi" class="form-control">
                        
                    </div>
                </div>
                <button type="submit" class="btn btn-success col-md-2 col-md-offset-3" style="margin-bottom: 20px;">Xác nhận</button>
            </form>                
        </section>
    </div>
    
    <?php require_once __DIR__. "/layouts/footer.php"; ?>               