<?php $url = explode('?',$_SERVER["REQUEST_URI"])[0];?>
<nav class="nav">
    <div class="nav__wrapper">
        <ul class="nav__menu-list">
            <li class="nav__menu-item <?php echo ($url == '/') ? "nav__menu-item--active":""?>">
                <a class="nav__menu-href" href="/">Главная</a>
            </li>
            <li class="nav__menu-item <?php echo ($url == '/user/profile/') ? "nav__menu-item--active":""?>">
                <a class="nav__menu-href " href="/user/profile/?id=<?= $_SESSION['id'] ?>">Профиль</a>
            </li>
            <li class="nav__menu-item <?php echo (
                $url == '/user/logout/'
                || $url =='/user/login'
                || $url =='/user/register'
            )
                ? "nav__menu-item--active":""?>">
                <?php if ($isAuth): ?>

                <?php else: ?>
                    <a class="nav__menu-href" href="/user/login">Войти</a><br>
                <?php endif;?>
            </li>
        </ul>
        <div class="header__user">
            <?php if ($isAuth):?>
                <div class="nav__menu-item nav__menu-item--user">
                    Вы вошли как, <?= $username ?>
                </div>
                <div class="nav__menu-item">
                    <a class="nav__menu-href" href="/auth/logout">[Выход]</a>
                </div>
            <?php endif;?>
        </div>

    </div>


</nav>

