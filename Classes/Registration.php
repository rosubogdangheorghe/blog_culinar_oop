<?php

class Registration{

public $username = "";
public $email = "";
public $errors = [];
public $password_1="";
public $password_2="";



public function register() {

        $username = esc($_POST['username']);
        $email = esc($_POST['email']);
        $password_1 = esc($_POST['password_1']);
        $password_2 = esc($_POST['password_2']);



        if(empty($username)) {array_push($errors,"Username Obligatoriu");}
        if(empty($email)) {array_push($errors,"Email Obligatoriu");}
        if(empty($password_1)) {array_push($errors,"Parola?");}
        if(empty($password_2)) {array_push($errors,"Cele 2 parole nu se potrivesc?");}
        $user_check_query = "SELECT * FROM utilizatori WHERE username = '$username' OR email = '$email' LIMIT 1";
        $database = new Database();
        $result = mysqli_query($database->getConnection(),$user_check_query);
        $user = mysqli_fetch_assoc($result);
        if($user) {
            if($user['username'] == $username) {
                array_push($errors, "Username existent");
            }
            if($user['email'] == $email) {
                array_push($errors, "Email existent");

            }
        }  
        //inregistrate utilizator daca nu sunt erori

        if(count($errors) == 0) {
                $password = md5($password_1);
                $query = "INSERT INTO utilizatori (username,email,parola,created_at,updated_at)
                VALUES ('$username','$email','$password',now(),now())";
                $database = new Database();
                mysqli_query($database->getConnection(),$query);
                $_SESSION['message'] = "Utilizator admin creat cu succes";

                $reg_user_id = mysqli_insert_id($database->getConnection());
               
                $_SESSION['user'] = getUserById($reg_user_id);

                if(in_array($_SESSION['user']['rol'],["Admin","Author"])){
                    $_SESSION['message'] =  "Esti logat";
                    //redirect catre admin area
                    header('location:'. BASE_URL . 'admin/dashboard.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Esti logat";
                    //redirect to public area
                    header('location:index.php');
                    exit(0);
                }

        }


}


}

?>