<?php

require_once 'config.php';
require_once 'init.php';
require_once 'functions.php';
require_once 'db_functions.php';
require_once 'mysql_helper.php';

$is_auth = check_auth();

if (!$is_auth['is_auth']) {
    http_response_code(403);
    exit();
  }

$errors = [];
$new_task = [];

$sql_priority = get_priority();
$priority = get_data($link, $sql_priority);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_task = $_POST;
  foreach ($new_task as $key => $value) {
    $new_task[$key] = htmlspecialchars($value, ENT_QUOTES);
  }

  $required = ['name', 'datetime', 'priority'];

  foreach ($required as $field) {
    if (empty($new_task[$field])) {
      $errors[$field] = 'Поле не заполнено';
      continue;
    }
  }

  foreach ($priority as $key => $value) {
    if ($value['p_name'] === $new_task['priority']) {
      $new_task['priority_id'] = $value['id'];
    }
  }

  if (empty($errors)) {
    $sql = post_task();
    $stmt = db_get_prepare_stmt($link, $sql, [$new_task['name'], $new_task['desc'], $new_task['datetime'], "active", $is_auth['id'], 1, $new_task['priority_id']]);
    $res = mysqli_stmt_execute($stmt);
    if ($res) {
      header("Location: tasks.php?category=active ");
    }
  }
}

$output = render_template('add', $priority, $errors);
print($output);
