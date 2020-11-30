<?php require_once '../config.php' ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<?php $topics = getAllTopics(); ?>


<title>Admin | Topic Management</title>
</head>

<body>
    <div class="container">
    <!-- admin navbar -->
    
    <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
    <div class="container content">
        <!-- meniu left side -->
        <?php include(ROOT_PATH . '/admin/includes/meniu.php') ?>
        <div class="action">
            <h1>Creare Editare Topic</h1>
            <form method="post" action="<?php echo BASE_URL . 'admin/topics.php' ?>">
                <!-- erori validare formular -->
                <?php include(ROOT_PATH . '/includes/errors.php') ?>
                <!-- pt editare user este necesar ID pt identificare -->
                <?php if ($isEditingTopic === true) : ?>
                    <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                <?php endif; ?>
                <input type="text" name="topic_name" value="<?php echo $topic_name; ?>" placeholder="Topic">

                <!-- in caz de editare afiseaza update in loc de creare -->

                <?php if ($isEditingTopic === true) : ?>
                    <button type="submit" class="btn" name="update_topic">Update Topic</button>
                <?php else : ?>
                    <button type="submit" class="btn" name="create_topic">Save Topic</button>
                <?php endif; ?>
            </form>
        </div>
        
        <div class="table-div">

        <?php include(ROOT_PATH . '/includes/messages.php') ?>
        <?php if (empty($topics)) : ?>
            <h1>Nici un Topic in baza de date</h1>
        <?php else : ?>
            <table class="table">
                <thead>
                    <th>Nr</th>
                    <th>Topic</th>
                    <th colspan="2">Actiune</th>
                </thead>
                <tbody>
                    <?php foreach ($topics as $key => $topic) : ?>
                        <tr>
                            <td><?php echo $key + 1; ?> </td>
                            <td>
                                <?php echo $topic['nume']; ?>
                            </td>

                            <td>
                                <a class="fa fa-pencil btn edit" href="topics.php?edit_topic=<?php echo $topic['id'] ?>"></a>
                            </td>
                            <td>
                                <a class="fa fa-trash btn delete" href="topics.php?delete_topic=<?php echo $topic['id'] ?>"></a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>

            </table>
        <?php endif; ?>
    </div>
    </div>
</div>    
</body>

</html>