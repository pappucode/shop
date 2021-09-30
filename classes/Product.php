<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . "/../lib/Database.php");
include_once ($filepath . "/../helpers/Format.php");

//include_once '../lib/Database.php';
//include_once '../helpers/Format.php';
?>
<?php

class Product {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function productInsert($data, $file) {
        $productname = $this->fm->validation($data['productname']);
        $catid = $this->fm->validation($data['catid']);
        $brandid = $this->fm->validation($data['brandid']);
        $body = $this->fm->validation($data['body']);
        $price = $this->fm->validation($data['price']);
        $type = $this->fm->validation($data['type']);
        $userid = $this->fm->validation($data['userid']);

        $productname = mysqli_real_escape_string($this->db->link, $productname);
        $catid = mysqli_real_escape_string($this->db->link, $catid);
        $brandid = mysqli_real_escape_string($this->db->link, $brandid);
        $body = mysqli_real_escape_string($this->db->link, $body);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $type = mysqli_real_escape_string($this->db->link, $type);
        $userid = mysqli_real_escape_string($this->db->link, $userid);

        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $filename = $file['image']['name'];
        $filesize = $file['image']['size'];
        $filetemp = $file['image']['tmp_name'];

        $div = explode('.', $filename);
        $fileext = strtolower(end($div));
        $uniqueimage = substr(md5(time()), 0, 10) . '.' . $fileext;
        $uploaded_image = "uploads/" . $uniqueimage;
        if ($productname == "" || $catid == "" || $brandid == "" || $body == "" || $price == "" || $filename == "" || $type == "") {
            $msg = "<span class='error'>Fields must not be empty !!</span>";
            return $msg;
        } elseif ($filesize > 1048567) {
            $msg = "<span class='error'>Image size should be less then 1 MB!!</span>";
            return $msg;
        } elseif (in_array($fileext, $permitted) === FALSE) {
            $msg = "<span class='error'>You Can upload only:-" . implode(', ', $permitted) . "!!</span>";
            return $msg;
        } else {
            move_uploaded_file($filetemp, $uploaded_image);
            $query = "insert into tbl_product(productname,catid,brandid,body,price,image,type,userid)values"
                    . "('$productname','$catid','$brandid','$body','$price','$uploaded_image','$type','$userid')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span class='success'>Product inserted successfully!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Not Inserted !!</span>";
                return $msg;
            }
        }
    }

    public function getAllProduct() {

        $query = "select p.*,c.catname,b.brandname
            from tbl_product as p, tbl_category as c, tbl_brand as b
            where p.catid = c.catid and p.brandid = b. brandid
            order by p.productid desc";

//        $query = "select tbl_product.*,tbl_category.catname,tbl_brand.brandname
//            from tbl_product
//            inner join tbl_category on tbl_product.catid = tbl_category.catid
//            inner join tbl_brand on tbl_product.brandid = tbl_brand.brandid order by productid desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getProductById($id) {
        $query = "select * from tbl_product where productid = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function productUpdate($data, $file, $id) {
        $productname = $this->fm->validation($data['productname']);
        $catid = $this->fm->validation($data['catid']);
        $brandid = $this->fm->validation($data['brandid']);
        $body = $this->fm->validation($data['body']);
        $price = $this->fm->validation($data['price']);
        $type = $this->fm->validation($data['type']);
        $userid = $this->fm->validation($data['userid']);

        $productname = mysqli_real_escape_string($this->db->link, $productname);
        $catid = mysqli_real_escape_string($this->db->link, $catid);
        $brandid = mysqli_real_escape_string($this->db->link, $brandid);
        $body = mysqli_real_escape_string($this->db->link, $body);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $type = mysqli_real_escape_string($this->db->link, $type);
        $userid = mysqli_real_escape_string($this->db->link, $userid);

        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $filename = $file['image']['name'];
        $filesize = $file['image']['size'];
        $filetemp = $file['image']['tmp_name'];

        $div = explode('.', $filename);
        $fileext = strtolower(end($div));
        $uniqueimage = substr(md5(time()), 0, 10) . '.' . $fileext;
        $uploaded_image = "uploads/" . $uniqueimage;
        if ($productname == "" || $catid == "" || $brandid == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<span class='error'>Fields must not be empty !!</span>";
            return $msg;
        } else {
            if (!empty($filename)) {
                if ($filesize > 1048567) {
                    $msg = "<span class='error'>Image size should be less then 1 MB!!</span>";
                    return $msg;
                } elseif (in_array($fileext, $permitted) === FALSE) {
                    $msg = "<span class='error'>You Can upload only:-" . implode(', ', $permitted) . "!!</span>";
                    return $msg;
                } else {
                    move_uploaded_file($filetemp, $uploaded_image);

                    $query = "update tbl_product set
                            productname = '$productname',
                            catid = '$catid',
                            brandid = '$brandid',
                            body = '$body',
                            price = '$price',
                            image = '$uploaded_image',
                            type = '$type',
                            userid = '$userid' where productid=$id";
                    $result = $this->db->update($query);
                    if ($result) {
                        $msg = "<span class='success'>Product Updated successfully!!</span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Product Not Updated !!</span>";
                        return $msg;
                    }
                }
            } else {
                $query = "update tbl_product set
                            productname = '$productname',
                            catid = '$catid',
                            brandid = '$brandid',
                            body = '$body',
                            price = '$price',
                            type = '$type',
                            userid = '$userid' where productid=$id";
                $result = $this->db->update($query);
                if ($result) {
                    $msg = "<span class='success'>Product Updated successfully!!</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Product Not Updated !!</span>";
                    return $msg;
                }
            }
        }
    }

    public function delProById($id) {

        $query = "select * from tbl_product where productid = '$id'";
        $result = $this->db->select($query);
        if ($result) {
            while ($getimg = $result->fetch_assoc()) {
                $dellink = $getimg['image'];
                unlink($dellink);
            }
        }

        $delquery = "delete from tbl_product where productid = '$id'";
        $result = $this->db->delete($delquery);
        if ($result) {
            $msg = "<span class='success'>Product Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Product Not Deleted Successfully.</span>";
            return $msg;
        }
    }

    public function getFeatureProduct() {
        $query = "select * from tbl_product where type = '0' order by productid desc limit 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getNewProduct() {
        $query = "select * from tbl_product order by productid desc limit 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSingleProduct($id) {
//        $query = "select p.*,c.catname,b.brandname
//            from tbl_product as p, tbl_category as c, tbl_brand as b
//            where p.catid = c.catid and p.brandid = b. brandid
//            order by p.productid desc";

        $query = "select p.*,c.catname,b.brandname
               from tbl_product as p, tbl_category as c, tbl_brand as b
               where p.catid = c.catid and p.brandid = b.brandid and p.productid = '$id'
                   order by p.productid desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromIphone() {
        $query = "select * from tbl_product where brandid = '1' order by productid desc limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromSamsung() {
        $query = "select * from tbl_product where brandid = '2' order by productid desc limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromAcer() {
        $query = "select * from tbl_product where brandid = '3' order by productid desc limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromCanon() {
        $query = "select * from tbl_product where brandid = '4' order by productid desc limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function productByCat($id) {
        $catid = $price = mysqli_real_escape_string($this->db->link, $id);
        $query = "select * from tbl_product where catid = '$catid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompareData($productid, $cmrid) {
        $cmrid = mysqli_real_escape_string($this->db->link, $cmrid);
        $productid = mysqli_real_escape_string($this->db->link, $productid);

        $comquery = "select * from tbl_compare where cmrid = '$cmrid' and productid = '$productid'";
        $check = $this->db->select($comquery);
        if ($check) {
            $msg = "<span class='error'>Already Added !!</span>";
            return $msg;
        }

        $query = "select * from tbl_product where productid = '$productid'";
        $result = $this->db->select($query)->fetch_assoc();
        if ($result) {
            $productid = $result['productid'];
            $productname = $result['productname'];
            $price = $result['price'];
            $image = $result['image'];

            $query = "insert into tbl_compare(cmrid,productid,productname,price,image)values('$cmrid','$productid','$productname','$price','$image')";
            $insert = $this->db->insert($query);
            if ($insert) {
                $msg = "<span class='success'>Added ! Check Compare Page.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Not Added!!</span>";
                return $msg;
            }
        }
    }

    public function getCompareData($cmrid) {
        $query = "select * from tbl_compare where cmrid = '$cmrid' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function delCompareData($cmrid) {
        $query = "delete from tbl_compare where cmrid = '$cmrid'";
        $result = $this->db->delete($query);
    }

    public function saveWishListData($id, $cmrid) {
        $cmrid = mysqli_real_escape_string($this->db->link, $cmrid);
        $productid = mysqli_real_escape_string($this->db->link, $id);

        $comquery = "select * from tbl_wlist where cmrid = '$cmrid' and productid = '$id'";
        $check = $this->db->select($comquery);
        if ($check) {
            $msg = "<span class='error'>Already Added !!</span>";
            return $msg;
        }

        $pquery = "select * from tbl_product where productid = '$id'";
        $result = $this->db->select($pquery)->fetch_assoc();
        if ($result) {
            $productid = $result['productid'];
            $productname = $result['productname'];
            $price = $result['price'];
            $image = $result['image'];

            $query = "insert into tbl_wlist(cmrid,productid,productname,price,image)values('$cmrid','$productid','$productname','$price','$image')";
            $insert = $this->db->insert($query);
            if ($insert) {
                $msg = "<span class='success'>Added ! Check WlishList Page.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Not Added!!</span>";
                return $msg;
            }
        }
    }
    public function getwishlistData($cmrid){
        $query = "select * from tbl_wlist where cmrid = '$cmrid' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function delWishListData($cmrid, $productid){
         $query = "delete from tbl_wlist where cmrid = '$cmrid' and productid = '$productid'";
        $result = $this->db->delete($query);
    }
    public function getSearchProduct($search){
        $query = "SELECT * FROM tbl_product WHERE productname LIKE '%$search%' OR body LIKE '%$search%'";
        $result = $this->db->select($query);
        return $result;
    }
    
     public function dailyReport() {
        $date = date('Y-m-d');
        $query = "select * from tbl_order where `date` like '%".$date."%'"
                . "and status=2";
        $result = $this->db->select($query);
        return $result;
    }
    public function monthyReport($from, $to){
       $query = "select * from tbl_order where `date` between '$from' and '$to'"
                . "and status=2";
        $result = $this->db->select($query);
        return $result; 
    }

}
