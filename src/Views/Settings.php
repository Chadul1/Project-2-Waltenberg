<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php require('partials/Navbar.php') ?>
    <?php require('partials/theme.php') ?>
        <div class="container mt-5" style="padding-top: 80px;">
            <h1>Select a Background Theme</h1>
            <select id="dropdown" class="form-control">
                <option value="bg-light" <?php echo $backgroundColorClass == 'bg-light' ? 'selected' : ''; ?>>Light</option>
                <option value="bg-dark" <?php echo $backgroundColorClass == 'bg-dark' ? 'selected' : ''; ?>>Dark</option>
            </select>
        </div>
    </body>
</html>