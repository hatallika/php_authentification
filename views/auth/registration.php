<h1>Регистрация</h1>
<form method="post" action="/user/create">

    <div class="form-group">
        <?=$_SESSION['register_err']['user']['login']?>
        <input type="text" class="form-control" name="login" value="<?=$oldLogin?>" placeholder="Имя пользователя"
               required>
    </div>
    <div class="form-group">
        <?= $_SESSION['register_err']['user']['email']?>
        <input type="email" class="form-control" name="email" value="<?=$oldEmail?>"placeholder="Адрес почты"
               required >
    </div>
    <div class="form-group">
        <?= $_SESSION['register_err']['phone']?>
        <input type="phone" class="form-control" name="phone" value="<?=$oldPhone?>"placeholder="Номер телефона"
               required >
    </div>
    <div class="form-group">
        <?=$_SESSION['register_err']['password']?>
        <input type="text" class="form-control" name="password" placeholder="Придумайте пароль"
               required >
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="password_confirmation"
               placeholder="Пароль еще раз" required value="">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info text-white">Регистрация</button>
    </div>

</form>
