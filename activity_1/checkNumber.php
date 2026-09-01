<?php
if (isset($_GET['number']) && is_numeric($_GET['number'])) {
    $number = (int)$_GET['number'];

    echo "<h2>Number Checker</h2>";
    echo "<p>You entered: " . $number . "</p>";

    if ($number > 0) {
        echo "<p>The number is <strong>POSITIVE</strong>.</p>";

        if ($number % 2 == 0) {
            echo "<p>It is an <strong>EVEN</strong> number.</p>";
        } else {
            echo "<p>It is an <strong>ODD</strong> number.</p>";
        }
    } elseif ($number < 0) {
        echo "<p>The number is <strong>NEGATIVE</strong>.</p>";
    } else {
        echo "<p>The number is <strong>ZERO</strong>.</p>";
    }
} else {
    echo "<h2>Number Checker</h2>";
    echo "<p>Please provide a number in the URL, like this:</p>";
    echo "<code>checkNumber.php?number=5</code>";
}
?>
