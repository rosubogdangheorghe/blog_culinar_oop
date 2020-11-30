<?php require_once '../config.php' ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<?php $posts = getAllPosts(); ?>


<title>Admin | Post Management</title>
</head>

<body>
    <div class="container">
    <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
    
    <div class="container content">
        <!-- include side meniu  -->
        <?php include(ROOT_PATH . '/admin/includes/meniu.php') ?>


        <!-- afiseza inregistrari din BD -->

        <div class="table-div" style="width: 80%;">
            <!-- afiseaza notificari -->

            <?php include(ROOT_PATH . '/includes/messages.php'); ?>

            <?php if (empty($posts)) : ?>

                <h1 style="text-align: center; margin-top: 20px;">Nu exista postari in baza de date.</h1>
            <?php else : ?>
                <table class="table">
                    <thead>
                        <th>Nr</th>
                        <th>ID postare</th>
                        <th>Autor</th>
                        <th>Titlu</th>
                        <th>View</th>
                        <!-- doar admin poate sa publice/retraga o postare -->
                        <?php if ($_SESSION['user']['rol'] == 'Admin') : ?>
                            <th><small>Publica</small></th>
                        <?php endif; ?>
                        <th><small>Edit</small></th>
                        <th><small>Delete</small></th>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $key => $post) : ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $post['id'];?></td>
                                <td><?php echo $post['author']; ?></td>
                                <td>
                                    <a target="_blank" href="<?php echo BASE_URL . 'postare.php?post-slug=' . $post['slug'] ?>">
                                        <?php echo $post['title']; ?>
                                    </a>
                                </td>
                                <td><?php echo $post['views']; ?></td>
                        
                        <!-- doar admin poate sa publice/retraga o postare -->
                                <?php if ($_SESSION['user']['rol'] == 'Admin') : ?>
                                    <td>
                                        <?php if ($post['published'] == true) : ?>
                                            <a class="fa fa-check btn unpublish" href="posts.php?unpublish=<?php echo $post['id']; ?>"></a>
                                        <?php else : ?>
                                            <a class="fa fa-times btn publish" href="posts.php?publish=<?php echo $post['id']; ?>"></a>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <a class="fa fa-pencil btn edit" href="create_post.php?edit_post=<?php echo $post['id'] ?>"></a>
                                </td>
                                <td>
                                    <a class="fa fa-trash btn delete" href="create_post.php?delete_post=<?php echo $post['id'] ?>"></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            <?php endif; ?>

        </div>
                <!-- afiseza inregistrari din BD -->                              


    </div>

</div>

</body>

</html>