<div id="heading">
    <h1>Профиль</h1>
</div>

<form method="post" action="/user/edit">
    <label>
        <div class="profile-form__message <?=$errors['login']?'':'profile-form__message--none'?>">
            <?=$errors['login']?>
        </div>
        <input type="text" name="login" value="<?= $user->login ?>"/>
    </label>
    <button>Сохранить данные</button>
</form>


<form method="post" action="/user/edit">
    <label>
        <div class="profile-form__message <?=$errors['email']?'':'profile-form__message--none'?>">
            <?=$errors['email']?>
        </div>

        <input name="email" type="text" value="<?= $user->email ?>"/>
    </label>
    <button>Сохранить данные</button>
</form>

<form method="post" action="/user/edit">
    <label>
        <div class="profile-form__message <?=$errors['phone']?'':'profile-form__message--none'?>">
            <?=$errors['phone']?>
        </div>

        <input type="text" name="phone" value="<?= $user->phone ?>"/>
    </label>
    <button>Сохранить данные</button>
</form>

<form method="post" action="/user/edit">
    <div class="form-group">
        <div class="profile-form__message <?=$errors['password']?'':'profile-form__message--none'?>">
            <?=$errors['password']?>
        </div>

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
