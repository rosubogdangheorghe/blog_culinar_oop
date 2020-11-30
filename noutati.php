<?php require_once 'config.php'?>
<?php require_once ROOT_PATH . '/classes/Pubfunc.php'?>
<?php $posts = getLastPublishedPosts();
    ?>
<?php require_once(ROOT_PATH .'/classes/registration_login.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once (ROOT_PATH . '/includes/head.php');?>
    <title>Blog Culinar | Home</title>
</head>
<body>
<div class="container">
     <?php require_once (ROOT_PATH .'/includes/meniu.php');?>
     <?php include (ROOT_PATH .'/includes/banner.php');?>

     <div class="content">
			<h2 class="content-title">Articole recente</h2>
			<hr>
 
<?php foreach ($posts as $post):?>
   
        <div class="post" style="margin-left:0px;">
            <img src="<?php echo BASE_URL . 'static/images/'.$post["poza"];?>" class="post_image" alt="">
            
            <?php if(isset($post['topic']['nume'])):?>
                <a
                 href="<?php echo BASE_URL . 'postari_filtrate.php?topic=' .$post['topic']['id']?> "
                 class = "btn category">
                 <?php echo $post['topic']['nume']?>
                 </a>   
            <?php endif ?>
            
            <a href="postare.php?post-slug=<?php echo $post['slug'];?>">
                <div class="post_info">
                    <h3><?php echo $post['title']?></h3>
                    <div class="info">
                        <span><?php echo date("F j, Y", strtotime($post['created_at']));?></span>
                        <span class="read_more">Citeste mai departe....</span>
                    </div>

                </div>

        </div>

<?php endforeach?>
        </div>
       
     <?php require_once (ROOT_PATH .'/includes/footer.php');?>
</div>
</body>
</html>