<div id="heading">
    <h1>Авторизация</h1>
</div>

<div class="auth">
    <?php if (!$auth): ?>

        <p>Пожалуйста, авторизуйтесь</p>
        <div class="auth__message <?=(!$message_auth)?'auth__message--none':''?>">
            <?=$message_auth ?>
        </div>

        <form method="post" action="/auth/login">
            <p><input type="text" name="login" placeholder="login"></p>
            <p><input type="password" name="pass" placeholder="password"></p>
            Save? <input type="checkbox" name="save">
            <div class="auth__captcha">
                <div
                        id="captcha-container"
                        class="smart-captcha"
                        data-sitekey="<?=USER_KEY?>"
                ></div>
            </div>

            <p><input type="submit" name="ok"></p>

        </form>
        Еще нет аккаунта? <a href="/user/register">Регистрация</a>
    <?php endif; ?>
</div>
