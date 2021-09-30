<?php include "inc/header.php"; ?>
<?php
$login = session::get("cmrlogin");
if ($login == FALSE) {
    header("Location:login.php");
}
?>
<?php
if (isset($_GET['cmrid'])) {
    $id = $_GET['cmrid'];
    $date = $_GET['date'];
    $price = $_GET['price'];
    $confirm = $ct->productShiftConfirm($id, $date, $price);
}
?>
<style>
    .tblone tr td{text-align: justify;}
</style>
<div class="main">
    <div class="content">
        <div class="section group">		
            <div class="order">
                <h2>Your Ordered details</h2>
                <table class="tblone">
                    <tr>
                        <th>NO</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $cmrid = session::get("cmrid");
                    $getorder = $ct->getOrderProduct($cmrid);
                    if ($getorder) {
                        $i = 0;
                        while ($result = $getorder->fetch_assoc()) {
                            $i++;
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productname']; ?></td>
                                <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td>$<?php echo $result['price']; ?></td>
                                <td><?php echo $fm->formatDate($result['date']); ?></td>
                                <td>
                                    <?php
                                    if ($result['status'] == '0') {
                                        echo 'Pending';
                                    } elseif ($result['status'] == '1') {
                                        echo 'Shifted';
                                    } else {
                                        echo 'OK';
                                    }
                                    ?>
                                </td>
                                <?php
                                if ($result['status'] == '0') {
                                    ?>
                                <td>N/A</td>                                  
                                    <?php
                                } elseif ($result['status'] == '1') {
                                    ?>
                                 <td><a href="?cmrid=<?php echo $cmrid; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date']; ?>">Confirm</a></td>
                                <?php } else {
                                    ?>
<!--                                    <td>OK</td>-->
                                 <td>Confirmed</td>
                                    
                                <?php } ?>

                            </tr> 
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>

        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php include "inc/footer.php"; ?>