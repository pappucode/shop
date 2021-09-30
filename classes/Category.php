<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . "/../lib/Database.php");
include_once ($filepath . "/../helpers/Format.php");

//include_once '../lib/Database.php';
//include_once '../helpers/Format.php';
?>
<?php

class Category {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catname) {
        $catname = $this->fm->validation($catname);

        $catname = mysqli_real_escape_string($this->db->link, $catname);
        if (empty($catname)) {
            $msg = "<span class='error'>Category field must not be empty !!</span>";
            return $msg;
        } else {
            $query = "insert into tbl_category (catname) values ('$catname')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span class='success'>Category Inserted Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Inserted!</span>";
                return $msg;
            }
        }
    }

    public function getAllCat() {
        $query = "select * from tbl_category order by catid desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCatById($id) {
        $query = "select * from tbl_category where catid = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function catUpdate($catname, $id) {
        $catname = $this->fm->validation($catname);
        $catname = mysqli_real_escape_string($this->db->link, $catname);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($catname)) {
            $msg = "<span class='error'>Category field must not be empty !!</span>";
            return $msg;
        } else {
            $query = "update tbl_category  
                     set
                     catname = '$catname'
                     where catid = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "<span class='success'>Category Updated Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Updated!</span>";
                return $msg;
            }
        }
    }

    public function delCatById($id) {
        $query = "delete from tbl_category where catid = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span class='success'>Category Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Category Not Deleted Successfully.</span>";
            return $msg;
        }
    }

    public function userInsert($username, $email, $password, $role) {
        $username = $this->fm->validation($username);
        $email = $this->fm->validation($email);
        $password = $this->fm->validation(md5($password));
        $role = $this->fm->validation($role);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $role = mysqli_real_escape_string($this->db->link, $role);

        if (empty($username) || empty($email) || empty($password) || empty($role)) {
            $msg = "<span class='error'> Field must not be empty !!</span>";
            return $msg;
        } else {
            $mailquery = "select * from tbl_admin where adminemail = '$email' limit 1";
            $mailcheck = $this->db->select($mailquery);
            if ($mailcheck != FALSE) {
                $msg = "<span class='error'>Email Already Exist!</span>";
                return $msg;
            } else {
                $query = "insert into tbl_admin (adminuser, adminemail, adminpass, role) values ('$username','$email','$password','$role')";
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
    }

    public function getuserById($adminid, $adminrole) {
        $query = "select * from tbl_admin where adminid = '$adminid' and role = '$adminrole'";
        $result = $this->db->select($query);
        return $result;
    }

    public function userUpdate($adminname, $adminuser, $adminemail, $details, $adminid) {
        $adminname = $this->fm->validation($adminname);
        $adminuser = $this->fm->validation($adminuser);
        $adminemail = $this->fm->validation($adminemail);
        $details = $this->fm->validation($details);

        $adminname = mysqli_real_escape_string($this->db->link, $adminname);
        $adminuser = mysqli_real_escape_string($this->db->link, $adminuser);
        $adminemail = mysqli_real_escape_string($this->db->link, $adminemail);
        $details = mysqli_real_escape_string($this->db->link, $details);
        $adminid = mysqli_real_escape_string($this->db->link, $adminid);

        if (empty($adminname) || empty($adminuser) || empty($adminemail) || empty($details)) {
            $msg = "<span class='error'>Field must not be empty !!</span>";
            return $msg;
        } else {
            $query = "update tbl_admin  
                     set
                     adminname = '$adminname',
                     adminuser = '$adminuser',
                     adminemail = '$adminemail',
                     details = '$details'
                     where adminid = '$adminid'";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "<span class='success'>User Data Updated Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>User Data Not Updated!</span>";
                return $msg;
            }
        }
    }

    public function getAllUser() {
        $query = "select * from tbl_admin order by adminid desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function delUserById($adminid) {
        $query = "delete from tbl_admin where adminid = '$adminid'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span class='success'>User Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>User Not Deleted Successfully.</span>";
            return $msg;
        }
    }

    public function viewUserById($adminid) {
        $query = "select * from tbl_admin where adminid = '$adminid'";
        $result = $this->db->select($query);
        return $result;
    }

}
