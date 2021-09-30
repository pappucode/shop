<?php include '../classes/Adminlogin.php'; ?>
<?php
$al = new Adminlogin;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminemail = $_POST['adminemail'];
    
    $resetemail = $al->resetEmail($adminemail);
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Password Recovery </title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
    <style>

/*        #content form { margin: 0 20px; position: relative }
        #content form input[type="email"]{
            border-radius: 3px;
            box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
            transition: all 0.5s ease;
            background: #eae7e7 ;
            border: 1px solid #c8c8c8;
            color: #777;
            font: 20px Helvetica, Arial, sans-serif;
            margin: 0 0 10px;
            padding: 15px 10px 15px 40px;
            width: 80%;
        }

        #content form input[type="email"]:focus {
            box-shadow: 0 0 2px #ed1c24 inset;
            background-color: #fff;
            border: 1px solid #ed1c24;
            outline: none;

        }*/

    </style>
</head>
<body>
    <div class="container">
        <section id="content">
            <form action="" method="post">
                <h1>Password Recovery</h1>
                <span style="color:red;font-size: 18px;">
                    <?php
                    if (isset($resetemail)) {
                        echo $resetemail;
                    }
                    ?>
                </span>
                <div>
                    <input type="text" placeholder="Enter valid Email" name="adminemail" required/>
                </div>
                <div>
                    <input type="submit" value="Send Mail" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="login.php"> Login </a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>
</html>