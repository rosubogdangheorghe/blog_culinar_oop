<?php include('config.php')?>

<?php include('classes/registration_login.php');?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(ROOT_PATH . '/includes/head.php'); ?>
    <title>Blog Culinar | Sign up </title>
</head>
<body>

<div class="container">

    <?php include(ROOT_PATH . '/includes/meniu.php')?>

    <div style="width: 40%; margin: 20px auto;">
        <form method="post" action="register.php">
            <h2>Inregistreaza-te pe blog</h2>
            <?php include(ROOT_PATH . '/includes/errors.php')?>
            <input  type="text" name="username" value="<?php echo $username; ?>"  placeholder="Username">
			<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
			<input type="password" name="password_1" placeholder="Parola">
			<input type="password" name="password_2" placeholder="Confirmare parola">
			<button type="submit" class="btn" name="reg_user">Inregistreaza-te</button>
			<p>
				Deja Inregistrat? <a href="login.php">Sign in</a>
			</p>  


        </form>

    </div>
   

<?php include( ROOT_PATH . '/includes/footer.php'); ?>
</div>
</body>

</html>