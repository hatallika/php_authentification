<h2> Профиль </h2>

<form method="post" action="/user/edit">
    <label>

        <?=$_SESSION['edit_err']['login']?>
        <input name="login" value="<?= $user->login ?>"/>
    </label>
    <button>Сохранить данные</button>
</form>

<form method="post" action="/user/edit">
    <label>

        <?=$errors['email']?>
        <input name="email" value="<?= $user->email ?>"/>
    </label>
    <button>Сохранить данные</button>
</form>

<form method="post" action="/user/edit">
    <label>

        <?=$errors['phone']?>
        <input name="phone" value="<?= $user->phone ?>"/>
    </label>
    <button>Сохранить данные</button>
</form>

<form method="post" action="/user/edit">
    <div class="form-group">

        <?=$errors['password']?>
        <input type="text" class="form-control" name="password" placeholder="Новый пароль"
               required >
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="password_confirmation"
               placeholder="Подтверждение пароля" required value="">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info text-white">Сохранить</button>
    </div>
</form>
