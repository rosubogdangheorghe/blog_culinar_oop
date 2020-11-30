<?php
include('config.php');
include(ROOT_PATH . '/classes/Pubfunc.php');
if(isset($_GET['topic'])) {
    $topic_id = $_GET['topic'];
    $posts = getPublishedPostsByTopic($topic_id);
}
//print_r($posts);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(ROOT_PATH . '/includes/head.php'); ?>
    <title>Blog Culinar | Home</title>
</head>

<body>
    <div class="container">
        <?php include(ROOT_PATH . '/includes/meniu.php'); ?>
        <div class="content">
            <h2 class="content-title">
                Retete din categoria: <u><?php echo getTopicNameByID($topic_id);?></u>
            </h2>
            <hr>
        <?php foreach($posts as $post):?>
            <div class="post" style="margin-left:0px;">
                <img src="<?php echo BASE_URL . 'static/images/' . $post['poza'];?>" class = "post_image" alt="">
                <a href="postare.php?post-slug=<?php echo $post['slug'];?>">
                    <div class="post_info">
                        <h3><?php echo $post['title'];?></h3>
                        <div class="info">
                            <span><?php echo date("F j,Y ",strtotime($post['created_at']));?></span>
                            <span class="read_more">Read more...</span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
            
        </div>
    
    <?php include( ROOT_PATH . '/includes/footer.php'); ?>
    </div>
</html>