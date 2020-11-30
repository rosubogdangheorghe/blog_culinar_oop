
<?php if(isset($_SESSION['user']['username'])): ?>

	<div class="logged_in_info">

			<span>Welcome <?php echo $_SESSION['user']['username']?></span>
			<span><a href="logout.php">Logout</a> </span>
			<?php if($_SESSION['user']['rol'] == "Admin" OR $_SESSION['user']['rol'] == "Author"):?>
				<a href = "admin/dashboard.php">Admin Area</a>
			<?php endif;?>

	</div>

			<?php else:?>
	
<div class="banner">
	<div class="welcome_msg">
		<h1><button id="button">Today's Inspiration</button></h1>
		<p id = "citat"> </p>
		
		<p id="autor"></p>
	
		<!-- <a href="register.php" class="btn">Join us!</a> -->
	</div>
	<div class="login_div">
		<form action="<?php echo BASE_URL. 'index.php';?>" method="post" >
			<h2>Pentru Login apasa pe Sign in</h2>
			<div style="width: 60%; margin: 0px auto;">
					<?php include(ROOT_PATH . '/includes/errors.php') ?>
				</div>
			<input type="text" name="username" value = "<?php echo $username;?>" placeholder="Username">
			<input type="password" name="parola"  placeholder="Password"> 
			<button class="btn" type="submit" name="login_btn">Sign in</button>
		</form>
	</div>
</div>
<?php endif ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
	 $(document).ready(function(){
		
     $("#button").click(function(){
		let index = Math.floor(Math.random()*100)
        $.ajax(
           "https://type.fit/api/quotes",
            {
                type:'GET',
                dataType:'json',
                success: function(result,status,xhr) {
                    $('#citat').replaceWith('<p id = citat>'+result[index].text+'</p>');
                    $('#autor').replaceWith('<p id = autor>'+result[index].author+'</p>');

                },
                error: function(jqXhr,textStatus,errorMessage){
                    $('#citat').append('Error' + errorMessage);
                }
            }
        ); 
    });
});
</script>