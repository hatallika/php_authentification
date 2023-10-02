<div id="heading">
    <h1>Регистрация</h1>
</div>
<form method="post" action="/user/create">

    <div class="form-group">
        <div class="reg_form__message <?=($_SESSION['register_err']['user']['login'])
            ?''
            :'reg_form__message--none'?>"
        >
            <?=$_SESSION['register_err']['user']['login']?>
        </div>
        <input type="text" class="form-control" name="login" value="<?=$oldLogin?>" placeholder="Имя пользователя"
               required>
    </div>

    <div class="form-group">
        <div class="reg_form__message <?=($_SESSION['register_err']['user']['email'])
            ? ''
            : 'reg_form__message--none'?>"
        >
            <?= $_SESSION['register_err']['user']['email']?>
        </div>

        <input type="email" class="form-control" name="email" value="<?=$oldEmail?>"placeholder="Адрес почты"
               required >
    </div>

    <div class="form-group">
        <div class="reg_form__message <?=($_SESSION['register_err']['user']['phone'])
            ? ''
            : 'reg_form__message--none'?>"
        >
            <?= $_SESSION['register_err']['user']['phone']?>
        </div>

        <input type="phone" class="form-control" name="phone" value="<?=$oldPhone?>"placeholder="Номер телефона"
               required >
    </div>

    <div class="form-group">
        <div class="reg_form__message <?=($_SESSION['register_err']['password'])
            ? ''
            : 'reg_form__message--none'?>"
        >
            <?=$_SESSION['register_err']['password']?>
        </div>

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
