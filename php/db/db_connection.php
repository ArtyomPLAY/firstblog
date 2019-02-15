<?php

require $_SERVER['DOCUMENT_ROOT']."/libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=blog',
        'root', 'root' ); 
//проверка коннекта
//mail("csgo2507@mail.ru", "My Subject", "Line 1\nLine 2\nLine 3");
//$isConnected = R::testConnection();
//echo $isConnected;


session_start();
date_default_timezone_set('Europe/Moscow');

function post_drawer($post,$user){ ?>
        <div class="post">
                    <div class="post-author">
                        <img src="<?php if($user->avatar) echo $user->avatar; else echo 'content/none_avatar.png'; ?>" alt="Author's avatar">
                        <div>
                            <span>
                                <a href="user.php<?echo '?id=',$user->id?>"> 
                                <?php echo $user->login; ?>
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
                                <svg class="like" viewBox="0 0 28 26"  xmlns="http://www.w3.org/2000/svg">
                                <path d="M26.1356 5.57005C23.9645 -1.44319 16.2583 0.93319 14.1162 4.00875C11.9741 0.93319 4.03044 -1.44282 1.85928 5.57042C-0.997116 14.7971 14.1162 24 14.1162 24C14.1162 24 28.992 14.7967 26.1356 5.57005Z"/>
                                </svg>
                                <? if($post->likes!=0) echo '<p>',$post->likes,'</p>';?>
                            </div>
                            <div class="social-btn">
                                <svg class="repost" viewBox="0 0 23 19" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.9118 17L18.2347 17.736L18.9764 18.4182L19.6529 17.6714L18.9118 17ZM4.70588 2L5.447 1.32863L4.70588 0.510508L3.96476 1.32863L4.70588 2ZM10.2647 3H15.9118V1H10.2647V3ZM17.9118 5V17H19.9118V5H17.9118ZM19.5888 16.264L15.8829 12.8549L14.5289 14.3269L18.2347 17.736L19.5888 16.264ZM19.6529 17.6714L22.7411 14.2623L21.2589 12.9195L18.1706 16.3286L19.6529 17.6714ZM13.3529 16H7.70588V18H13.3529V16ZM5.70588 14V2H3.70588V14H5.70588ZM3.96476 1.32863L0.258877 5.41954L1.74112 6.76228L5.447 2.67137L3.96476 1.32863ZM3.96476 2.67137L7.67064 6.76228L9.15289 5.41954L5.447 1.32863L3.96476 2.67137ZM7.70588 16C6.60131 16 5.70588 15.1046 5.70588 14H3.70588C3.70588 16.2091 5.49674 18 7.70588 18V16ZM15.9118 3C17.0163 3 17.9118 3.89543 17.9118 5H19.9118C19.9118 2.79086 18.1209 1 15.9118 1V3Z" fill="#BABDC8"/>
                                </svg>
                                <? if($post->reposts!=0) echo '<p>', $post->reposts, '</p>';?>
                            </div>
                            <div class="social-btn">
                                <svg class="comments" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8571 1H6.14286C2.14286 1 1 5 1 6.71429C1 11.2857 5.38095 12.4286 7.85714 12.4286V17C13.5714 12.4286 17 11.2857 17 6.71429C17 3.85714 15.8571 1 11.8571 1Z"/>
                                </svg>
                                <? if($post->comments!=0) echo '<p>', $post->comments,'</p>';?>
                            </div>

                        </div>
                        <div class="tags">
                            <h4>Tags: <? if(isset($post->tags)) echo $post->tags ?></h4>
                        </div>     
                    </div>
                </div> 
<?}

function sidebar_drawer(){ ?>
                    <? if(isset($_SESSION['logged_user'])): 
                    include $_SERVER['DOCUMENT_ROOT'] . "/php/components/post_form.php";?>
                    <button class="postwr">Write Post</button>
                    <? endif ?>
                    <ul class="threads">
                        <p>Threads</p>
                        <li>World</li>
                        <li>Games</li>
                        <li>IT</li>
                        <li>Social</li>
                    </ul>
<? } ?>