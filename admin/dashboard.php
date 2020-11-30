<?php require_once '../config.php' ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<?php 
        $usersCount = implode(countUsers());
        $postsCount = implode(countPosts());
        $commentsCount = implode(countComments());

?>

<title>Admin | Dashboard</title>
</head>

<body>
<div class = "container">
<?php include(ROOT_PATH .'/admin/includes/navbar.php')?>
<?php //include(ROOT_PATH .'/admin/includes/meniu.php')?>

   
    <div class="container-dashboard">
            <h1>Dashboard Area</h1>
            <div class="stats">
                <a href="users.php" class="first">
                    <span><?php echo $usersCount?></span><br>
                    <span>Utilizatori inregistrati</span>
                    <br>
                    <br>
                    <br>
                
                </a>
                <a href="posts.php">
                    <span><?php echo $postsCount;?></span><br>
                    <span>Postari Publicate</span><br>

                    <span><?php echo $commentsCount;?></span><br>
                    <span>Comentarii Publicate</span>
                    

                </a>
            </div>
            <br><br><br>
            <div class="buttons">
                <a href="users.php">Adauga Utilizator</a>
                <a href="posts.php">Adauga postare</a>
            </div>


    </div>
</div>    
</body>
</html>