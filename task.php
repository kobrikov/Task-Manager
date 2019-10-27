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
  $sql_status = get_status();
  $status = get_data($link, $sql_status);

  $sql_priority = get_priority();
  $priority = get_data($link, $sql_priority);

  $task_id = htmlspecialchars($_GET['id'], ENT_QUOTES);
  $sql = get_task_for_id();
  $stmt = db_get_prepare_stmt($link, $sql, [$is_auth['id'], $task_id]);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  $task = mysqli_fetch_all($res, MYSQLI_ASSOC);
}

foreach ($task as $i => $array) {
  foreach ($array as $key => &$value) {
    if (is_string($value)) {
      $one_task[$key] = htmlspecialchars($value, ENT_QUOTES);
    }
  }
}

if ($one_task['t_state'] == "done") {
  http_response_code(404);
  exit();
};

$one_task['id'] = $task_id;
$output = render_template('task', $one_task, $status, $priority);
print($output);
