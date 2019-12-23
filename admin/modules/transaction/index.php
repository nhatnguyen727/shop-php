<?php 
    $open = "transaction";
     require_once __DIR__. "/../../autoload/autoload.php";
    
    if(isset($_GET['page'])){
        $p = $_GET['page'];
    }else{
        $p=1;
    }
    $sql = "SELECT transaction.* , users.name as nameuser, users.phone as phoneuser FROM transaction LEFT JOIN users on transaction.users_id = users.id ORDER By ID DESC";
    $transaction = $db -> fetchJone("transaction",$sql,$p,10,true);
    if(isset($transaction['page'])){
        $sotrang = $transaction['page'];
        unset($transaction['page']);
    }
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
    <!-- Page Heading NOI DUNG -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Danh sách đơn hàng
                             
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Transaction
                </li>
            </ol>
               <div class="clearfix">
                   <!-- thông báo lỗi -->
                <?php require_once __DIR__. "/../../../partials/notification.php"; ?>

               </div>    
                
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
        <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt = 1; foreach ($transaction as $item): ?>
                <tr>
                    <td><?php echo $stt ?></td>
                    <td><?php echo $item['nameuser'] ?></td>
                    <td><?php echo $item['phoneuser'] ?></td>
                    <td>
                        <?php if($item['status'] == 0): ?>
                            <a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs btn-danger">Chưa xử lý</a>
                        <?php else: ?>
                            <a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs btn-info">Đã xử lý</a>
                        <?php endif ?>
                    </td>
                    <td>
                        
                        <a class="btn btn-xs btn-danger " href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i> Xóa</a>
                    </td>
                </tr>
            <?php $stt++; endforeach ?>
        </tbody>
    </table>
        <div class="pull-right">
            <nav aria-label="...">
                <ul class="pagination">
                    <li >
                        <a href="" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                    </li>
                    <?php for($i = 1; $i <= $sotrang; $i ++):    ?>
                        <?php
                            if(isset($_GET['page'])){
                                $p = $_GET['page'];
                            }else{
                                $p = 1;
                            }
                        ?>
                        <li class="<?php echo ($i == $p) ? 'active' : '' ?>">
                            <a href="?page=<?php echo $i ;?>"><?php echo $i; ?></a>
                        </li>
                        
                    <?php endfor?>
                    <li >
                        <a href="" aria-label="Next"><span aria-hidden="true">&raquo;;</span></a>
                    </li>
                </ul>
            </nav>
                </div>
        </div>
    </div>
</div>
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>