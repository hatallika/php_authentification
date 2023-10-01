<div class="menu">
    <a href="/">Главная</a>
    <a href="/user/profile/?id=<?= $_SESSION['id'] ?>">Профиль</a>
    <?php if ($isAuth): ?>
        Вы вошли как, <?= $username ?>
        <a href="/auth/logout">[Выход]</a>
    <?php else: ?>
    <a href="/user/login">Войти</a><br>
    <?php endif;?>
</div>

