<?php

require('config.php');
require(ROOT_PATH . '/classes/Pubfunc.php');
if (isset($_GET['post-slug'])) {

    $post = getPost($_GET['post-slug']);
}
$topics = getAllTopics();

require(ROOT_PATH . '/classes/commentsfunct.php');
$comments = getAllComments();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(ROOT_PATH . '/includes/head.php'); ?>
    <!-- <link rel="stylesheet" href="/static/css/style.css"> -->
    <title><?php echo $post['title'] ?>| Blog Culinar</title>
</head>

<body>
    <div class="container">

        <?php include(ROOT_PATH . '/includes/meniu.php'); ?>

        <div class="content">

            <div class="post-wrapper">
                <div class="full-post-div">
                    <?php if ($post['published'] == false) : ?>
                        <h2 class="post-title"> Ne pare rau. Aceasta reteta nu a fost publicata</h2>
                    <?php else : ?>
                        <h2 class="post-title"><?php echo $post['title']; ?></h2>
                        <img src="<?php echo BASE_URL . 'static/images/' . $post["poza"]; ?>" class="post_image" alt="">
                        <div class="post-body-div">
                            <?php echo html_entity_decode($post['body']); ?>
                        </div>
                    <?php endif ?>
                </div>

                <!-- // full post div -->

                <!-- comments section -->

                <div class="col-sm-6 comments-section">
                    <!-- comment form -->
                    <div>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <form class="clearfix" action="postare.php" method="post" id="comment_form">
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                <h4>Posteaza un comentariu:</h4>
                                <textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
                                <button class="btn btn-primary btn-sm pull-right" id="submit_comment" name="submit_comment">Posteaza comentariu</button>
                            </form>
                        <?php else : ?>
                            <div class="well" style="margin-top:20px;">
                                <h4 class="text-center"><a href="login.php">Log in </a> pentru a posta sau sterge un comentariu</h4>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- comments wrapper -->
                    <div id="post-wrapper">
                        <div class="comment clearfix">
                            <?php if (isset($comments)) : ?>

                                <?php foreach ($comments as $comment) : ?>
                                    <?php if ($comment['post_id'] == $post['id']) : ?>
                                        <!-- <h2><span id="comments_count"><?php //echo getCommentsCountById($comment['post_id']); 
                                                                            ?></span> Comentarii</h2>
                                        <hr> -->
                                        <div class="comment clearfix">
                                            <div class="comment-details">
                                                <span class="comment-name"><?php echo getUserByID($comment['user_id']) ?></span>
                                                <span class="comment-date"><?php echo date("d-M-Y ", strtotime($comment["created_at"])); ?></span>
                                                <p><?php echo $comment['cbody'] ?></p>
                                                <?php if (isset($_SESSION['user'])) : ?>
                                                    <?php if ($_SESSION['user']['id'] == $comment['user_id'] or $_SESSION['user']['rol'] == "Admin") : ?>
                                                        <a class="btn-sm pull-right btn-primary" href="postare.php?delete_comment=<?php echo $comment['id'] ?>">Sterge Comentariu</a>
                                                    <?php endif; ?>
                                                    <!-- <?php //else:
                                                            ?>
                                                    <div class="well" style="margin-top:20px;">
                                                <p class="text-center"><a href="login.php">Log in </a> pentru a sterge comenariul</p> -->

                                            </div>
                                        <?php endif; ?>
                                        </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <h2>Fii primul/a care comenteza la aceasta reteta</h2>
            <?php endif; ?>

                    </div>
                </div>
                <!-- // comments wrapper -->

            </div>

        </div>
        <!-- // Page wrapper -->
      
            <!-- post sidebar -->
            <div class="post-sidebar">
                <div class="card">
                    <div class="card-header">
                        <h2>Categorii</h2>
                    </div>
                    <div class="card-content">
                        <?php foreach ($topics as $topic) : ?>
                            <a href="<?php echo BASE_URL . 'postari_filtrate.php?topic=' . $topic['id'] ?>">
                                <?php echo $topic['nume']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        
    
    </div>

<div>

    <?php include(ROOT_PATH . '/includes/footer.php'); ?>
 </div>
</body>

</html>