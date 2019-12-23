<?php
    require_once __DIR__. "/autoload/autoload.php";
    $sum =0;

    if( ! isset($_SESSION['cart']) || count($_SESSION['cart'] == 0)){
        echo "<script>alert(' Không có sản phẩm trong giỏ hàng');location.href='gio-hang.php'</script>";
    }
?>
<?php require_once __DIR__. "/layouts/header.php"; ?>

    <div class="col-md-9 bor">
                       
        <section class="box-main1">
            <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Giỏ hàng của bạn </a> </h3>
            <table class="table table-hover" >
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; foreach($_SESSION['cart'] as $key => $value): ?>
                        
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td>
                                <img src="<?php echo uploads() ?>product/<?php echo $value['thunbar'] ?>" width="80px" height="80px">
                            </td>
                            <td >
                                <input type="number" name="qty" value="<?php echo $value['qty'] ?>" class="form-control"  min="0" style="width: 50px;">
                            </td>
                            <td><?php echo formatPrice($value['price']) ?></td>
                            <td><?php echo formatPrice($value['price'] * $value['qty']) ?></td>
                            <td>
                                <a href="" class="btn btn-xs btn-danger "><i class="fa fa-remove" style="color: white;"></i> Remove</a>
                                <a href="" class="btn btn-xs btn-info "><i class="fa fa-refresh" style="color: white;"></i> Update</a>
                            </td>
                        </tr>
                        <?php $sum += $value['price'] * $value['qty']; $_SESSION['tongtien'] = $sum ?>
                    <?php $stt ++; endforeach ?>
                </tbody>
            </table>  
            <div class="col-md-5 pull-right">
                <ul class="list-group">
                    <li class="list-group-item ">
                        <h3> Thông tin đơn hàng</h3>
                    </li>
                    <li class="list-group-item ">
                        <span class="badge"><?php echo formatPrice($_SESSION['tongtien']) ?></span> Số tiền
                    </li>
                    <li class="list-group-item ">
                        <span class="badge">10 %</span>
                        Thuế VAT
                    </li>
                    <li class="list-group-item ">
                    <span class="badge"><?php $_SESSION['total'] = $_SESSION['tongtien'] * 110/100; echo formatPrice($_SESSION['total']) ?></span> Tổng tiền thanh toán
                    </li>
                    <li class="list-group-item ">
                        <a href="index.php" class="btn btn-xs btn-success">Tiếp tục mua hàng</a>
                        <a href="thanh-toan.php" class="btn btn-xs btn-success">Thanh toán</a>
                    </li>
                </ul>

            </div>             
        </section>
    </div>
    
    <?php require_once __DIR__. "/layouts/footer.php"; ?>   