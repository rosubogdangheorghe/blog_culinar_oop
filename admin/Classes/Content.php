<?php

class Content {

    public $post_id = 0;
    public $isEditingPost = false;
    public $published = 0;
    public $title = "";
    public $post_slug = "";
    public  $body = "";
    public  $featured_image = "";
    public $post_topic = "";
    public $errors=[];
    public $inserted_post_id;


    function createPost($request_values) {
        $database = new Database();
       // global $errors, $title, $featured_image, $topic_id, $body, $published,$user_id;
        $this->title = esc($request_values['title']);
        $this->body = htmlentities(esc($request_values['body']));
        $this->topic_id = esc($request_values['topic_id']);
        // if (isset($request_values['topic_id'])) {
        //     $topic_id = esc($request_values['topic_id']);
        // }
        if (isset($request_values['published'])) {
            $this->published = esc($request_values['published']);
        }
        $this->post_slug = makeSlug($this->title);
            // formular validare
            if (empty($this->title)) { array_push($this->errors, "Titlu postare este necesar"); }
            if (empty($this->body)) { array_push($this->errors, "Textul postarii este necesar"); }
            if (empty($this->topic_id)) { array_push($this->errors, "Topicul este necesar"); }
            
            // numele pozei
              $this->featured_image = $_FILES['featured_image']['name'];
              
              if (empty($this->featured_image)) { array_push($this->errors, "Poza este obligatorie"); }
              
              // image file directory
              $target = "../static/images/" . basename($this->featured_image);
              
              if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
                  array_push($this->errors, "Nu s-a incarcat nici o poza. verificati locatia pe server");
              }
            // Ensure that no post is saved twice. 
            $post_check_query = "SELECT * FROM postari WHERE slug='$this->post_slug' LIMIT 1";
            $result = mysqli_query($database->getConnection(), $post_check_query);
            if(mysqli_num_rows($result)>0) {
                array_push($this->errors, "O postare cu acelasi titlu exista deja.");
            }
            if(count($this->errors) == 0 ){
                $this->user_id = $_SESSION['user']['id'];
                $query = "INSERT INTO postari (user_id,title,slug,poza,body,published,created_at,updated_at)
                VALUES ('$this->user_id', '$this->title', '$this->post_slug', '$this->featured_image', '$this->body', '$this->published', now(), now())";
    
    
                mysqli_query($database->getConnection(), $query);
                 // daca postarea a fost creata
    
                $this->inserted_post_id = mysqli_insert_id($database->getConnection());
                    // creare relatie intre post si topic
                    
                    $sql = "INSERT INTO topic_postari (post_id,topic_id) VALUES('$this->inserted_post_id', '$this->topic_id')";
                    mysqli_query($database->getConnection(), $sql);
    
                    $_SESSION['message'] = "Postare creata cu succes";
                    header('location: posts.php');
                    exit(0);
                
            }
    }
    
    function editPost($role_id)
    {
        $database = new Database();
        //$conn = $database->getConnection();
        global $title, $body, $published;
        $sql = "SELECT * FROM postari WHERE id=$role_id LIMIT 1";
        $result = mysqli_query($database->getConnection(), $sql);
        $post = mysqli_fetch_assoc($result);
        // set form values on the form to be updated
        $title = $post['title'];
        $body = $post['body'];
        $published = $post['published'];
        //$poza = $post['poza'];
        //$featured_image =$_FILES['featured_image']['name'];
    }
    
        function updatePost($request_values)
        {
            $database = new Database();
            //$conn = $database->getConnection();
           // global $errors, $post_id, $title, $featured_image, $topic_id, $body, $published;
    
            $this->title = esc($request_values['title']);
            $this->body = htmlentities(esc($request_values['body']));
            $this->post_id = esc($request_values['id']);
            if (isset($request_values['topic_id'])) {
                $this->topic_id = esc($request_values['topic_id']);
            }
            if (isset($request_values['published'])) {
                $this->published = esc($request_values['published']);
            }
            // create slug
            $this->post_slug = makeSlug($this->title);
    
            if (empty($this->title)) { array_push($this->errors, "Titlu postare este necesar"); }
            if (empty($this->body)) { array_push($this->errors, "Textul postarii este necesar"); }
            
            
            
            $this->featured_image = $_FILES['featured_image']['name'];
              
            if (empty($this->featured_image)) { array_push($this->errors, "Poza este obligatorie"); }
            
            // calea catre directorul cu poze
            $target = "../static/images/" . basename($this->featured_image);
            
            if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
                array_push($this->errors, "Nu s-a incarcat nici o poza. verificati locatia pe server");
            }
            
    
    
            // salvare date
            if (count($this->errors) == 0) {
                $query = "UPDATE postari SET title='$this->title', slug='$this->post_slug', views=0, poza='$this->featured_image', body='$this->body', published='$this->published', updated_at=now() WHERE id=$this->post_id";
                // attach topic to post on post_topic table
                mysqli_query($database->getConnection(), $query); // if post created successfully
                    // if (isset($this->topic_id)) {
                    //     $this->inserted_post_id = mysqli_insert_id($database->getConnection());
                    //     // relatie intre topic si postare
                    //     $sql = "INSERT INTO topic_postari (post_id, topic_id) VALUES('$this->inserted_post_id', '$this->topic_id')";
                    //     mysqli_query($database->getConnection(), $sql);
                    //     $_SESSION['message'] = "Postare actualizata cu succes";
                    //     header('location: posts.php');
                    //     exit(0);
                    // }
                
                $_SESSION['message'] = "Post updated successfully";
                header('location: posts.php');
                exit(0);
            }
        }
        // stergere postare
        function deletePost($post_id)
        {
            $database = new Database();
            $conn = $database->getConnection();
            $sql = "DELETE FROM postari WHERE id=$post_id";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Postare stearsa cu succes";
                header("location: posts.php");
                exit(0);
            }
        }



}