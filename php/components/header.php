
<div class="header">
        <div class="container">
            <h4><a href="index.php" id="header-title">Post machine</a></h4>
            <ul id="header-nav">
                <li><a href="about.php">About</a></li>
                <li><a href="mailto:artglz63@gmail.com">Contact</a></li>
                <?php if(isset($_SESSION['logged_user'])): ?>
                <li>
                    <a class="name" href="php\auth\logout.php"><?php echo $_SESSION['logged_user']->login?></a>
                    <img src="<?php echo $_SESSION['logged_user']->avatar;?>" width="40px" height="40px">
                </li>
                <?php else: ?>
                <li><button>Login</button></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
