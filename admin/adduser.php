<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>

<?php
$cat = new Category();
if (!Session::get('adminrole') == '0') {
    echo "<script>window.location = 'dashboard.php';</script>";
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['adminuser'];
    $email = $_POST['adminemail'];
    $password = $_POST['adminpass'];
    $role = $_POST['role'];

    $insertuser = $cat->userInsert($username, $email, $password, $role);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($insertuser)) {
                echo $insertuser;
            }
            ?>
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="adminuser" placeholder="Enter username..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="email" name="adminemail" placeholder="Enter email..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="password" name="adminpass" placeholder="Enter password..." class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>User Role</label>
                        </td>
                        <td>
                            <select id="select" name="role">
                                <option>Select User Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Subadmin</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>