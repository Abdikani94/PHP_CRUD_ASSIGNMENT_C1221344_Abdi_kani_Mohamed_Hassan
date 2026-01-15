<?php
require __DIR__ . "/auth.php";

$id = (int)($_GET["id"] ?? 0);
if ($id > 0) {
  $pdo->prepare("DELETE FROM students WHERE id=?")->execute([$id]);
}

set_flash("success", "Student deleted.");
header("Location: index.php");
exit;
