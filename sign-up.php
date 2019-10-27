<?php

require_once 'config.php';
require_once 'init.php';
require_once 'functions.php';
require_once 'db_functions.php';
require_once 'mysql_helper.php';

$is_auth = check_auth();

if ($is_auth['is_auth']) {
  header("Location: tasks.php ");
  exit();
}

$errors = [];
$new_user = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_user = $_POST;
  foreach ($new_user as $key => $value) {
    $new_user[$key] = htmlspecialchars($value, ENT_QUOTES);
  }

  $required = ['email', 'name', 'password'];

  foreach ($required as $field) {
    if (empty($new_user[$field])) {
      $errors[$field] = 'Поле не заполнено';
      continue;
    }
    if ($field == 'email') {
      if (filter_var($new_user[$field], FILTER_VALIDATE_EMAIL)) {
        $sql_user = check_email();
        $stmt = db_get_prepare_stmt($link, $sql_user, [$new_user[$field]]);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
        if (!empty($rows[0])) {
          $errors[$field] = 'Такой email уже зарегистрирован';
        }
      } else {
        $errors[$field] = 'Введите корректный email';
      }
    }
  }

  if (empty($errors)) {
    $new_user['hash'] = password_hash($new_user['password'], PASSWORD_DEFAULT);
    $sql = post_user();
    $stmt = db_get_prepare_stmt($link, $sql, [$new_user['email'], $new_user['name'], $new_user['hash']]);
    $res = mysqli_stmt_execute($stmt);
    if ($res) {
      header("Location: index.php ");
    }
  }
}

$output = render_template('sign-up', $errors, $new_user);
print($output);
