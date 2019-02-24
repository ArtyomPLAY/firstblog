<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";
$path = 'php/auth/';
?>
<nav class="navbar fixed-top navbar-expand-md navbar-light bg-light navbar-outline">
    <div class="container align-items-md-center">   
        <a href="index.php" id="header-title" class ="navbar-brand"><svg viewBox="0 0 17 13" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.924 0.599976C4.772 0.599976 5.484 0.875976 6.06 1.42798C6.636 1.97998 6.924 2.68398 6.924 3.53998C6.924 4.39598 6.636 5.09998 6.06 5.65198C5.484 6.20398 4.772 6.47998 3.924 6.47998H2.808V8.99998H0.660004V0.599976H3.924ZM3.924 4.43998C4.164 4.43998 4.364 4.35598 4.524 4.18798C4.692 4.01998 4.776 3.80398 4.776 3.53998C4.776 3.27598 4.692 3.06398 4.524 2.90398C4.364 2.73598 4.164 2.65198 3.924 2.65198H2.808V4.43998H3.924Z" fill="#fff"/>
            <path d="M16.3296 0.599976V8.99998H14.1936V4.47598L12.1536 7.84798H11.9376L9.90957 4.48798V8.99998H7.76157V0.599976H9.90957L12.0456 4.18798L14.1936 0.599976H16.3296Z"/>
            <rect x="1" y="8.5" width="15" height="1" fill="#fff" stroke="#fff" stroke-width="0.66"/>
            <rect x="1" y="11.5" width="15" height="1" fill="#fff" stroke="#fff" stroke-width="0.66"/>
            </svg>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto align-items-md-center desktop">
                <li class="nav-item">
                    <a class="nav-link" href="mailto:artglz63@gmail.com">Contact</a></li>
                    <?php if(isset($_SESSION['logged_user'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['logged_user']->login?></a>
                    <? draw::user_menu();?>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><img class="avatar" src="<?php echo $_SESSION['logged_user']->avatar;?>"></a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <button class="btn btn-outline-success login">Log in</button>
                </li>
                <?php endif ?>
            </ul>
            <ul class="navbar-nav mobile">
            <? if(isset($_SESSION['logged_user'])):
                draw::user_menu_mobile();
                else:?>
                <li class="nav-item">
                    <a class="nav-link" href="mailto:artglz63@gmail.com">Contact</a>
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-success login">Log in</button>
                </li>
            <? endif;?>
            </ul>  
        </div>
        <? if(!isset($_SESSION['logged_user'])) draw::login_popup();?>
    </div>
</nav>
