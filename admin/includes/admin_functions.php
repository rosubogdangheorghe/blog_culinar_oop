<?php 
//variabile admin user
//include('../autoload.php');

$admin_id = 0;
$isEditingUser = false;
$username="";
$role="";
$email="";

$errors=[];

//actiuni admin user

//click pe create admin

if(isset($_POST['create_admin'])) {
    $create_admin = new Create_Admin();
    $create_admin->createAdmin($_POST);
}

//click pe Edit admin

if(isset($_GET['edit_admin'])){
    $isEditingUser = true;
    $admin_id = $_GET['edit_admin'];
    $editAdmin = new Create_Admin();
    $editAdmin->editAdmin($admin_id);
}
// click pe update admin

if(isset($_POST['update_admin'])) {
    $updateAdmin = new Create_Admin();
    $updateAdmin->updateAdmin($_POST);
}


//click pe Delete admin
if(isset($_GET['delete_admin'])) {
    $admin_id = $_GET['delete_admin'];
    $deleteAdmin = new Create_Admin();
    $deleteAdmin->deleteAdmin($admin_id);

}


//returneaza toti useri Admin si rolul coresp

function getAdminUsers(){
    $database = new Database();
    //global $roles; 
    $sql = "SELECT * FROM utilizatori"; //WHERE rol IS NOT NULL
    $result = mysqli_query($database->getConnection(),$sql);
    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
    return $users;

}

    

//escape form submitted value,hence,preventing SQL injection

function esc(String $value) {
    $database = new Database();
    $val = trim($value);
    $val = mysqli_real_escape_string($database->getConnection(),$value);
    return $val;
}

//transforma string : Mostra de string in mostra-de-string

function makeSlug(String $string) {
    $string = strtolower($string);
    $slug = preg_replace('/[^A-Za-z0-9-]+/','-',$string);
    return $slug;
}



//Topics data
//variabile topics :

$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";

if(isset($_POST['create_topic'])) {
    $createTopic = new Topic();
    $createTopic->createTopic($_POST);
}

//click pe Edit topic

if(isset($_GET['edit_topic'])){
    $isEditingTopic = true;
    $topic_id = $_GET['edit_topic'];
    $editTopic = new Topic();
    $editTopic->editTopic($topic_id);
}
// click pe update topic

if(isset($_POST['update_topic'])) {
    $updateTopic = new Topic();
   $updateTopic-> updateTopic($_POST);
}


//click pe Delete topic
if(isset($_GET['delete_topic'])) {
    $topic_id = $_GET['delete_topic'];
    $deleteTopic = new Topic();
    $deleteTopic->deleteTopic($topic_id);

}


//Topic Function

function getAllTopics() {
    $database = new Database();
    $sql = "SELECT * FROM blogculinar.topic";
    $result = mysqli_query($database->getConnection(),$sql);
    $topics = mysqli_fetch_all($result,MYSQLI_ASSOC);
    return $topics;
}

//Count posts

function countPosts() {
    $database = new Database();
    $sql = "SELECT count(id) FROM blogculinar.postari";
    $result = mysqli_query($database->getConnection(),$sql);
    $postsCount = mysqli_fetch_assoc($result);
    return $postsCount;
    

}
function countComments() {
    $database = new Database();
    $sql = "SELECT count(id) FROM blogculinar.comments";
    $result = mysqli_query($database->getConnection(),$sql);
    $commentsCount = mysqli_fetch_assoc($result);
    return $commentsCount;
    

}
function countUsers(){
    $database = new Database();
    $sql = "SELECT count(id) FROM utilizatori";
    $result = mysqli_query($database->getConnection(),$sql);
    $usersCount = mysqli_fetch_assoc($result);

    return $usersCount;
}

