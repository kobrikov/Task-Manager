<?php

require_once 'config.php';
require_once 'init.php';
require_once 'functions.php';
require_once 'db_functions.php';
require_once 'mysql_helper.php';

$is_auth = check_auth();

$state = [
  [
    'name' => 'Активные',
    'alias' => 'active'
  ],
  [
    'name' => 'Завершенные',
    'alias' => 'done'
  ]
];

if (!$is_auth['is_auth']) {
  http_response_code(403);
  exit();
}

if (!isset($_GET['category'])) {
  http_response_code(404);
  exit();
}

if ($link) {
  $category = htmlspecialchars($_GET['category'], ENT_QUOTES);
  $sql = get_tasks_for_user();
  $stmt = db_get_prepare_stmt($link, $sql, [$is_auth['id'], $category]);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  $tasks = mysqli_fetch_all($res, MYSQLI_ASSOC);
}

foreach ($tasks as $i => $array) {
  foreach ($array as $key => &$value) {
    if (is_string($value)) {
      $tasks[$i][$key] = htmlspecialchars($value, ENT_QUOTES);
    }
  }
}

$output = render_template('tasks', $tasks, $state);
print($output);
