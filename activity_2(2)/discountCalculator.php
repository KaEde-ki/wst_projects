<?php

if (isset($_GET['total']) && is_numeric($_GET['total'])) {
    $total = (float)$_GET['total'];

    echo "<h2>Store Discount Calculator</h2>";

    if ($total < 0) {
        echo "<p>Please enter a valid (non-negative) amount.</p>";
    } else {
        // Determine discount rate based on cart total
        if ($total < 50) {
            $rate = 0;
        } elseif ($total <= 99.99) {
            $rate = 0.10;
        } elseif ($total <= 199.99) {
            $rate = 0.15;
        } else {
            $rate = 0.20;
        }

        $discountAmount = $total * $rate;
        $finalPrice = $total - $discountAmount;

        echo "<p>Original Price: P" . number_format($total, 2) . "</p>";
        echo "<p>Discount Rate: " . ($rate * 100) . "%</p>";
        echo "<p>Discount Amount: P" . number_format($discountAmount, 2) . "</p>";
        echo "<p><strong>Final Price: P" . number_format($finalPrice, 2) . "</strong></p>";
    }
} else {
    echo "<h2>Store Discount Calculator</h2>";
    echo "<p>Please provide a cart total in the URL, like this:</p>";
    echo "<code>discountCalculator.php?total=150</code>";
}

?>