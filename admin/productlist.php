<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php // include_once  '../helpers/Format.php'; ?>
<?php
$pd = new Product();
$fm = new Format();
?>
<?php
if (isset($_GET['delpro'])) {
    $id = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['delpro']);
    $delpro = $pd->delProById($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block"> 
            <?php
            if (isset($delpro)) {
                echo $delpro;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Category name</th>
                        <th>Brand Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getproduct = $pd->getAllProduct();
                    if ($getproduct) {
                        $i = 0;
                        while ($result = $getproduct->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productname']; ?></td>
                                <td><?php echo $result['catname']; ?></td>
                                <td><?php echo $result['brandname']; ?></td>
                                <td><?php echo $fm->textShorten($result['body'], 50); ?></td>
                                <td>$<?php echo $result['price']; ?></td>
                                <td><img src="<?php echo $result['image']; ?>" height="40px" width="50px"/></td>
                                <td>
                                    <?php
                                    if ($result['type'] == 0) {
                                        echo "Featured";
                                    } else {
                                        echo "General";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="productview.php?viewproid=<?php echo $result['productid']; ?>">View</a>
                                    <?php
                                    if(Session::get('adminid') == $result['userid'] || Session::get('adminrole') == '0'){
                                    ?>
                                    ||
                                    <a href="productedit.php?proid=<?php echo $result['productid']; ?>">Edit</a>
                                    || 

                                    <a onclick="return confirm('Are you sure to delete!!')" href="?delpro=<?php echo $result['productid']; ?>">Delete</a>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>
