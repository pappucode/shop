<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . "/../lib/Database.php");
include_once ($filepath . "/../helpers/Format.php");

//include_once '../lib/Database.php';
//include_once '../helpers/Format.php';
?>
<?php

class Customer {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegistration($data) {

        $name = $this->fm->validation($data['name']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $country = $this->fm->validation($data['country']);
        $zip = $this->fm->validation($data['zip']);
        $phone = $this->fm->validation($data['phone']);
        $email = $this->fm->validation($data['email']);
        $password = $this->fm->validation($data['password']);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, md5($password));
        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" ||
                $email == "" || $password == "") {
            $msg = "<span class='error'>Fields must not be empty !!</span>";
            return $msg;
        }
        $mailquery = "select * from tbl_customer where email = '$email' limit 1";
        $result = $this->db->select($mailquery);
        if ($result != FALSE) {
            $msg = "<span class='error'>Email Already Exist !!</span>";
            return $msg;
        } else {
            $query = "insert into tbl_customer(name,address,city,country,zip,phone,email,password)values ('$name','$address','$city','$country','$zip','$phone','$email','$password')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span class='success'>Customer data inserted successfully!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Customer data Not Inserted !!</span>";
                return $msg;
            }
        }
    }

    public function customerLogin($email, $password) {
        $email = $this->fm->validation($email);
        $password = $this->fm->validation($password);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, md5($password));
        if (empty($email) || empty($password)) {
            $msg = "<span class='error'>Field must not be empty!!</span>";
            return $msg;
        } else {
            $query = "select * from tbl_customer where email = '$email' and password = '$password'";
            $result = $this->db->select($query);
            if ($result != FALSE) {
                $value = $result->fetch_assoc();
                session::set("cmrlogin", TRUE);
                session::set("cmrid", $value['id']);
                session::set("cmrname", $value['name']);
                header("Location:cart.php");
            } else {
                $msg = "<span class='error'>Email or Password not Match!!</span>";
                return $msg;
            }
        }
    }

    public function getCustomerData($id) {
        $query = "select * from tbl_customer where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updatecmrprofile($data, $cmrid) {
        $name = $this->fm->validation($data['name']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $country = $this->fm->validation($data['country']);
        $zip = $this->fm->validation($data['zip']);
        $phone = $this->fm->validation($data['phone']);
        $email = $this->fm->validation($data['email']);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "") {
            $msg = "<span class='error'>Fields must not be empty!</span>";
            return $msg;
        } else {
            $query = "update tbl_customer  
                     set
                     name = '$name',
                     address = '$address',
                     city = '$city',
                     country = '$country',
                     zip = '$zip',
                     phone = '$phone',
                     email = '$email'
                     where id = '$cmrid'";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "<span success='success'>Customer data Updated successfully</span>";
            } else {
                $msg = "<span class='error'>Customer data Not updated</span>";
                return $msg;
            }
        }
    }

}
