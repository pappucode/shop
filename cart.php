<?php include "inc/header.php"; ?>
<?php
if (isset($_GET['delpro'])) {
    $delid = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['delpro']);
    $delproduct = $ct->delProductByCart($delid);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartid = $_POST['cartid'];
    $quantity = $_POST['quantity'];
    if ($quantity <= 0) {
        $delproduct = $ct->delProductByCart($cartid);
    }
    $updatecart = $ct->updateCartQuantiyty($cartid, $quantity);
}
?>
<?php
if (!isset($_GET['id'])) {
   echo "<meta http-equiv='refresh' content='0;url=?id=pappu'>";
}
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <?php
            if (isset($updatecart)) {
                echo $updatecart;
            }
            ?>
            <?php
            if (isset($delproduct)) {
                echo $delproduct;
            }
            ?>
            <div class="cartpage">
                <h2>Your Cart</h2>

                <table class="tblone">
                    <tr>
                        <th width="5%">SL NO</th>
                        <th width="20%">Product Name</th>
                        <th width="15%">Image</th>
                        <th width="10%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="15%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                    $getpro = $ct->getCartProduct();
                    if ($getpro) {
                        $i = 0;
                        $sum = 0;
                        $qty = 0;
                        while ($result = $getpro->fetch_assoc()) {
                            $i++;
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productname']; ?></td>
                                <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                                <td>$<?php echo $result['price']; ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="cartid" value="<?php echo $result['cartid']; ?>"/>
                                        <input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
                                        <input type="submit" name="submit" value="Update"/>
                                    </form>
                                </td>
                                <td>$<?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $total;
                                    ?></td>
                                <td><a onclick="return confirm('Are you sure to delete !!');" href="?delpro=<?php echo $result['cartid']; ?>">X</a></td>
                            </tr>   
                            <?php
                            $sum = $sum + $total;
                            $qty = $qty + $result['quantity'];
                            session::set("sum", $sum);
                            session::set("qty", $qty);
                            ?>
                            <?php
                        }
                    }
                    ?>
                </table>
                <?php
                $getdata = $ct->checkCartData();
                if ($getdata) {
                    ?>
                    <table style="float:right;text-align:left;" width="40%">
                        <tr>
                            <th>Sub Total : </th>
                            <td>$<?php echo $sum; ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td>
                                <?php
                                $vat = $sum * 0.1;
                                $gtotal = $sum + $vat;
                                echo $gtotal;
                                ?>
                            </td>
                        </tr>
                    </table>
                    <?php
                } else {
                    header("Location:index.php");
//                    echo "Cart Empty !! <a href='index.php'>Please shop now</a>";
                }
                ?>

            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php include "inc/footer.php"; ?>