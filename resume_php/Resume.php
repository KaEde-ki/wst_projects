<?php
function e($v) { return htmlspecialchars($v ?? '', ENT_QUOTES); }

$name       = e($_POST['name'] ?? '');
$email      = e($_POST['email'] ?? '');
$phone      = e($_POST['phone'] ?? '');
$summary    = e($_POST['summary'] ?? '');
$education  = e($_POST['education'] ?? '');
$experience = e($_POST['experience'] ?? '');
$skills     = e($_POST['skills'] ?? '');

if (!$name) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html>
<head>
<title><?= $name ?> - Resume</title>
<style>
  body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; }
  h1 { margin-bottom: 0; }
  .contact { color: #555; margin-bottom: 20px; }
  h3 { border-bottom: 1px solid #ccc; padding-bottom: 4px; }
  p { white-space: pre-line; }
</style>
</head>
<body>
  <h1><?= $name ?></h1>
  <p class="contact"><?= $email ?> <?= $phone ? ' | '.$phone : '' ?></p>

  <?php if ($summary): ?><h3>Summary</h3><p><?= $summary ?></p><?php endif; ?>
  <?php if ($experience): ?><h3>Experience</h3><p><?= $experience ?></p><?php endif; ?>
  <?php if ($education): ?><h3>Education</h3><p><?= $education ?></p><?php endif; ?>
  <?php if ($skills): ?><h3>Skills</h3><p><?= $skills ?></p><?php endif; ?>

  <p><a href="index.php">&larr; Edit</a></p>
</body>
</html>