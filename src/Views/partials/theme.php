<?php
// Check if the cookie for the background color is set and assign the value
$backgroundColorClass = isset($_COOKIE['backgroundColor']) ? htmlspecialchars($_COOKIE['backgroundColor']) : 'bg-light';
?>

<body id="body" class="<?php echo $backgroundColorClass; ?>">

<!-- JavaScript to change the background color and set a cookie -->
<script defer src="../JS/ThemeReloader.js"></script>

