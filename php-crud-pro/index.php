<?php
require __DIR__ . "/auth.php";
$flash = get_flash();

$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Students</title>
</head>
<body class="bg-slate-100">
<div class="max-w-5xl mx-auto p-6">

  <div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Students</h1>
    <div>
      <a href="logout.php" class="bg-slate-800 text-white px-3 py-2 rounded">Logout</a>
    </div>
  </div>

  <?php if ($flash): ?>
    <div class="p-3 mb-4 <?= $flash["type"] === "success" ? "bg-green-100 text-green-800" : "bg-red-100 text-red-800" ?>">
      <?= e($flash["message"]) ?>
    </div>
  <?php endif; ?>

  <!-- ADD FORM -->
  <form method="POST" action="create.php" class="bg-white p-4 rounded shadow mb-6 flex gap-2">
    <input name="name" placeholder="Name" class="border p-2 rounded w-full" required>
    <input name="email" placeholder="Email" class="border p-2 rounded w-full" required>
    <input name="phone" placeholder="Phone" class="border p-2 rounded w-full" required>
    <button class="bg-blue-600 text-white px-4 rounded">Add</button>
  </form>

  <!-- TABLE -->
  <table class="w-full bg-white rounded shadow">
    <thead class="bg-slate-900 text-white">
      <tr>
        <th class="p-2">Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php if (!$students): ?>
      <tr><td colspan="5" class="p-4 text-center">No records</td></tr>
    <?php endif; ?>

    <?php foreach ($students as $s): ?>
      <tr class="border-b">
        <td class="p-2"><?= e($s["name"]) ?></td>
        <td><?= e($s["email"]) ?></td>
        <td><?= e($s["phone"]) ?></td>
        <td><?= e($s["created_at"]) ?></td>
        <td class="p-2">
          <a href="edit.php?id=<?= $s["id"] ?>" class="text-amber-600">Edit</a>
          |
          <a href="delete.php?id=<?= $s["id"] ?>" class="text-red-600"
             onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
