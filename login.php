<?php include "inc/header.php"; ?>
<?php
$login = session::get("cmrlogin");
if ($login == TRUE) {
    header("Location:orderdetails.php");
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cmrlogin = $cmr->customerLogin($email, $password);
}
?>
<style>
    .register_account form input[type="email"], .register_account form select {

    font-size: 12px;
    color: #444;
    padding: 8px;
    outline: none;
    margin: 5px 0;
    width: 340px;

}
    .register_account form input[type="number"], .register_account form select {

    font-size: 12px;
    color: #444;
    padding: 8px;
    outline: none;
    margin: 5px 0;
    width: 340px;

}
</style>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <?php
            if (isset($cmrlogin)) {
                echo $cmrlogin;
            }
            ?>
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>         
            <form action="" method="post">
                <input name="email" type="text" placeholder="Enter your email">
                <input name="password" type="password" placeholder="password">
                <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
            </form>
            <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>            
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            $customerreg = $cmr->customerRegistration($_POST);
        }
        ?>
        <div class="register_account">
            <?php
            if (isset($customerreg)) {
                echo $customerreg;
            }
            ?>
            <h3>Register New Account</h3>
            <form action="" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Name"  >
                                </div>

                                <div>
                                    <input type="text" name="city" placeholder="City">
                                </div>

                                <div>
                                    <input type="number" name="zip" placeholder="Zip-Code">
                                </div>
                                <div>
                                    <input type="email" name="email" placeholder="Email">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Address">
                                </div>
                                <div>
                                    <input type="text" name="country" placeholder="Country">
                                </div>		        

                                <div>
                                    <input type="number" name="phone" placeholder="Phone Number">
                                </div>

                                <div>
                                    <input type="password" name="password" placeholder="Password">
                                </div>
                            </td>
                        </tr> 
                    </tbody></table> 
                <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>

                <div class="clear"></div>
            </form>
        </div>  




        <div class="clear"></div>
    </div>
</div>
<?php include "inc/footer.php"; ?>