<?php
session_start();

// Fields and their default values
$old = [
    'name'       => '',
    'email'      => '',
    'phone'      => '',
    'summary'    => '',
    'education'  => '',
    'experience' => '',
    'skills'     => '',
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    // --- Name ---
    if ($old['name'] === '') {
        $errors['name'] = 'Name is required.';
    } elseif (!preg_match('/^[a-zA-Z\s.\'-]+$/', $old['name'])) {
        $errors['name'] = 'Name must contain letters only.';
    }

    // --- Email ---
    if ($old['email'] === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // --- Phone ---
    if ($old['phone'] === '') {
        $errors['phone'] = 'Phone number is required.';
    } elseif (!preg_match('/^[0-9+\-\s]{7,15}$/', $old['phone'])) {
        $errors['phone'] = 'Phone number must be 7-15 digits (numbers, spaces, +, - only).';
    }

    // --- Summary ---
    if ($old['summary'] === '') {
        $errors['summary'] = 'Summary is required.';
    } elseif (strlen($old['summary']) < 20) {
        $errors['summary'] = 'Summary must be at least 20 characters long.';
    }

    // --- Education ---
    if ($old['education'] === '') {
        $errors['education'] = 'Education is required.';
    }

    // --- Experience ---
    if ($old['experience'] === '') {
        $errors['experience'] = 'Experience is required.';
    }

    // --- Skills ---
    if ($old['skills'] === '') {
        $errors['skills'] = 'Skills are required.';
    } elseif (!preg_match('/^[a-zA-Z0-9\s,.+#-]+$/', $old['skills'])) {
        $errors['skills'] = 'Skills must only contain letters, numbers, and commas.';
    }

    // If no errors, save to session and go to resume page
    if (empty($errors)) {
        $_SESSION['resume'] = $old;
        header('Location: resume.php');
        exit;
    }
}

function old_val($old, $key) {
    return htmlspecialchars($old[$key], ENT_QUOTES);
}
function show_error($errors, $key) {
    if (!empty($errors[$key])) {
        echo '<span class="error">' . htmlspecialchars($errors[$key], ENT_QUOTES) . '</span>';
    }
}
function field_class($errors, $key) {
    return !empty($errors[$key]) ? 'invalid' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Resume Form</title>
<style>
    :root {
        --primary: #2b3a55;
        --accent: #3b6ef6;
        --border: #d7dce3;
        --error: #d93025;
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
    .card {
        max-width: 640px;
        margin: 0 auto;
        background: #fff;
        border-radius: 8px;
        padding: 36px 42px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        border: 1px solid var(--border);
    }
    h1 {
        font-size: 22px;
        color: var(--primary);
        margin: 0 0 4px;
    }
    .subtitle {
        color: #6b7280;
        font-size: 14px;
        margin: 0 0 28px;
    }
    .field {
        margin-bottom: 20px;
    }
    label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 6px;
    }
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--border);
        border-radius: 5px;
        font-size: 14px;
        font-family: inherit;
        background: #fbfcfd;
    }
    input:focus, textarea:focus {
        outline: none;
        border-color: var(--accent);
        background: #fff;
    }
    input.invalid, textarea.invalid {
        border-color: var(--error);
        background: #fff6f6;
    }
    textarea {
        resize: vertical;
        min-height: 70px;
    }
    .error {
        display: block;
        color: var(--error);
        font-size: 12.5px;
        margin-top: 5px;
    }
    button {
        width: 100%;
        padding: 12px;
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 8px;
    }
    button:hover {
        background: #2f5ed6;
    }
</style>
</head>
<body>
<div class="card">
    <h1>Build Your Resume</h1>
    <p class="subtitle">All fields are required. Errors are validated on the server.</p>

    <form action="index.php" method="POST" novalidate>

        <div class="field">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" class="<?= field_class($errors, 'name') ?>" value="<?= old_val($old, 'name') ?>">
            <?php show_error($errors, 'name'); ?>
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="<?= field_class($errors, 'email') ?>" value="<?= old_val($old, 'email') ?>">
            <?php show_error($errors, 'email'); ?>
        </div>

        <div class="field">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" class="<?= field_class($errors, 'phone') ?>" value="<?= old_val($old, 'phone') ?>">
            <?php show_error($errors, 'phone'); ?>
        </div>

        <div class="field">
            <label for="summary">Professional Summary</label>
            <textarea id="summary" name="summary" class="<?= field_class($errors, 'summary') ?>"><?= old_val($old, 'summary') ?></textarea>
            <?php show_error($errors, 'summary'); ?>
        </div>

        <div class="field">
            <label for="education">Education</label>
            <textarea id="education" name="education" class="<?= field_class($errors, 'education') ?>"><?= old_val($old, 'education') ?></textarea>
            <?php show_error($errors, 'education'); ?>
        </div>

        <div class="field">
            <label for="experience">Work Experience</label>
            <textarea id="experience" name="experience" class="<?= field_class($errors, 'experience') ?>"><?= old_val($old, 'experience') ?></textarea>
            <?php show_error($errors, 'experience'); ?>
        </div>

        <div class="field">
            <label for="skills">Skills (comma separated)</label>
            <input type="text" id="skills" name="skills" class="<?= field_class($errors, 'skills') ?>" value="<?= old_val($old, 'skills') ?>">
            <?php show_error($errors, 'skills'); ?>
        </div>

        <button type="submit">Generate Resume</button>
    </form>
</div>
</body>
</html>
