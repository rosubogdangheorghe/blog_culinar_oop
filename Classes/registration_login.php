<?php

 require_once 'config.php';
$username = "";
$email = "";
$errors = [];

if(isset($_POST['reg_user'])) {

        $register = new Registration();
        $register->register();

       

}



if(isset($_POST['login_btn'])) {

    $login = new Login_user();
    $login->login();
    

    

}

function esc(String $value) {
    $database = new Database();
    $val = trim($value);
    $val = mysqli_real_escape_string($database->getConnection(),$value);
    return $val;
}
function getUserById($id) {
    $database = new Database();
    $sql = "SELECT * FROM utilizatori WHERE id = $id LIMIT 1";
    $result = mysqli_query($database->getConnection(),$sql);
    $user = mysqli_fetch_assoc($result);
    print_r($user);
    return $user;


}
?>