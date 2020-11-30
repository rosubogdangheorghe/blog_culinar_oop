<?php 

class Login_user{

    public $username = "";
    public $email = "";
    public $errors = [];
    public $password;
    public $result;
    

    public function login() {

    $this->username = esc($_POST['username']);
    $this->password = esc($_POST['parola']);
    if(empty($this->username)) {array_push($this->errors,"Username Obligatoriu");}
    if(empty($this->password)) {array_push($this->errors,"Parola Obligatorie");}

    if(empty($this->errors)) {
        $this->password = md5($this->password);
        $sql = "SELECT * FROM utilizatori WHERE username = '$this->username' and parola = '$this->password' LIMIT 1";
        $database = new Database();
        $this->result = mysqli_query($database->getConnection(),$sql);

        if(mysqli_num_rows($this->result)>0) {
            $reg_user_id = mysqli_fetch_assoc($this->result)['id'];

            $_SESSION['user'] = getUserById($reg_user_id);
            
            
            //user admin redirect to admin

            if(in_array($_SESSION['user']['rol'],["Admin","Author"])){
                $_SESSION['message'] =  "Esti logat";
                // echo "ramura de admin";
                header('location:' . BASE_URL . 'admin/dashboard.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Esti logat";
            //redirect to public area
                header('location:index.php');
                // echo "ramura de public";
                exit(0);
            }

        } else {
            array_push($this->errors,"Date incorecte");
        }

    }


    }

}