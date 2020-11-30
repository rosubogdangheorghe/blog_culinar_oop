<?php require_once '../config.php' ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<?php $topics = getAllTopics(); ?>

<title>Admin | Create Post</title>

</head>

<body>
    <div class = "container">
    <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

    <div class="container content">
        <!-- include side meniu  -->
        <?php include(ROOT_PATH . '/admin/includes/meniu.php') ?>

        <!-- formular de creare editare -->
        <div class="action create-post-div">
            <form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'admin/create_post.php'; ?>">

                <!-- erori validare -->
                <?php include(ROOT_PATH . '/includes/errors.php'); ?>
                <!-- in caz de editare, id postare este necesar pt identificare postare -->
                <?php if ($isEditingPost === true) : ?>
                    <input type="hidden" name="id" value="<?php echo $post_id; ?>">
                <?php endif; ?>
                <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Titlu">
                <label style="float : left; margin:5px auto 5px">Imagine</label>
                <input type="file" name="featured_image">
                <textarea name="body" id="body" cols="30" rows="30"><?php echo $body ?></textarea>
                <select name="topic_id">
                    <option value="" selected disabled>Alege topic</option>
                    <?php foreach ($topics as $topic) : ?>
                        <option value="<?php echo $topic['id']; ?>"><?php echo $topic['nume']; ?></option>
                    <?php endforeach; ?>



                </select>

                <!-- doar admin vede campul de publish -->

                <?php if ($_SESSION['user']['rol'] == "Admin") : ?>

                    <?php if ($published == true) : ?>
                        <label for="publish">
                            Publica
                            <input type="checkbox" value="1" name="published" checked="checked">&nbsp;
                        </label>
                    <?php else : ?>
                        <label for="publish">
                            Publica
                            <input type="checkbox" value="1" name="published">&nbsp;
                        </label>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($isEditingPost === true): ?> 
					<button type="submit" class="btn" name="update_post">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_post">Save Post</button>
				<?php endif ?>

            </form>


        </div>


    </div>
</div>
</body>

</html>

<script>
    CKEDITOR.replace('body');
</script>