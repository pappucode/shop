<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
$fm = new Format();
$cat = new Category();
if (isset($_GET['deluser'])) {
    $adminid = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['deluser']);
    $deluser = $cat->delUserById($adminid);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <div class="block">   
            <?php
            if (isset($deluser)) {
                echo $deluser;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th> Name</th>
                        <th> Username</th>
                        <th> Email</th>
                        <th> Details</th>
                        <th> Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getUser = $cat->getAllUser();
                    if ($getUser) {
                        $i = 0;
                        while ($result = $getUser->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['adminname']; ?></td>
                                <td><?php echo $result['adminuser']; ?></td>
                                <td><?php echo $result['adminemail']; ?></td>
                                <td><?php echo $fm->textShorten($result['details'], 30); ?></td>
                                <td>
                                    <?php
                                    if ($result['role'] == '0') {
                                        echo "Admin";
                                    } elseif ($result['role'] == '1') {
                                        echo "Subadmin";
                                    } elseif ($result['role'] == '2') {
                                        echo "Editor";
                                    }
                                    ?>
                                </td>
                                <td><a href="viewuser.php?userid=<?php echo $result['adminid']; ?>">
                                        View</a>
                                    <?php
                                    if (Session::get('adminrole') == '0') {
                                        ?>
                                        || <a onclick = "return confirm('Are you sure to delete')" href = "?deluser=<?php echo $result['adminid']; ?>">Delete</a>
                                    <?php }
                                    ?>
                                </td>
                            </tr> 
                            <?php
                        }
                    } else {
                        echo 'User Not Found!';
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

