<?php
//variabile postare

$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$post_slug = "";
$body = "";
$featured_image = "";
$post_topic = "";

//afiseaza toate postarile din DB

function getAllPosts() {
    $database = new Database();
    //admin pot sa vada toate postarile
    //author pot sa vada doar postarile lor

    if($_SESSION['user']['rol'] == "Admin") {
        $sql = "SELECT * FROM postari";

    } elseif ($_SESSION['user']['rol'] == "Author") {
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT * FROM postari WHERE user_id = $user_id";
    }

    $result = mysqli_query($database->getConnection(),$sql);
    $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $final_posts = [];

    foreach($posts as $post) {
        // echo "<pre>";
        $post['author'] =  getPostAuthorById($post['user_id']);
       // print_r($post);
        array_push($final_posts,$post);

    }
   // print_r($final_posts);
    return $final_posts;
}

// functia pe author dupa username


function getPostAuthorById ($user_id) {
    $database = new Database();
    $sql = "SELECT username FROM utilizatori WHERE id = $user_id";
    $result = mysqli_query($database->getConnection(),$sql);
    $autor =  mysqli_fetch_assoc($result);
    return $autor['username'];
    // if($result) {

    //     return mysqli_fetch_assoc($result)['username'];
    // } else {
    //     return null;
    // }

}

// Actiuni postare

//creare

if(isset($_POST['create_post'])) {
    $createPost = new Content();
    $createPost->createPost($_POST);
}

//editare
if(isset($_GET['edit_post'])) {

    $isEditingPost = true;
    $post_id = $_GET['edit_post'];
    $editPost = new Content();
    $editPost->editPost($post_id);
}

//postare editare
if(isset($_POST['update_post'])) {
    $updatePost = new Content;
    $updatePost->updatePost($_POST);
}

//stergere postare

if(isset($_GET['delete_post'])) {
    $post_id = $_GET['delete_post'];
    $deletePost = new Content();
    $deletePost->deletePost($post_id);
}

// function createPost($request_values) {
//     $database = new Database();
//     global $errors, $title, $featured_image, $topic_id, $body, $published,$user_id;
//     $title = esc($request_values['title']);
//     $body = htmlentities(esc($request_values['body']));
//     $topic_id = esc($request_values['topic_id']);
//     // if (isset($request_values['topic_id'])) {
//     //     $topic_id = esc($request_values['topic_id']);
//     // }
//     if (isset($request_values['published'])) {
//         $published = esc($request_values['published']);
//     }
//     $post_slug = makeSlug($title);
// 		// formular validare
// 		if (empty($title)) { array_push($errors, "Titlu postare este necesar"); }
// 		if (empty($body)) { array_push($errors, "Textul postarii este necesar"); }
//         if (empty($topic_id)) { array_push($errors, "Topicul este necesar"); }
        
// 		// numele pozei
//           $featured_image = $_FILES['featured_image']['name'];
          
//           if (empty($featured_image)) { array_push($errors, "Poza este obligatorie"); }
          
// 	  	// image file directory
//           $target = "../static/images/" . basename($featured_image);
          
// 	  	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
// 	  		array_push($errors, "Nu s-a incarcat nici o poza. verificati locatia pe server");
// 	  	}
// 		// Ensure that no post is saved twice. 
// 		$post_check_query = "SELECT * FROM postari WHERE slug='$post_slug' LIMIT 1";
//         $result = mysqli_query($database->getConnection(), $post_check_query);
//         if(mysqli_num_rows($result)>0) {
//             array_push($errors, "O postare cu acelasi titlu exista deja.");
//         }
//         if(count($errors) == 0 ){
//             $user_id = $_SESSION['user']['id'];
//             $query = "INSERT INTO postari (user_id,title,slug,poza,body,published,created_at,updated_at)
//             VALUES ('$user_id', '$title', '$post_slug', '$featured_image', '$body', '$published', now(), now())";


//             mysqli_query($database->getConnection(), $query);
//              // daca postarea a fost creata

//             $inserted_post_id = mysqli_insert_id($database->getConnection());
//                 // creare relatie intre post si topic
                
// 				$sql = "INSERT INTO topic_postari (post_id,topic_id) VALUES('$inserted_post_id', '$topic_id')";
// 				mysqli_query($database->getConnection(), $sql);

// 				$_SESSION['message'] = "Postare creata cu succes";
// 				header('location: posts.php');
// 				exit(0);
			
//         }
// }

// function editPost($role_id)
// {
//     $database = new Database();
//     //$conn = $database->getConnection();
//     global $title, $post_slug, $body, $published, $isEditingPost, $post_id,$featured_image;
//     $sql = "SELECT * FROM postari WHERE id=$role_id LIMIT 1";
//     $result = mysqli_query($database->getConnection(), $sql);
//     $post = mysqli_fetch_assoc($result);
//     // set form values on the form to be updated
//     $title = $post['title'];
//     $body = $post['body'];
//     $published = $post['published'];
//     //$poza = $post['poza'];
//     //$featured_image =$_FILES['featured_image']['name'];
// }

// 	function updatePost($request_values)
// 	{
//         $database = new Database();
//         //$conn = $database->getConnection();
// 		global $errors, $post_id, $title, $featured_image, $topic_id, $body, $published;

// 		$title = esc($request_values['title']);
//         $body = htmlentities(esc($request_values['body']));
// 		$post_id = esc($request_values['id']);
// 		if (isset($request_values['topic_id'])) {
// 			$topic_id = esc($request_values['topic_id']);
//         }
//         if (isset($request_values['published'])) {
//             $published = esc($request_values['published']);
//         }
// 		// create slug
// 		$post_slug = makeSlug($title);

// 		if (empty($title)) { array_push($errors, "Titlu postare este necesar"); }
//         if (empty($body)) { array_push($errors, "Textul postarii este necesar"); }
        
        
        
//         $featured_image = $_FILES['featured_image']['name'];
          
//         if (empty($featured_image)) { array_push($errors, "Poza este obligatorie"); }
        
//         // calea catre directorul cu poze
//         $target = "../static/images/" . basename($featured_image);
        
//         if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
//             array_push($errors, "Nu s-a incarcat nici o poza. verificati locatia pe server");
//         }
		


// 		// salvare date
// 		if (count($errors) == 0) {
// 			$query = "UPDATE postari SET title='$title', slug='$post_slug', views=0, poza='$featured_image', body='$body', published='$published', updated_at=now() WHERE id=$post_id";
// 			// attach topic to post on post_topic table
// 			if(mysqli_query($database->getConnection(), $query)){ // if post created successfully
// 				if (isset($topic_id)) {
// 					$inserted_post_id = mysqli_insert_id($database->getConnection());
// 					// relatie intre topic si postare
// 					$sql = "INSERT INTO topic_postari (post_id, topic_id) VALUES('$inserted_post_id', '$topic_id')";
// 					mysqli_query($database->getConnection(), $sql);
// 					$_SESSION['message'] = "Postare actualizata cu succes";
// 					header('location: posts.php');
// 					exit(0);
// 				}
// 			}
// 			$_SESSION['message'] = "Post updated successfully";
// 			header('location: posts.php');
// 			exit(0);
// 		}
//     }
//     // stergere postare
// 	function deletePost($post_id)
// 	{
// 		$database = new Database();
//         $conn = $database->getConnection();
// 		$sql = "DELETE FROM postari WHERE id=$post_id";
// 		if (mysqli_query($conn, $sql)) {
// 			$_SESSION['message'] = "Postare stearsa cu succes";
// 			header("location: posts.php");
// 			exit(0);
// 		}
// 	}
?>