<?php include "inc/header.php"; ?>
<?php
$login = session::get("cmrlogin");
if ($login == FALSE) {
    header("Location:login.php");
}
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $cmrid = session::get("cmrid");
    $insertorder = $ct->orderProduct($cmrid);
    $delCartData = $ct->delCustomerCart();
    header("Location:success.php");
}
?>
<style>
    .division{width: 50%; float: left;}
    .tblone{width: 500px; margin: 0 auto; border: 2px solid #DDD;}
    .tblone tr td {text-align: justify}

    .tbltwo{float:right;text-align:left;width: 60%;border: 2px solid #DDD; margin-right: 14px;margin-top: 12px;}
    .tbltwo tr td {text-align: justify; padding: 5px 10px;}
    .ordernow{padding-bottom: 30px;}
    .ordernow a{width: 200px; margin: 20px auto 0;text-align: center; padding: 5px; font-size: 30px;display: block; background:#FF0000; color: #FFF;border-radius: 3px;}
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="division">
                <table class="tblone">
                    <tr>
                        <th>NO</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
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
                                <td>$<?php echo $result['price']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td>$<?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $total;
                                    ?>
                                </td>
                            </tr>   
                            <?php
                            $sum = $sum + $total;
                            $qty = $qty + $result['quantity'];
                            ?>
                            <?php
                        }
                    }
                    ?>
                </table>

                <table class="tbltwo">
                    <tr>
                        <td>Total product</td>
                        <td>:</td>
                        <td><?php echo $qty; ?></td>
                    </tr>
                    <tr>
                        <td>Sub Total </td>
                        <td>:</td>
                        <td>$<?php echo $sum; ?></td>
                    </tr>
                    <tr>
                        <td>VAT </td>
                        <td>:</td>
                        <td>10% ($<?php echo $vat = $sum * 0.1; ?>)</td>
                    </tr>
                    <tr>
                        <th>Grand Total </th>
                        <td>:</td>
                        <td>
                            <?php
                            $vat = $sum * 0.1;
                            $gtotal = $sum + $vat;
                            echo $gtotal;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>


            <div class="division">
                <?php
                $id = session::get("cmrid");
                $getdata = $cmr->getCustomerData($id);
                if ($getdata) {
                    while ($result = $getdata->fetch_assoc()) {
                        ?>
                        <table class="tblone">
                            <tr>
                                <td colspan="3"><h2>Your profile details</h2></td>
                            </tr>
                            <tr>
                                <td width = 25%>Name</td>
                                <td width = 5%>:</td>
                                <td><?php echo $result['name']; ?></td>
                            </tr>
                            <tr>
                                <td>phone</td>
                                <td>:</td>
                                <td><?php echo $result['phone']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $result['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><?php echo $result['address']; ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td><?php echo $result['city']; ?></td>
                            </tr>
                            <tr>
                                <td>Zip-code</td>
                                <td>:</td>
                                <td><?php echo $result['zip']; ?></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td><?php echo $result['country']; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><a href="editprofile.php">Update Details</a></td>
                            </tr>

                        </table>
                        <?php
                    }
                }
                ?>

            </div>

        </div>

    </div>
    <div class="ordernow">
        <a href="?orderid=order">Order</a>
    </div>
</div>
<?php include "inc/footer.php"; ?>


