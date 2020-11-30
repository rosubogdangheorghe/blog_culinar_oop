<?php

class Topic {

   public $topic_id = 0;
   public $isEditingTopic = false;
   public $topic_name = "";
   public $topic_slug = "";
   public $errors=[];



   public function createTopic($request_values){

    $database = new Database();
    $this->topic_name = esc($request_values['topic_name']);
    $this->topic_slug = makeSlug($this->topic_name);
    if(empty($this->topic_name)) {
        array_push($errors,"Nume topic obligatoriu");
    }

    $topic_check_query = "SELECT * FROM topic WHERE slug = '$this->topic_slug' LIMIT 1";
    $result = mysqli_query($database->getConnection(),$topic_check_query);
    if (mysqli_num_rows($result)>0) {
        array_push($this->errors,"Topic existent");
    }
    if(count($errors) == 0) {
        $query = "INSERT INTO topic (nume, slug) 
        VALUES ('$this->topic_name','$this->topic_slug')";
        mysqli_query($database->getConnection(),$query);

        $_SESSION['message'] = "Topic creat cu succes";
        header('location: topics.php');
        exit(0);


    }
}
    public function editTopic($topic_id){
        $database = new Database();
        global $topic_id, $topic_name;

        $sql = "SELECT * FROM topic WHERE id=$topic_id LIMIT 1";
        $result = mysqli_query($database->getConnection(), $sql);
        $topic = mysqli_fetch_assoc($result);

        // set form values $topic_name on the form to be updated

        $topic_name = $topic['nume'];
             

    }

    public function updateTopic($request_values) {
        $database = new Database();
       
        $this->topic_name = esc($request_values['topic_name']);
        $this->topic_id = esc($request_values['topic_id']);
        $this->topic_slug = makeSlug($this->topic_name);
        if(empty($this->topic_name)) {
            array_push($this->errors,"Nume topic obligatoriu");
        }

        if(count($this->errors) == 0) {
            $query = "UPDATE topic SET nume = '$this->topic_name', slug = '$this->topic_slug' WHERE id = $this->topic_id";
            
            mysqli_query($database->getConnection(),$query);
    
            $_SESSION['message'] = "Topic actualizat cu succes";
            header('location: topics.php');
            exit(0);
        }

    }
    public function deleteTopic($topic_id) {
        $database = new Database();
        $sql = "DELETE FROM topic WHERE id = $topic_id";
        if (mysqli_query($database->getConnection(),$sql)) {
            $_SESSION['message'] = "Topic sters cu succes";
            header("location: topics.php");
            exit(0);

        }
    }
}