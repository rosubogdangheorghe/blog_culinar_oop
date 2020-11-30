<?php

   
class Post_comment {


    public $post_id;
    public $user_id;
    public $cbody;
    public $post_slug;

    public function postComment($request_value) {
    $database = new Database();
    $cbody = $request_value['comment_text'];
    $user_id = $_SESSION['user']['id'];
    $post_id = $request_value['post_id'];
    $query = "INSERT INTO comments (post_id,user_id,cbody,created_at,updated_at) VALUES ('$post_id','$user_id','$cbody',now(),now())";
    $result = mysqli_query($database->getConnection(),$query);
    // $inserted_comment_id = mysqli_insert_id($database->getConnection());
    // $sql = "SELECT * FROM comments WHERE id = $inserted_comment_id";
    // $res = mysqli_query($database->getConnection(),$sql);
    // $inserted_comment = mysqli_fetch_assoc($res);

       header("location: index.php");
       exit(0);
       return $result;
 }
}