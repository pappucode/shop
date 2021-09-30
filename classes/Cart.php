<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . "/../lib/Database.php");
include_once ($filepath . "/../helpers/Format.php");

//include_once '../lib/Database.php';
//include_once '../helpers/Format.php';
?>
<?php

class Cart {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity, $id) {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productid = mysqli_real_escape_string($this->db->link, $id);
        $sessionid = session_id();

        $query = "select * from tbl_product where productid = '$productid'";
        $getproduct = $this->db->select($query);
        $result = $getproduct->fetch_assoc();
        $productname = $result['productname'];
        $price = $result['price'];
        $image = $result['image'];

        $chquery = "select * from tbl_cart where productid = '$productid' and sessionid = '$sessionid'";
        $getpro = $this->db->select($chquery);
        if ($getpro) {
            $msg = "Product already added !!";
            return $msg;
        } else {

            $query = "insert into tbl_cart (sessionid,productid,productname,price,quantity,image) 
                 values('$sessionid','$productid','$productname','$price','$quantity','$image')";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                header("Location:cart.php");
            } else {
                header("Location:404.php");
            }
        }
    }

    public function getCartProduct() {
        $sessionid = session_id();
        $query = "select * from tbl_cart where sessionid = '$sessionid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCartQuantiyty($cartid, $quantity) {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);

        $query = "update tbl_cart  
                     set
                     quantity = '$quantity'
                     where cartid = '$cartid'";
        $result = $this->db->update($query);
        if ($result) {
            header("Location:cart.php");
        } else {
            $msg = "<span class='error'>Quantity Not updated</span>";
            return $msg;
        }
    }

    public function delProductByCart($delid) {
        $delid = mysqli_real_escape_string($this->db->link, $delid);
        $query = "delete from tbl_cart where cartid = '$delid'";
        $result = $this->db->delete($query);
        if ($result) {
            echo "<script>window.location = 'cart.php';</script>";
        } else {
            $msg = "Product Not Deleted!!";
            return $msg;
        }
    }

    public function checkCartData() {
        $sessionid = session_id();
        $query = "select * from tbl_cart where sessionid = '$sessionid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delCustomerCart() {
        $sessionid = session_id();
        $query = "delete from tbl_cart where sessionid = '$sessionid'";
        $this->db->delete($query);
    }

    public function orderProduct($cmrid) {
        $sessionid = session_id();
        $query = "select * from tbl_cart where sessionid = '$sessionid'";
        $getpro = $this->db->select($query);
        if ($getpro) {
            while ($result = $getpro->fetch_assoc()) {
                ;
                $productid = $result['productid'];
                $productname = $result['productname'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];

                $query = "insert into tbl_order(cmrid,productid,productname,quantity,price,image)values('$cmrid','$productid','$productname','$quantity','$price','$image')";
                $insert = $this->db->insert($query);
            }
        }
    }

    public function payableAmount($cmrid) {
        $query = "select price from tbl_order where cmrid = '$cmrid' and date = now()";
        $result = $this->db->select($query);
        return $result;
    }

    public function getOrderProduct($cmrid) {
        $query = "select * from tbl_order where cmrid = '$cmrid' order by date";
        $result = $this->db->select($query);
        return $result;
    }

    public function checkOrder($cmrid) {
        $query = "select * from tbl_order where cmrid = '$cmrid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllOrderProduct() {
        $query = "select * from tbl_order order by date desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function productShifted($id, $date, $price) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "update tbl_order  
                     set
                     status = '2'
                     where cmrid = '$id' and date = '$date' and price = '$price'";
        $result = $this->db->update($query);
//        if ($result) {
//            $msg = "<span class='success'>Updated successfully !!</span>";
//            return $msg;
//        } else {
//            $msg = "<span class='error'> Not updated</span>";
//            return $msg;
//        }
    }

    public function delProductShifted($id, $date, $price) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "delete from tbl_order where cmrid = '$id' and date = '$date' and price = '$price'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span class='success'>Data Deleted successfully !!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Data Not Deleted</span>";
            return $msg;
        }
    }

    public function productShiftConfirm($id, $date, $price) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "update tbl_order  
                     set
                     status = '2'
                     where cmrid = '$id' and date = '$date' and price = '$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'>Updated successfully !!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'> Not updated</span>";
            return $msg;
        }
    }

}
