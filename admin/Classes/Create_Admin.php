<?php

class Create_Admin {

    private $admin_id = 0;
    private $isEditingUser = false;
    private $username="";
    private $role="";
    private $email="";
    private $errors=[];
    private $password;
    private $passwordConfirmation;

    public function createAdmin($request_values) {
        $database = new Database();
        $this->username = esc($request_values['username']);
        $this->email = esc($request_values['email']);
        $this->password = esc($request_values['parola']);
        $this->passwordConfirmation = esc($request_values['confParola']);
    
        if(isset($request_values['rol'])) {
            $this->role = esc($request_values['rol']);
        }
        //validare formular
    
        if(empty($this->username)) {array_push($this->errors,"Utilizator obligatoriu");}
        if(empty($this->email)) {array_push($this->errors,"Email obligatoriu");}
        if(empty($this->role)) {array_push($this->errors,"Rol obligatoriu pentru admin");}
        if(empty($this->password)) {array_push($this->errors,"Parola obligatorie");}
        if($this->password != $this->passwordConfirmation) {array_push($this->errors,"Cele 2 parole trebuie sa coincida");}
    
        //asigurare ca utilizatorul este unic 
    
        $user_check_query = "SELECT * FROM utilizatori WHERE username = '$this->username' OR email = '$this->email' LIMIT 1";
        $result = mysqli_query($database->getConnection(),$user_check_query);
        $user = mysqli_fetch_assoc($result);
        if($user) {
    
            if($user['username'] === $this->username) {  // daca exista utilizatorul
                array_push($this->errors,"Utilizator existent");
            }
            if($user['email'] === $this->email) {
                array_push($this->errors,"Utilizator existent");
            }
        }
    
        //inregistrare utilizator
    
        if(count($this->errors)==0) {
            $password = md5($this->password);
            $query = "INSERT INTO utilizatori (username,email,rol, parola,created_at,updated_at)
            VALUES ('$this->username','$this->email','$this->role','$this->password',now(),now())";
            mysqli_query($database->getConnection(),$query);
            $_SESSION['message'] = "Utilizator admin creat cu succes";
            header('location: users.php');
            exit(0);
    
                }
        }

        // edit
        public function editAdmin($admin_id) {
            $database = new Database();
            global $username, $admin_id, $email;
    
          $sql = "SELECT * FROM utilizatori WHERE id=$admin_id LIMIT 1";
          $result = mysqli_query($database->getConnection(), $sql);
          $admin = mysqli_fetch_assoc($result);
            //print_r($admin);
        // set form values ($username and $email) on the form to be updated
         $username = $admin['username'];
         $email = $admin['email'];
    
        }
        //update 
        public function updateAdmin($request_values){

            $database = new Database();
          
            // get id of the admin to be updated
            $this->admin_id = $request_values['admin_id'];
            // set edit state to false
            $this->isEditingUser = false;
        
        
            $this->username = esc($request_values['username']);
            $this->email = esc($request_values['email']);
            $this->password = esc($request_values['parola']);
            $this->passwordConfirmation = esc($request_values['confParola']);
            if(isset($request_values['rol'])){
                $this->role = $request_values['rol'];
            }

            if(empty($this->username)) {array_push($this->errors,"Utilizator obligatoriu");}
            if(empty($this->email)) {array_push($this->errors,"Email obligatoriu");}
            if(empty($this->role)) {array_push($this->errors,"Rol obligatoriu pentru admin");}
            if(empty($this->password)) {array_push($this->errors,"Parola obligatorie");}
            if($this->password != $this->passwordConfirmation) {array_push($this->errors,"Cele 2 parole trebuie sa coincida");}

            // register user if there are no errors in the form
            if (count($this->errors) == 0) {
                
                $password = md5($this->password);
        
                $query = "UPDATE utilizatori SET username='$this->username', email='$this->email', rol='$this->role', parola='$this->password', updated_at = now() WHERE id=$this->admin_id";
                mysqli_query($database->getConnection(), $query);
        
                $_SESSION['message'] = "Utilizator actualizat cu succes";
                header('location: users.php');
                exit(0);
            }
        }


        public function deleteAdmin($admin_id) {
            $database = new Database();
            $sql = "DELETE FROM utilizatori WHERE id=$admin_id";
            if (mysqli_query($database->getConnection(), $sql)) {
                $_SESSION['message'] = "Utilizator sters cu succes";
                header("location: users.php");
                exit(0);
            }
        }
       

        

    /**
     * Get the value of admin_id
     */ 
    public function getAdmin_id()
    {
        return $this->admin_id;
    }

    /**
     * Set the value of admin_id
     *
     * @return  self
     */ 
    public function setAdmin_id($admin_id)
    {
        $this->admin_id = $admin_id;

        return $this;
    }

    /**
     * Get the value of isEditingUser
     */ 
    public function getIsEditingUser()
    {
        return $this->isEditingUser;
    }

    /**
     * Set the value of isEditingUser
     *
     * @return  self
     */ 
    public function setIsEditingUser($isEditingUser)
    {
        $this->isEditingUser = $isEditingUser;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of errors
     */ 
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */ 
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of passwordConfirmation
     */ 
    public function getPasswordConfirmation()
    {
        return $this->passwordConfirmation;
    }

    /**
     * Set the value of passwordConfirmation
     *
     * @return  self
     */ 
    public function setPasswordConfirmation($passwordConfirmation)
    {
        $this->passwordConfirmation = $passwordConfirmation;

        return $this;
    }
}