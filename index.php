<?php

require_once 'config.php';
require_once 'init.php';
require_once 'functions.php';
require_once 'db_functions.php';
require_once 'mysql_helper.php';

$errors = [];
$auth = [];
$check_pass = false;

$is_auth = check_auth();

if ($is_auth['is_auth']) {
    header("Location: tasks.php ");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth = $_POST;
    foreach ($auth as $key => $value) {
        $auth[$key] = htmlspecialchars($value, ENT_QUOTES);
    }
    $required = ['email', 'password'];
    foreach ($required as $field) {
        if (empty($auth[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    if (empty($errors)) {
        if (filter_var($auth['email'], FILTER_VALIDATE_EMAIL)) {
            $sql_user = check_email();
            $stmt = db_get_prepare_stmt($link, $sql_user, [$auth['email']]);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
            if (!empty($rows[0])) {
                foreach ($rows[0] as $key => $value) {
                    $rows[0][$key] = htmlspecialchars($value, ENT_QUOTES);
                }
                $check_pass = password_verify($auth['password'], $rows[0]['u_password']);
            }
            if (!$check_pass) {
                $errors['form'] = 'Пользователь не найден';
            } else {
                $_SESSION['email'] = $auth['email'];
                $_SESSION['id'] = $rows[0]['id'];
                $_SESSION['name'] = $rows[0]['u_name'];
                header("Location: /projects/taskmanager/tasks.php?category=active ");
            }
        } else {
            $errors['email'] = 'Введите корректный email';
        }
    }
}

$output = render_template('index', $errors, $auth);
print($output);
