<?php

function render_template($tpl, $data = [], $values = [], $values2 = []) {
  require 'config.php';
  $path = $config['tpl_path'] . $tpl . '.php';
  if (!file_exists($path)) {
    return '';
  }
  extract($data, EXTR_PREFIX_SAME, "d_");
  extract($values, EXTR_PREFIX_SAME, "d_");
  extract($values2, EXTR_PREFIX_SAME, "d_");
  ob_start();
  require_once "$path";
  return ob_get_clean();
}

function check_auth() {
  $data = [];
  $data['is_auth'] = false;
  if (isset($_SESSION['id'])) {
    $data['is_auth'] = true;
    $data['id'] = $_SESSION['id'];
    $data['user_name'] = $_SESSION['name'];
  }
  return $data;
}

function date_print($dt) {
  return date("d.m.Y H:i", strtotime($dt));
}

function date_local_print($dt) {
  return date("Y-m-d\TH:i", strtotime($dt));
}
