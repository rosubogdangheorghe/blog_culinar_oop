<?php



 if(isset($_POST['submit_comment'])) {
   
    $post_comment = new Post_comment();
    $post_comment->postComment($_POST);
}


if(isset($_GET['delete_comment'])) {
    $comment_id = $_GET['delete_comment'];
    $delete_comment = new Delete_comment();
    $delete_comment->deleteComment($comment_id);
}


 function getAllComments() {
   
    $database = new Database();
    $sql = "SELECT * FROM comments";
    $result = mysqli_query($database->getConnection(),$sql);
    $comments = mysqli_fetch_all($result,MYSQLI_ASSOC);
    return $comments;
 }
    
    function getUserByID($user_id){
        $database = new Database();
        //global $roles; 
        $sql = "SELECT username FROM utilizatori WHERE id = $user_id"; //WHERE rol IS NOT NULL
        $result = mysqli_query($database->getConnection(),$sql);
        $users = mysqli_fetch_assoc($result)['username'];
        return $users;
    
    }
    function getCommentsCountById($post_id) {

        $database = new Database();
        $sql = "SELECT COUNT(*) AS total FROM comments";
        $result = mysqli_query($database->getConnection(),$sql);
        $contcom = mysqli_fetch_assoc($result);
        return $contcom['total'];
     }