<?php
declare(strict_types=1);

function e(string $v): string {
  return htmlspecialchars($v, ENT_QUOTES, "UTF-8");
}

function set_flash(string $type, string $message): void {
  $_SESSION["flash"] = ["type" => $type, "message" => $message];
}

function get_flash(): ?array {
  if (!isset($_SESSION["flash"])) return null;
  $f = $_SESSION["flash"];
  unset($_SESSION["flash"]);
  return $f;
}

function is_logged_in(): bool {
  return isset($_SESSION["admin_id"]);
}

/**
 * Robust upload for Windows/XAMPP:
 * - JPG/PNG/WEBP only
 * - max 2MB
 * returns [filename|null, error|null]
 */
function upload_photo(array $file, string $uploadsDir): array {
  if (!isset($file["error"]) || is_array($file["error"])) {
    return [null, "Invalid upload data."];
  }

  if ($file["error"] === UPLOAD_ERR_NO_FILE) {
    return [null, "Photo is required. Please choose an image."];
  }

  if ($file["error"] !== UPLOAD_ERR_OK) {
    return [null, "Upload error code: " . $file["error"]];
  }

  if (($file["size"] ?? 0) > 2 * 1024 * 1024) {
    return [null, "File too large. Max 2MB."];
  }

  if (!is_dir($uploadsDir)) {
    if (!mkdir($uploadsDir, 0777, true)) {
      return [null, "Cannot create uploads folder."];
    }
  }

  $finfo = new finfo(FILEINFO_MIME_TYPE);
  $mime = $finfo->file($file["tmp_name"]);

  $allowed = [
    "image/jpeg" => "jpg",
    "image/png"  => "png",
    "image/webp" => "webp",
  ];

  if (!isset($allowed[$mime])) {
    return [null, "Only JPG/PNG/WEBP allowed. Detected: " . (string)$mime];
  }

  $ext = $allowed[$mime];
  $filename = "student_" . time() . "_" . bin2hex(random_bytes(4)) . "." . $ext;
  $target = rtrim($uploadsDir, "/\\") . DIRECTORY_SEPARATOR . $filename;

  if (!move_uploaded_file($file["tmp_name"], $target)) {
    return [null, "Failed to save the uploaded file. Check folder permissions."];
  }

  return [$filename, null];
}
