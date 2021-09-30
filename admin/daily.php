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
                        <th>Quantity</th>
                        <th>Price</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getproduct = $pd->dailyReport();
                    if ($getproduct) {
                        $i = 0; $total=0;
                        while ($result = $getproduct->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productname']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td>$<?php echo $result['price']; ?></td>
                            </tr>
                            <?php
                            $total += $result['price'];
                        }
                    }
                    ?>
                </tbody>
               
            </table>
            <div class="alert alert-info"><h4>Total Sell = <?php echo $total ?>$</h4></div>
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
