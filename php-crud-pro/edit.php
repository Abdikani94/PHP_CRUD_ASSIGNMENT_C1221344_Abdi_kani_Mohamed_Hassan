<?php
require __DIR__ . "/auth.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
  header("Location: index.php");
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if (!$student) {
  header("Location: index.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name  = trim($_POST["name"] ?? "");
  $email = trim($_POST["email"] ?? "");
  $phone = trim($_POST["phone"] ?? "");

  if ($name === "" || $email === "" || $phone === "") {
    set_flash("error", "All fields are required.");
    header("Location: edit.php?id=" . $id);
    exit;
  }

  $up = $pdo->prepare(
    "UPDATE students SET name=?, email=?, phone=? WHERE id=?"
  );
  $up->execute([$name, $email, $phone, $id]);

  set_flash("success", "Student updated successfully.");
  header("Location: index.php");
  exit;
}

$flash = get_flash();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Edit Student</title>
</head>
<body class="bg-slate-100">
<div class="max-w-xl mx-auto p-6">
  <a href="index.php" class="text-blue-600">&larr; Back</a>

  <?php if ($flash): ?>
    <div class="p-3 my-4 bg-red-100 text-red-700"><?= e($flash["message"]) ?></div>
  <?php endif; ?>

  <form method="POST" class="bg-white p-6 rounded shadow space-y-4">
    <input name="name" value="<?= e($student["name"]) ?>" class="w-full border p-2 rounded" required>
    <input name="email" value="<?= e($student["email"]) ?>" class="w-full border p-2 rounded" required>
    <input name="phone" value="<?= e($student["phone"]) ?>" class="w-full border p-2 rounded" required>
    <button class="bg-amber-600 text-white px-4 py-2 rounded">Update</button>
  </form>
</div>
</body>
</html>
