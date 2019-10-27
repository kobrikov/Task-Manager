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
    <header class="page-header">
      <div class="page-header__inner">
        <nav class="main-nav">
          <ul class="main-nav__list">
            <li class="main-nav__item"><a class="main-nav__link" href="add.php" title="Создать задачу">+</a></li>
            <li class="main-nav__item"><a class="main-nav__link"><?=$_SESSION['name'];?></a></li>
            <li class="main-nav__item"><a class="main-nav__link" href="logout.php">Выйти</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <section class="add">
      <div class="add__inner add__inner--create">
        <h1>Task Manager</h1>
        <p>Создание задачи</p>
        <div class="auth__form">

          <form class="form" method="post" enctype="multipart/form-data" action="add.php" autocomplete="off">
            <div class="auth__fieldset">
              <div class="auth__column">
                <label for="name">Название</label>
                <? if(!empty($values['name'])): ?>
                <span class="auth_error"><?=$values['name'];?></span>
                <? endif ?>
                <input id="name" type="text" name="name" placeholder="Введите название задачи" required>

                <label for="datetime">Срок выполнения</label>
                <? if(!empty($values['datetime'])): ?>
                <span class="auth_error"><?=$values['datetime'];?></span>
                <? endif ?>
                <input id="datetime" type="datetime-local" name="datetime" placeholder="Выберите дату выполнения задачи" required>

                <label for="priority">Приоритет</label>
                <? if(!empty($values['priority'])): ?>
                <span class="auth_error"><?=$values['priority'];?></span>
                <? endif ?>
                <select id="priority" name="priority">
                  <?php foreach ($data as $key => $value): ?>
                    <?php $selected = ($value == end($data)) ? "selected" : "";?>
                    <option <?=$selected;?>><?=$value['p_name']?></option>
                  <?php endforeach; ?>
                </select>

                <label for="desc">Описание</label>
                <textarea id="desc" name="desc"></textarea>

                <button class="button" type="submit">Создать задачу</button>
                <a class="button" href="tasks.php?category=active">Отмена</a>
              </div>
            </div>
          </form>
        </div>

      </div>
    </section>
	</body>
</html>
