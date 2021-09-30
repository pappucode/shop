<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
$cat = new Category();
if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
    echo "<script>window.location = 'userlist.php';</script>";
} else {
    $adminid = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['userid']);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'userlist.php';</script>";
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User Details</h2>
        <div class="block copyblock"> 

            <?php
            $viewuser = $cat->viewUserById($adminid);
            if ($viewuser) {
                while ($result = $viewuser->fetch_assoc()) {
                    ?>
                    <form action="" method="POST">
                        <table class="form">					
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['adminname']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Username</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['adminuser']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['adminemail']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="details"><?php echo $result['details']; ?></textarea>
                                </td>
                            </tr>

                            <tr> 
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="OK" />
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

