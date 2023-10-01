<div class="auth">
    <?php if (!$auth): ?>

        <?= $message_auth ?>
        Пожалуйста авторизуйтесь
        <form method="post" action="/auth/login">
            <p><input type="text" name="login" placeholder="login"></p>
            <p><input type="password" name="pass" placeholder="password"></p>
            <div
                    id="captcha-container"
                    class="smart-captcha"
                    data-sitekey="ysc1_ePBs0btthD59DHqNt8xjvvA3Uv38TRQAVI7c5gkI86ea15e7"
            ></div>
            Save? <input type="checkbox" name="save">
            <p><input type="submit" name="ok"></p>

        </form>
        Еще нет аккаунта? <a href="/user/register">Регистрация</a>
    <?php endif; ?>
</div>
