<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
$adminid = Session::get('adminid');
$adminrole = Session::get('adminrole');
$cat = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminname = $_POST['adminname'];
    $adminuser = $_POST['adminuser'];
    $adminemail = $_POST['adminemail'];
    $details = $_POST['details'];

    $updateuser = $cat->userUpdate($adminname, $adminuser, $adminemail, $details, $adminid);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User Profile</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($updateuser)) {
                echo $updateuser;
            }
            ?>
            <?php
            $getuser = $cat->getuserById($adminid, $adminrole);
            if ($getuser) {
                while ($result = $getuser->fetch_assoc()) {
                    ?>
                    <form action="" method="POST">
                        <table class="form">					
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="adminname" value="<?php echo $result['adminname']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Username</label>
                                </td>
                                <td>
                                    <input type="text" name="adminuser" value="<?php echo $result['adminuser']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="adminemail" value="<?php echo $result['adminemail']; ?>" class="medium" />
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

