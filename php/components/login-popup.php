
<link rel="stylesheet" href="css/login-popup.css">
<div id="login-wrap" style="display: none"></div>
    <div id="login-popup" style="display: none">
        <button onclick="show('none');" tabindex="5">x</button>
        <form action="php/login.php"  method="post">
            <h3>Log in</h3>
            <input type="text" placeholder="login" tabindex="1" required name="login">
            <input type="password" placeholder="password"
            tabindex="2" required name="password">
            <input type="submit" value="log in" tabindex="3" class="abot">
            <p><a tabindex="4">or sign up</a></p>
        </form>
    </div>