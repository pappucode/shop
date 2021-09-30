
<?php
include 'lib/session.php';
Session::init();
include 'lib/Database.php';
include 'helpers/Format.php';
spl_autoload_register(function($class_name) {
    include_once "classes/" . $class_name . ".php";
});
$db = new Database();
$fm = new Format();
$pd = new Product();
$cat = new Category();
$ct = new Cart();
$cmr = new Customer();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script> 
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(document).ready(function ($) {
            $('#dc_mega-menu-orange').dcMegaMenu({rowItems: '4', speed: 'fast', effect: 'fade'});
        });
    </script>
</head>
<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form action="search.php" method="get">
                        <input type="text" name="search" placeholder="Search for Products" value=""/>
                        <input type="submit" name="submit" value="SEARCH">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="#" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product">
                                <?php
                                $getdata = $ct->checkCartData();
                                if ($getdata) {
                                    $sum = session::get("sum");
                                    $qty = session::get("qty");
                                    echo "$ " . $sum . "  | Qty: " . $qty;
                                } else {
                                    echo '(Empty !!)';
                                }
                                ?>
                            </span>
                        </a>
                    </div>
                </div>
                <?php
                if (isset($_GET['crmid'])) {
                    $cmrid = session::get("cmrid");
                    $delCartData = $ct->delCustomerCart();
                    $delComdata = $pd->delCompareData($cmrid);
                    session::destroy();
                }
                ?>
                <div class="login">
                    <?php
                    $login = session::get("cmrlogin");
                    if ($login == FALSE) {
                        ?>
                        <a href = "login.php">Login</a>
                    <?php } else { ?>
                        <a href = "?crmid=<?php session::get('crmid'); ?>">Logout</a>
                    <?php } ?>



                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="menu">
            <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                <li><a href="index.php">Home</a></li>
                <li><a href="topbrands.php">Top Brands</a></li>

                <?php
                $chkcart = $ct->checkCartData();
                if ($chkcart) {
                    ?>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="payment.php">Payment</a></li>
                    <?php
                }
                ?>

                <?php
                $cmrid = session::get("cmrid");
                $chkorder = $ct->checkOrder($cmrid);
                if ($chkorder) {
                    ?>
                    <li><a href="orderdetails.php">Order</a></li>
                    <?php
                }
                ?>

                <?php
                $login = session::get("cmrlogin");
                if ($login == TRUE) {
                    ?>
                    <li><a href="profile.php">Profile</a> </li>
                    <?php
                }
                ?>
                <?php
                $getpd = $pd->getCompareData($cmrid);
                if ($getpd) {
                    ?>
                    <li><a href="compare.php">Compare</a> </li> 
                    <?php
                }
                ?>
                <?php
                $getwlistpd = $pd->getwishlistData($cmrid);
                if ($getwlistpd) {
                    ?>
                    <li><a href="wishlist.php">WishList</a> </li> 
                    <?php
                }
                ?>
                <li><a href="contact.php">Contact</a> </li>
                <div class="clear"></div>
            </ul>
        </div>
