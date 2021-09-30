<?php include "inc/header.php"; ?>
<?php
$login = session::get("cmrlogin");
if ($login == FALSE) {
    header("Location:login.php");
}
?>
<style>
    .psuccesst{width: 500px;min-height: 200px;text-align: center;border: 1px solid #DDD;margin: 0 auto;padding: 20px;}
    .psuccesst h2{border-bottom: 1px solid #DDD; margin-bottom: 20px; padding-bottom: 10px;}
    .psuccesst p{line-height: 25px;font-size: 18px;text-align: left;}

</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="psuccesst">
                <h2>Success</h2>
                <?php
                $cmrid = session::get("cmrid");
                $amount = $ct->payableAmount($cmrid);
                if ($amount) {
                    $sum = 0;
                    while ($result = $amount->fetch_assoc()) {
                        $price = $result['price'];
                        $sum = $sum + $price;
                    }
                }
                ?>
                <P style="color:red">Total Payable Amount (Including Vat) :$
                    <?php
                    $vat = $sum * 0.1;
                    $total = $vat + $sum;
                    echo $total;
                    ?>
                </P>
                <p>
                    Thanks for purchase. Receive your order successfully. We will contact you ASAP with delivery details.
                    Here is your delivery details....<a href="orderdetails.php"> Visit here...</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>


