<?php
require __DIR__ . "/auth.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: index.php");
  exit;
}

$name  = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");

if ($name === "" || $email === "" || $phone === "") {
  set_flash("error", "All fields are required.");
  header("Location: index.php");
  exit;
}

$stmt = $pdo->prepare(
  "INSERT INTO students (name, email, phone) VALUES (?, ?, ?)"
);
$stmt->execute([$name, $email, $phone]);

set_flash("success", "Student added successfully.");
header("Location: index.php");
exit;
