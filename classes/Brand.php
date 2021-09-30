<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

//include_once '../lib/Database.php';
//include_once '../helpers/Format.php';
?>
<?php

class Brand {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brandname) {
        $brandname = $this->fm->validation($brandname);

        $brandname = mysqli_real_escape_string($this->db->link, $brandname);
        if (empty($brandname)) {
            $msg = "<span class='error'>Brand field must not be empty !!</span>";
            return $msg;
        } else {
            $query = "insert into tbl_brand (brandname) values ('$brandname')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span class='success'>Brand Name Inserted Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand Name Not Inserted!</span>";
                return $msg;
            }
        }
    }

    public function getAllBrand() {
        $query = "select * from tbl_brand order by brandid desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getBrandById($id) {
        $query = "select * from tbl_brand where brandid = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function brandUpdate($brandname, $id) {
        $brandname = $this->fm->validation($brandname);
        $brandname = mysqli_real_escape_string($this->db->link, $brandname);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($brandname)) {
            $msg = "<span class='error'>Brand field must not be empty !!</span>";
            return $msg;
        } else {
            $query = "update tbl_brand  
                     set
                     brandname = '$brandname'
                     where brandid = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "<span class='success'>Brand Name Updated Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand Name Not Updated!</span>";
                return $msg;
            }
        }
    }
     public function delBrandById($id) {
        $query = "delete from tbl_brand where brandid = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span class='success'>Brand Name Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Brand Name Not Deleted Successfully.</span>";
            return $msg;
        }
    }

}
