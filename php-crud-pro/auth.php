<?php
require __DIR__ . "/config.php";
require __DIR__ . "/assets/helpers.php";

if (!is_logged_in()) {
  header("Location: login.php");
  exit;
}
