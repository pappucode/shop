<?php include "inc/header.php"; ?>	
<?php
if (!isset($_GET['search']) || $_GET['search'] == NULL) {
    header("Location: 404.php");
} else {
    $search = $_GET['search'];
}
?>
<?php
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Your Search Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $getspd = $pd->getSearchProduct($search);
            if ($getspd) {
                while ($result = $getspd->fetch_assoc()) {
                    ?>

                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?proid=<?php echo $result['productid']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                        <h2><?php echo $result['productname']; ?> </h2>
                        <p><?php echo $fm->textShorten($result['body'], 50); ?></p>
                        <p><span class="price">$<?php echo $result['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?proid=<?php echo $result['productid']; ?>" class="details">Details</a></span></div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <p>Your Search Query Not Found...!!</p>
            <?php } ?>
        </div>

    </div>    
</div>
<?php include "inc/footer.php"; ?>