<?php include "inc/header.php"; ?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location = '404.php';</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['catid']);
}
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Latest from Iphone</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $productbycat = $pd->productByCat($id);
            if ($productbycat) {
                while ($result = $productbycat->fetch_assoc()) {
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?proid=<?php echo $result['productid']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
                        <h2><?php echo $result['productname']; ?></h2>
                        <p><?php echo $fm->textShorten($result['body'], 50); ?></p>
                        <p><span class="price">$<?php echo $result['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?proid=<?php echo $result['productid']; ?>" class="details">Details</a></span></div>
                    </div>
                    <?php
                }
            } else {
                echo "This type of Category is Not Available";
            }
            ?>
        </div>



    </div>
</div>
<?php include "inc/footer.php"; ?>