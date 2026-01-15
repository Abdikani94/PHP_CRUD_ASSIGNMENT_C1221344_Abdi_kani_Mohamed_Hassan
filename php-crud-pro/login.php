<?php
require __DIR__ . "/config.php";
require __DIR__ . "/assets/helpers.php";

if (is_logged_in()) {
  header("Location: index.php");
  exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST["username"] ?? "");
  $password = (string)($_POST["password"] ?? "");

  $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
  $stmt->execute([$username]);
  $admin = $stmt->fetch();

  if ($admin && password_verify($password, $admin["password_hash"])) {
    $_SESSION["admin_id"] = $admin["id"];
    $_SESSION["admin_username"] = $admin["username"];
    set_flash("success", "Welcome back, {$admin["username"]}!");
    header("Location: index.php");
    exit;
  }

  $error = "Invalid username or password.";
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login</title>
</head>
<body class="bg-slate-100">
  <div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white rounded-2xl shadow p-6">
      <h1 class="text-2xl font-bold mb-1">Admin Login</h1>
      <p class="text-slate-600 mb-6">Use your admin credentials</p>

      <?php if ($error): ?>
        <div class="mb-4 p-3 rounded bg-red-100 text-red-700"><?= e($error) ?></div>
      <?php endif; ?>

      <form method="POST" class="space-y-4">
        <div>
          <label class="block mb-1 font-medium">Username</label>
          <input name="username" class="w-full px-4 py-2 rounded-lg border border-slate-300" required>
        </div>
        <div>
          <label class="block mb-1 font-medium">Password</label>
          <input name="password" type="password" class="w-full px-4 py-2 rounded-lg border border-slate-300" required>
        </div>
        <button class="w-full px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
