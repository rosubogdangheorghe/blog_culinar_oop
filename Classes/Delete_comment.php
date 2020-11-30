<?php 

class Delete_comment {


    public function deleteComment($comment_id)
	{
		$database = new Database();
        $conn = $database->getConnection();
		$sql = "DELETE FROM comments WHERE id=$comment_id";
		if (mysqli_query($conn, $sql)) {
			
			header("location: index.php");
			exit(0);
		}
    }


}