<?php require_once '../config.php' ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php

$admins = getAdminUsers();
// echo"<pre>";
// print_r($admins);
// echo $admins[0]['username'];

$roles = ['Admin', 'Author']; ?>

<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

<title>Admin | Management Utilizatori</title>
</head>

<body>
    <!-- admin navbar -->
    <div class="container">
    <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
    <div class="container content">
        <!-- meniu left side -->
        <?php include(ROOT_PATH . '/admin/includes/meniu.php') ?>
        <!-- formular de creat si editat utilizatori -->
        <div class="action">
            <h1>Creare Editare Administrare utilizatori</h1>
            <form method="post" action="<?php echo BASE_URL . 'admin/users.php' ?>">

                <!-- erori validare formular -->
                <?php include(ROOT_PATH . '/includes/errors.php') ?>

                <!-- pt editare user este necesar ID pt identificare -->
                <?php if ($isEditingUser === true) : ?>
                    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                <?php endif; ?>

                <input type="text" name="username" value="<?php echo $username ?>" placeholder="Utilizator">
                <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
                <input type="password" name="parola" placeholder="Parola">
                <input type="password" name="confParola" placeholder="Confirmare parola">
                <select name="rol">
                    <option value="" selected disabled>Atribuie rol</option>
                    <?php foreach ($roles as $role) : ?>
                        <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- in caz de editare afiseaza update in loc de creare -->

                <?php if ($isEditingUser === true) : ?>
                    <button type="submit" class="btn" name="update_admin">Update</button>
                <?php else : ?>
                    <button type="submit" class="btn" name="create_admin">Save user</button>
                <?php endif; ?>

            </form>
        </div>
        <div class="table-div">
            <!-- afisare inregistrari baza de date -->
            <?php include(ROOT_PATH . '/includes/messages.php') ?>
            <?php if (empty($admins)) : ?>
                <h1>Nici un Utilizator Admin in baza de date</h1>
            <?php else : ?>
                <table class="table">
                    <thead>
                        <th>Nr</th>
                        <th>Admin</th>
                        <th>Rol</th>
                        <th colspan="2">Actiune</th>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $key => $admin) : ?>
                            <tr>
                                <td><?php echo $key + 1; ?> </td>
                                <td>
                                    <?php echo $admin['username']; ?>,&nbsp;
                                    <?php echo $admin['email']; ?>
                                </td>
                                <td><?php echo $admin['rol']; ?></td>
                                <td>
                                    <a class="fa fa-pencil btn edit" href="users.php?edit_admin=<?php echo $admin['id'] ?>"></a>
                                </td>
                                <td>
                                    <a class="fa fa-trash btn delete" href="users.php?delete_admin=<?php echo $admin['id'] ?>"></a>
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