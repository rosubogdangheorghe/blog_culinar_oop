<?php include('config.php')?>

<?php include('classes/registration_login.php');?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(ROOT_PATH . '/includes/head.php'); ?>
    <title>Blog Culinar | Sign in </title>
</head>

<body>
<div class="container">
	<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/meniu.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="login.php" >
			<h2>Login</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input type="text" name="username" value="<?php echo $username; ?>" value="" placeholder="Username">
			<input type="password" name="parola" placeholder="Parola">
			<button type="submit" class="btn" name="login_btn">Login</button>
			<p>
				Nu esti membru inca? <a href="register.php">Sign up</a>
			</p>
		</form>
	</div>

<!-- // container -->

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
</div>