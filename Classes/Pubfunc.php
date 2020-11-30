<?php
    
  
    function getPostTopic($post_id){
        $sql = "SELECT * FROM topic WHERE id = (SELECT topic_id FROM topic_postari WHERE post_id=$post_id) LIMIT 1";
        $database = new Database();
        $result = mysqli_query($database->getConnection(),$sql);
        $topic = mysqli_fetch_assoc($result);
        //print_r($topic);
        return $topic;

    }
   function getPublishedPosts() {
        $sql = "SELECT * FROM blogculinar.postari WHERE published = true";
        $database = new Database();
        $result = mysqli_query($database->getConnection(),$sql);
        $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //print_r($posts);
        $final_posts = array();
        foreach($posts as $post){
            $post['topic'] = getPostTopic($post['id']);
           // print_r($post['topic']);
           // $final_posts = $posts;
            array_push($final_posts,$post);
        }
    //    echo"<pre>";
    //    print_r($final_posts);
        return $final_posts;

    }

    function getLastPublishedPosts() {
        $sql = "SELECT  * FROM blogculinar.postari WHERE published = true ORDER BY updated_at DESC LIMIT 1";
        $database = new Database();
        $result = mysqli_query($database->getConnection(),$sql);
        $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //print_r($posts);
        $final_posts = array();
        foreach($posts as $post){
            $post['topic'] = getPostTopic($post['id']);
           // print_r($post['topic']);
           // $final_posts = $posts;
            array_push($final_posts,$post);
        }
    //    echo"<pre>";
    //    print_r($final_posts);
        return $final_posts;
    }

    //Toate postarile de un anumit topic
    function getPublishedPostsByTopic($topic_id) {
            $sql = "SELECT * FROM postari ps WHERE ps.id IN (SELECT pt.post_id FROM topic_postari pt WHERE pt.topic_id= $topic_id GROUP BY pt.post_id 
            HAVING COUNT(1) = 1)";
            $database = new Database();
            $result = mysqli_query($database->getConnection(),$sql);
            $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
            $final_posts=[];
            foreach($posts as $post){
                $post['topic'] = getPostTopic($post['id']);
                //$final_posts = $posts;
                array_push($final_posts,$post);
            }
            return $final_posts;
        }
        //toate postarile dupa topic_id

        function getTopicNameByID($id) {
            $sql ="SELECT nume From topic WHERE id = $id";
            $database = new Database();
            $result = mysqli_query($database->getConnection(),$sql);
            $topic = mysqli_fetch_assoc($result);
            return $topic['nume'];

        }
        //returneaza o singura postare
       
      // $post_slug=$_GET['post-slug'];

        function getPost($slug) {
            global $post_slug;
            $database = new Database();
            $post_slug=$_GET['post-slug'];
            $sql = "SELECT * FROM postari WHERE slug = '$post_slug' AND published = true";
            //$result = $database->query($sql);
            $result = mysqli_query($database->getConnection(),$sql);
            $post = $result->fetch_assoc();
            if($post) {
                $post['topic'] = getPostTopic($post['id']);
            }
            return $post;

        }
        //returneaza toate topicurile

        function getAllTopics() {
            $database = new Database();
            $sql = "SELECT * FROM topic";
            $result = mysqli_query($database->getConnection(),$sql);
            $topics = $result->fetch_all(MYSQLI_ASSOC);
            return $topics;
        }

    
?>
        