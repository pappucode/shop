<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo "<script>window.location = 'productlist.php';</script>";
} else {
    $id = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['proid']);
}
$pd = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateproduct = $pd->productUpdate($_POST, $_FILES, $id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <?php
        if (isset($updateproduct)) {
            echo $updateproduct;
        }
        ?>
        <div class="block">  
            <?php
            $getproduct = $pd->getProductById($id);
            if ($getproduct) {
                while ($value = $getproduct->fetch_assoc()) {
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="productname" value="<?php echo $value['productname']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="catid">
                                        <option>Select Category</option>
                                        <?php
                                        $cat = new Category();
                                        $getcat = $cat->getAllCat();
                                        if ($getcat) {
                                            while ($result = $getcat->fetch_assoc()) {
                                                ?>
                                                <option 
                                                <?php if ($value['catid'] == $result['catid']) { ?>
                                                        selected="selected"
                                                    <?php } ?>
                                                    value="<?php echo $result['catid']; ?>"><?php echo $result['catname']; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Brand</label>
                                </td>
                                <td>
                                    <select id="select" name="brandid">
                                        <option>Select Brand</option>
                                        <?php
                                        $brand = new Brand();
                                        $getbrand = $brand->getAllBrand();
                                        if ($getbrand) {
                                            while ($result = $getbrand->fetch_assoc()) {
                                                ?>
                                                <option 
                                                <?php if ($value['brandid'] == $result['brandid']) { ?>
                                                        selected="selected"
                                                    <?php } ?>
                                                    value="<?php echo $result['brandid']; ?>"><?php echo $result['brandname']; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Description</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"><?php echo $value['body']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Price</label>
                                </td>
                                <td>
                                    <input type="text" name="price" value="<?php echo $value['price']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $value['image']; ?>" height="60px" width="80px"/><br/> 
                                    <input type="file" name="image"/>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Product Type</label>
                                </td>
                                <td>
                                    <select id="select" name="type">
                                        <option>Select Type</option>
                                        <?php if ($value['type'] == 0) { ?>
                                            <option selected="selected"value="0">Featured</option>
                                            <option value="1">General</option>
                                        <?php } else { ?>
                                            <option selected="selected"value="1">General</option>
                                            <option value="0">General</option>
                                        <?php } ?>
                                    </select>                                                                      
                                </td>
                            </tr>
                            <input type="hidden" name="userid" value="<?php echo Session::get('adminid') ?>" class="medium" />
                            <tr>
                                <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>



