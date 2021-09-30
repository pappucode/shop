<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php
if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    echo "<script>window.location = 'brandlist.php';</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['brandid']);
}
$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandname = $_POST['brandname'];

    $updatebrand = $brand->brandUpdate($brandname, $id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Brand</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($updatebrand)) {
                echo $updatebrand;
            }
            ?>
            <?php
            $getbrand = $brand->getBrandById($id);
            if ($getbrand) {
                while ($result = $getbrand->fetch_assoc()) {
                    ?>
                    <form action="" method="POST">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" name="brandname" value="<?php echo $result['brandname']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>