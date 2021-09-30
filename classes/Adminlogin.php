
<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . "/../lib/Session.php");
//include '../lib/Session.php';
Session::checkLogin();
include_once ($filepath . "/../lib/Database.php");
include_once ($filepath . "/../helpers/Format.php");

//include_once '../lib/Database.php';
//include_once '../helpers/Format.php';
?>

<?php

class Adminlogin {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function adminLogin($adminuser, $adminpass) {
        $adminuser = $this->fm->validation($adminuser);
        $adminpass = $this->fm->validation($adminpass);

        $adminuser = mysqli_real_escape_string($this->db->link, $adminuser);
        $adminpass = mysqli_real_escape_string($this->db->link, $adminpass);

        if (empty($adminuser) || empty($adminpass)) {
            $loginmsg = "Username or Password must not be empty !!";
            return $loginmsg;
        } else {
            $query = "select * from tbl_admin where adminuser = '$adminuser' and adminpass = '$adminpass'";
            $result = $this->db->select($query);
            if ($result != FALSE) {
                $value = $result->fetch_assoc();
                Session::set("adminlogin", true);
                Session::set("adminid", $value['adminid']);
                Session::set("adminname", $value['adminname']);
                Session::set("adminuser", $value['adminuser']);
                Session::set("adminrole", $value['role']);
                header("Location:dashboard.php");
            } else {
                $loginmsg = "Username or Password not Match !!";
                return $loginmsg;
            }
        }
    }

        public function userInsert($username, $password, $role) {
        $username = $this->fm->validation($username);
        $password = $this->fm->validation(md5($password));
        $role = $this->fm->validation($role);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $role = mysqli_real_escape_string($this->db->link, $role);

        if (empty($username) || empty($password) || empty($role)) {
            $msg = "<span class='error'> Field must not be empty !!</span>";
            return $msg;
        } else {
            $query = "insert into tbl_admin (adminuser, adminpass, role) values ('$username','$password','$role')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span class='success'>User created Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>User Not Created!</span>";
                return $msg;
            }
        }
    }

    public function resetEmail($adminemail) {
        $adminemail = $this->fm->validation($adminemail);

        $adminemail = mysqli_real_escape_string($this->db->link, $adminemail);
        if (!filter_var($adminemail, FILTER_VALIDATE_EMAIL)) {
            $loginmsg = "Invalid Email Address!!";
            return $loginmsg;
        } else {
            $mailquery = "select * from tbl_admin where adminemail = '$adminemail' limit 1";
            $mailcheck = $this->db->select($mailquery);

            if ($mailcheck != FALSE) {
                while ($value = $mailcheck->fetch_assoc()) {
                    $adminid = $value['adminid'];
                    $adminuser = $value['adminuser'];
                }
                $text = substr($adminemail, 0, 3);
                $rand = rand(10000, 99999);
                $newpass = "$text$rand";
                $password = md5($newpass);

                $updatequery = "update tbl_admin  
                     set
                     adminpass = '$password'
                     where adminid = '$adminid'";
                $result = $this->db->update($updatequery);

                $to = "$adminemail";
                $from = "pappuakondo5354@gmail.com";
                $headers = "From: $from\n";
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $subject = "Your Paeeword";
                $message = "Your username is " . $adminuser . " and Password is " . $newpass . " Please Visit site for login.";

                $sendmail = mail($to, $subject, $message, $headers);
                if ($sendmail) {
                    $loginmsg = "<span style = 'color:green'>Please check your Email for new password</span>";
                    return $loginmsg;
                } else {
                    $loginmsg = "Email Not Send !!";
                    return $loginmsg;
                }
            } else {
                $loginmsg = "Email Not Exist !!";
                return $loginmsg;
            }
        }
    }

}
