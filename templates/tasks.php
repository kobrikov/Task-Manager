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
    <section class="tasks">
      <div class="tasks__inner">
        <h1>Task Manager</h1>
        <nav class="select-nav">
          <ul class="select-nav__list">
            <?php foreach ($values as $i => $select): ?>
              <?php $class_name = ($_GET['category'] === $select['alias']) ? "select-nav__link--current" : "";?>
                <li class="select-nav__item">
                  <a class="select-nav__link <?=$class_name; ?>" href="tasks.php?category=<?=$select['alias'];?>"><?=$select['name'];?></a>
                </li>
            <?php endforeach; ?>
          </ul>
        </nav>
        <?php if (empty($data)): ?>
        <p>Список задач пуст.</p>
        <?php else: ?>
          <?php foreach ($data as $key => $val): ?>
            <div class="tasks__item">
              <div class="tasks__id">
              </div>
              <div class="tasks__title">
                <p class="tasks__name"><?=$val['t_name']; ?></p>
                <p class="tasks__desc"><?=$val['t_desc']; ?></p>
                  <div class="tasks__extra">
                    <span class="tasks__time">Срок выполнения: <?=$val['t_time']; ?></span>
                    <span class="tasks__priority">Приоритет: <?=$val['p_name']; ?></span>
                  </div>
              </div>
              <div class="tasks__status">
                <span><?=$val['s_name']; ?></span>
              </div>
              <?php if ($val['t_state'] !== "done"): ?>
              <div class="tasks__change">
                <a class="tasks__edit" href="task.php?id=<?=$val['id'];?>">Открыть</a>
                <a class="tasks__del" href="close.php?id=<?=$val['id'];?>">Завершить</a>
              </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>
	</body>
</html>
