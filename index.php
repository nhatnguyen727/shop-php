<?php
    require_once __DIR__. "/autoload/autoload.php";
    // unset($_SESSION['cart']);
    $sqlHomeCate = "SELECT name, id FROM  category WHERE home = 1 ORDER BY updated_at";
    $categoryHome = $db -> fetchsql($sqlHomeCate);

    $date = [];
    foreach ($categoryHome as $item){
        $cateID = intval($item['id']);
        $sql = "SELECT * FROM product WHERE category_id = $cateID";
        $productHome = $db ->fetchsql($sql);
        $data[$item['name']] =$productHome;
    }
?>
<?php require_once __DIR__. "/layouts/header.php"; ?>

        <div class="col-md-9 bor">
            <section id="slide" class="text-center" >
                <img src="<?php echo base_url() ?>public/fontend/images/slide/sl3.jpg" class="img-thumbnail">
            </section>
            
            <section class="box-main1">
            <?php foreach ($data as $key => $value): ?>
                <h3 class="title-main"><a href=""><?php echo $key ?></a></h3>
                            
                <div class="showitem">
                <?php foreach ($value as $item): ?>
                    <div class="col-md-3 item-product bor">
                        <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>">
                            <img src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>" class="" width="100%" height="180">
                        </a>
                        <div class="info-item">
                            <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                            <?php if ($item['sale'] > 0): ?>
                                <p><strike class="sale"><?php echo formatPrice($item['price'])?></strike> <b class="price"><?php echo formatPriceSale($item['price'],$item['sale'])?>đ</b></p>
                            <?php else: ?>
                                <p><b class="price"><?php echo formatPrice($item['price'])?>đ</b></p>
                            <?php endif ?>

                        </div>
                        <div class="hidenitem">
                            <p><a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                            <p><a href=""><i class="fa fa-heart"></i></a></p>
                            <p><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <?php endforeach ?>            
            </section>
        </div>
    
    <?php require_once __DIR__. "/layouts/footer.php"; ?>               