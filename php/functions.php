<?php 

//обращение по draw::$func
class draw{
//отрисовка поста
public static function post($post){ ?>
    <div class="post" data-id="<?echo $post->id?>">
                <?
                    $user =  R::findOne('users', 'id = ?', array($post->authors_id));//поиск юзера по id ?
                    $liked = R::findOne('actions','user_id = :user_id AND post_id = :post_id AND action_type = "1"',array(':user_id'=>$_SESSION['logged_user']->id,':post_id'=>$post->id));
                ?>
                <div class="post-author">
                    <a href="user.php<?echo '?id=',$user->id?>">
                        <img src="<?php if($user->avatar) echo $user->avatar; else echo 'content/none_avatar.png'; ?>" alt="Author's avatar">
                    </a>
                    <div>
                        <span>
                            <a class="post-username"href="user.php<?echo '?id=',$user->id?>"> 
                            <?php echo '@',$user->login; ?>
                            </a>
                        </span>
                        <p class="post-date"><?php echo $post->pub_date;?></p>
                    </div>
                </div>
                <h3 class="post-title"><?php echo $post->title; ?></h3>
                <div class="post-content">
                    <?php echo $post->content;?>
                </div>
                <div class="bottom-acts">
                    <div class="social-acts">
                        <div class="social-btn">
                                <svg class="like" data-id="<?echo $post->id?>" viewBox="0 0 28 26"  xmlns="http://www.w3.org/2000/svg">
                                <path class="<? if($liked) echo 'liked';?>"d="M26.1356 5.57005C23.9645 -1.44319 16.2583 0.93319 14.1162 4.00875C11.9741 0.93319 4.03044 -1.44282 1.85928 5.57042C-0.997116 14.7971 14.1162 24 14.1162 24C14.1162 24 28.992 14.7967 26.1356 5.57005Z"/>
                                </svg>
                            <? if($post->likes!=0) echo '<p>',$post->likes,'</p>';?>
                        </div>
                        <div class="social-btn">
                            <svg class="repost" data-id="<?echo $post->id?>" viewBox="0 0 23 19" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.9118 17L18.2347 17.736L18.9764 18.4182L19.6529 17.6714L18.9118 17ZM4.70588 2L5.447 1.32863L4.70588 0.510508L3.96476 1.32863L4.70588 2ZM10.2647 3H15.9118V1H10.2647V3ZM17.9118 5V17H19.9118V5H17.9118ZM19.5888 16.264L15.8829 12.8549L14.5289 14.3269L18.2347 17.736L19.5888 16.264ZM19.6529 17.6714L22.7411 14.2623L21.2589 12.9195L18.1706 16.3286L19.6529 17.6714ZM13.3529 16H7.70588V18H13.3529V16ZM5.70588 14V2H3.70588V14H5.70588ZM3.96476 1.32863L0.258877 5.41954L1.74112 6.76228L5.447 2.67137L3.96476 1.32863ZM3.96476 2.67137L7.67064 6.76228L9.15289 5.41954L5.447 1.32863L3.96476 2.67137ZM7.70588 16C6.60131 16 5.70588 15.1046 5.70588 14H3.70588C3.70588 16.2091 5.49674 18 7.70588 18V16ZM15.9118 3C17.0163 3 17.9118 3.89543 17.9118 5H19.9118C19.9118 2.79086 18.1209 1 15.9118 1V3Z" fill="#BABDC8"/>
                            </svg>
                            <? if($post->reposts!=0) echo '<p>', $post->reposts, '</p>';?>
                        </div>
                        <div class="social-btn">
                            <svg class="comments" data-id="<?echo $post->id?>" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.8571 1H6.14286C2.14286 1 1 5 1 6.71429C1 11.2857 5.38095 12.4286 7.85714 12.4286V17C13.5714 12.4286 17 11.2857 17 6.71429C17 3.85714 15.8571 1 11.8571 1Z"/>
                            </svg>
                            <? if($post->comments!=0) echo '<p>', $post->comments,'</p>';?>
                        </div>

                    </div>
                    <div class="tags">
                        <h4><? if(!is_null($post->tags)) {
                            $tags = explode(", ",$post->tags);
                            echo 'Tags: ';//разделение на массив тегов
                            for($i=0;$i<count($tags);$i++){
                                    echo '<a href="search.php','?tag=',substr($tags[$i],1),'">',$tags[$i],' ','</a>';
                                }
                            } ?></h4>
                    </div>     
                </div>
            </div> 
<?}
//отрисовка правого меню
public static function side_bar(){ ?>
                <?$top_posts = R::findAll('posts','ORDER BY likes DESC LIMIT 10');
                ?>
                <div class="popular-opener">
                    <p class="thread_name thread-name-first">🔥 Popular 🔥</p>
                    <span>></span>
                </div>
                <ul class="threads">
                    <? foreach ($top_posts as $post) {?>
                        <li><a href="#" data-id="<? echo $post->id;?>"><? echo $post->title?></a></li>
                    <?}?>
                    <p class="thread_name">😎 TOP users 😎</p>
                    <? $top_users = R::findAll('users','ORDER BY posts_counter DESC LIMIT 3');
                        foreach ($top_users as $user) {?>
                            <li><a href="user.php<?echo '?id=',$user->id?>"><? echo '@',$user->login?></a><span class="posts_counter"><? echo $user->posts_counter;?></span></li>
                        <?}?>
                </ul>
<? }

//отрисовка окна реги 
public static function signup_popup(){ $path = 'php/auth/';?>
    <div id="signup-popup" style="display: none">
    <button class="login-popup-close" tabindex="7">x</button>
    <form action="<?php echo $path ;?>signup.php"  method="post">
        <h3>Sign up</h3>
        <input type="text" name="login" placeholder="login" required tabindex="1" readonly pattern="\D[^А-Яа-яЁё]+$"> 
        <input type="email" name="email" placeholder="email" required tabindex="2" readonly>
        <input type="password" name="password" placeholder="password" required tabindex="3" >
        <input type="password" name="password2" placeholder="confirm password" required tabindex="4" >
        <p class="passv-tip">Passwords do not match</p>
        <input type="submit" name="do_signup" value="Sign up" tabindex="5">
        <p><a tabindex="6" class="switch-tab">or log in</a></p>
    </form>
</div>
<?}

//отрисовка логин окна
public static function login_popup(){ ?>
    <link rel="stylesheet" href="/css/main.css">
    <div id="login-wrap" style="display: none"></div>
    <?php draw::signup_popup(); ?>
        <div id="login-popup" style="display: none;">
            <button class="login-popup-close" tabindex="5">x</button>
            <form action="<?php echo $path ?>login.php"  method="post">
                <h3>Log in</h3>
                <input type="text" placeholder="login" tabindex="1" required name="login" readonly pattern="\D[^А-Яа-яЁё]+$">
                <input type="password" placeholder="password"
                tabindex="2" required name="password" readonly>
                <p class="passv-tip"></p>
                <input type="submit" value="Log in" tabindex="3" name="do_login">
                <p><a tabindex="4" class="switch-tab">or sign up</a></p>
            </form>
        </div>
<?}


//отрисовка юзер меню
public static function user_menu(){ ?>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="user.php<? echo '?id=',$_SESSION['logged_user']->id;?>">Profile</a>
        <a class="dropdown-item" href="">Statistics</a>
        <a class="dropdown-item" href="">Settings</a>
        <a class="dropdown-item postwr" style="cursor: pointer">Write post</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="php\auth\logout.php">Log out</a>

    </div>
<?}

public static function user_menu_mobile(){ ?>
        <li class="nav-item"><a class="nav-link" href="user.php<? echo '?id=',$_SESSION['logged_user']->id;?>">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="">Statistics</a></li>
        <li class="nav-item"><a class="nav-link" href="">Settings</a></li>
        <li class="nav-item"><a class="nav-link postwr" style="cursor: pointer">Write post</a></li>
        <li class="nav-item"><a class="nav-link" href="php\auth\logout.php">Log out</a></li>
<?}

//отрисовка пост форм
public static function post_form(){?>
    <div class="post post-form">
        <form action="php/components/post_form.php" method="post">

            <div class="input-group mb-2 default">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Title</span>
                </div>
                <input type="text" name="title" class="form-control" placeholder="Name it somehow" aria-label="Name it somehow" aria-describedby="basic-addon1"
                required>
            </div>

            <div class="input-group mb-2">
                <textarea name="content" class="form-control" aria-describedby="basic-addon2" placeholder="What happening?" required></textarea>
            </div>

            <div class="row default" style="margin-right: -15px;margin-left: -15px;">
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Tags</span>
                    </div>
                    <input type="text" name="tags" class="form-control" placeholder="#news, #games, #angular" aria-label="#news, #games, #angular" aria-describedby="basic-addon1">
                </div>
                <div class="col-3" style="padding-left: 0;margin-left: -5px;">
                    <button type="submit" name="post_submit" class="btn btn-primary btn-block">Post it</button>
                </div>
            </div>

        </form>
    </div>
<?}


} //окончание класса draw
?> 
