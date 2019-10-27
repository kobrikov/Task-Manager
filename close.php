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

if (!isset($_GET['id'])) {
  http_response_code(404);
  exit();
}

if ($link) {
  $task = htmlspecialchars($_GET['id'], ENT_QUOTES);
  $sql = close_task();
  $stmt = db_get_prepare_stmt($link, $sql, [4, "done", $task, $is_auth['id']]);
  $res = mysqli_stmt_execute($stmt);
  if ($res) {
    header("Location: tasks.php?category=active ");
  }
}
