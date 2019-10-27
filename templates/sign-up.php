<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Evgeniy Kobrikov">
    <meta name="keywords" content="task, manager">
    <meta name="description" content="Task Manager project">
    <title>TaskManager</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <section class="signup">
      <div class="signup__inner">
        <h1>Task Manager</h1>
        <p>Регистрация пользователя</p>
        <div class="auth__form">

          <form class="form" method="post" enctype="multipart/form-data" action="sign-up.php" autocomplete="off">
            <div class="auth__fieldset">
              <div class="auth__column">
                <label for="email">E-mail</label>
                <? if(!empty($data['email'])): ?>
                <span class="auth_error"><?=$data['email'];?></span>
                <? endif ?>
                <? $value = isset($values['email']) ? $values['email'] : ""; ?>
                <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$value; ?>" required>

                <label for="name">Имя</label>
                <? if(!empty($data['name'])): ?>
                <span class="auth_error"><?=$data['name'];?></span>
                <? endif ?>
                <? $value = isset($values['name']) ? $values['name'] : ""; ?>
                <input id="name" type="text" name="name" placeholder="Введите имя пользователя" value="<?=$value; ?>" required>

                <label for="password">Пароль</label>
                <? if(!empty($data['password'])): ?>
                <span class="auth_error"><?=$data['password'];?></span>
                <? endif ?>
                <? $value = isset($values['password']) ? $values['password'] : ""; ?>
                <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?=$value; ?>" required>

                <button class="button" type="submit">Зарегистрироваться</button>
                <a class="auth__btn" href="index.php">На главную</a>
              </div>
            </div>
          </form>
        </div>

      </div>
    </section>
	</body>
</html>
