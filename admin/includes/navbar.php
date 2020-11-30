<div class="buttons">
        <div class="logo">
            <a href="<?php echo BASE_URL . 'admin/dashboard.php'?>">
                <h2> Blog Culinar - Admin_Dashboard</h2> </a>

                <li><a class="active" href="../index.php">Home</a></li>
               
            
        </div>
        <?php if(isset($_SESSION['user'])):?>
            <div class="user-info">
                <li>Utilizator: <?php echo $_SESSION['user']['username']?></li>
                <li><a href="<?php echo BASE_URL . 'logout.php';?>" class="logout-btn">Logout</a></li>
            </div>
        <?php endif;?>

    </div>