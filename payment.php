<?php include "inc/header.php"; ?>
<?php

$login = session::get("cmrlogin");
if ($login == FALSE) {
    header("Location:login.php");
}
?>
<style>
    .payment{width: 500px;min-height: 200px;text-align: center;border: 1px solid #DDD;margin: 0 auto;padding: 50px;}
    .payment h2{border-bottom: 1px solid #DDD; margin-bottom: 60px; padding-bottom: 10px;}
    .payment a{background: #FF0000 none repeat scroll 0 0; border-radius: 3px; color: #FFF;font-size: 25px;padding: 5px 30px;}
    .back a{width: 160px;margin: 5px auto 0; padding: 7px 0; text-align: center;display: block;background: #555;border:1px solid #333;color: #FFF;border-radius: 3px;font-size: 25px;}

</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="payment">
                <h2>Choose Payment Option</h2>
                <a href="paymentoffline.php">Offline Payment</a>
                <a href="paymentonline.php">Online Payment</a>
            </div>
            <div class="back">
                <a href="cart.php">Previous</a>
            </div>

        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>


