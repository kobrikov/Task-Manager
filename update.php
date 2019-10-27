<?php

require_once 'config.php';
require_once 'init.php';
require_once 'functions.php';
require_once 'db_functions.php';
require_once 'mysql_helper.php';

$is_auth = check_auth();
$errors = [];
$update_task = [];

if (!$is_auth['is_auth']) {
  http_response_code(403);
  exit();
}

if (!isset($_GET['id'])) {
  http_response_code(404);
  exit();
}

$sql_status = get_status();
$status = get_data($link, $sql_status);

$sql_priority = get_priority();
$priority = get_data($link, $sql_priority);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $update_task = $_POST;
  foreach ($update_task as $key => $value) {
    $update_task[$key] = htmlspecialchars($value, ENT_QUOTES);
  }

  $required = ['name', 'datetime', 'priority', 'status'];

  foreach ($required as $field) {
    if (empty($update_task[$field])) {
      $errors[$field] = 'Поле не заполнено';
      continue;
    }
  }

  foreach ($priority as $key => $value) {
    if ($value['p_name'] === $update_task['priority']) {
      $update_task['priority_id'] = $value['id'];
    }
  }

  foreach ($status as $key => $value) {
    if ($value['s_name'] === $update_task['status']) {
      $update_task['status_id'] = $value['id'];
      $update_task['state'] = ($update_task['status'] !== "Выполнена") ? "active" : "done";
    }
  }

  if (empty($errors)) {
    $task = htmlspecialchars($_GET['id'], ENT_QUOTES);
    $sql = update_task();
    $stmt = db_get_prepare_stmt($link, $sql, [$update_task['name'], $update_task['desc'], $update_task['datetime'], $update_task['state'], $update_task['status_id'], $update_task['priority_id'], $task, $is_auth['id']]);
    $res = mysqli_stmt_execute($stmt);
    if ($res) {
      header("Location: tasks.php?category=active ");
    }
  }
}
