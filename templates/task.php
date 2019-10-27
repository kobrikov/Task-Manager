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
    <section class="task">
      <div class="task__inner task__inner--create">
        <h1>Task Manager</h1>
        <p>Просмотр задачи</p>
        <div class="auth__form">
          <form class="form" method="post" enctype="multipart/form-data" action="update.php?id=<?=$data['id']?>" autocomplete="off">
            <div class="auth__fieldset">
              <div class="auth__column">

                <label for="name">Дата регистрации</label>
                <input id="name" type="text" name="name" value="<?=date_print($data['t_reg']);?>" disabled>

                <label for="name">Название</label>
                <input id="name" type="text" name="name" placeholder="Введите название задачи" value="<?=$data['t_name'];?>" required>

                <label for="datetime">Срок выполнения</label>
                <input id="datetime" type="datetime-local" name="datetime" placeholder="Выберите дату выполнения задачи" value="<?=date_local_print($data['t_time']);?>" required>

                <label for="priority">Приоритет</label>
                <select id="priority" name="priority">
                  <?php foreach ($values2 as $key => $value): ?>
                    <?php $selected = ($value['p_name'] === $data['p_name']) ? "selected" : "";?>
                    <option <?=$selected;?>><?=$value['p_name']?></option>
                    <?php endforeach; ?>
                </select>

                <label for="status">Статус</label>
                <select id="status" name="status">
                  <?php foreach ($values as $key => $value): ?>
                    <?php $selected = ($value['s_name'] === $data['s_name']) ? "selected" : "";?>
                    <option <?=$selected;?>><?=$value['s_name']?></option>
                  <?php endforeach; ?>
                </select>

                <label for="desc">Описание</label>
                <textarea id="desc" name="desc"><?=$data['t_desc'];?></textarea>

                <button class="button" type="submit">ОК</button>
                <a class="button" href="tasks.php?category=active">Отмена</a>
              </div>
            </div>
          </form>
        </div>

      </div>
    </section>
	</body>
</html>
