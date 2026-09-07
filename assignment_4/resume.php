<?php
session_start();

// If no validated data exists, send back to the form
if (empty($_SESSION['resume'])) {
    header('Location: index.php');
    exit;
}

$data = $_SESSION['resume'];
function e($v) { return htmlspecialchars($v ?? '', ENT_QUOTES); }

$name       = e($data['name']);
$email      = e($data['email']);
$phone      = e($data['phone']);
$summary    = e($data['summary']);
$education  = e($data['education']);
$experience = e($data['experience']);
$skills     = array_filter(array_map('trim', explode(',', $data['skills'])));

// Clear session so refreshing doesn't resubmit
unset($_SESSION['resume']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $name ?> - Resume</title>
<style>
    :root {
        --primary: #2b3a55;
        --accent: #3b6ef6;
        --border: #d7dce3;
        --bg: #f4f6f9;
    }
    * { box-sizing: border-box; }
    body {
        font-family: 'Segoe UI', system-ui, Arial, sans-serif;
        background: var(--bg);
        margin: 0;
        padding: 40px 15px;
        color: #2c2c2c;
    }
    .resume {
        max-width: 700px;
        margin: 0 auto;
        background: #fff;
        border-radius: 8px;
        padding: 40px 46px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        border: 1px solid var(--border);
    }
    .header {
        border-bottom: 2px solid var(--accent);
        padding-bottom: 16px;
        margin-bottom: 24px;
    }
    .header h1 {
        margin: 0 0 6px;
        color: var(--primary);
        font-size: 26px;
    }
    .header .contact {
        color: #6b7280;
        font-size: 14px;
    }
    .section { margin-bottom: 22px; }
    .section h2 {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--accent);
        margin: 0 0 8px;
    }
    .section p {
        margin: 0;
        line-height: 1.6;
        color: #333;
        white-space: pre-line;
    }
    .skills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .skills span {
        background: #eaf0fe;
        color: var(--accent);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }
    .actions {
        max-width: 700px;
        margin: 18px auto 0;
        text-align: center;
    }
    .actions a, .actions button {
        display: inline-block;
        text-decoration: none;
        background: var(--accent);
        color: #fff;
        padding: 10px 22px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        margin: 0 5px;
    }
    .actions a.secondary {
        background: #6b7280;
    }
    @media print {
        .actions { display: none; }
        body { background: #fff; padding: 0; }
        .resume { box-shadow: none; border: none; }
    }
</style>
</head>
<body>

<div class="resume">
    <div class="header">
        <h1><?= $name ?></h1>
        <div class="contact"><?= $email ?> &nbsp;|&nbsp; <?= $phone ?></div>
    </div>

    <div class="section">
        <h2>Professional Summary</h2>
        <p><?= $summary ?></p>
    </div>

    <div class="section">
        <h2>Work Experience</h2>
        <p><?= $experience ?></p>
    </div>

    <div class="section">
        <h2>Education</h2>
        <p><?= $education ?></p>
    </div>

    <div class="section">
        <h2>Skills</h2>
        <div class="skills">
            <?php foreach ($skills as $skill): ?>
                <span><?= e($skill) ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="actions">
    <a href="index.php" class="secondary">&larr; Edit Details</a>
    <button onclick="window.print()">Print / Save as PDF</button>
</div>

</body>
</html>
