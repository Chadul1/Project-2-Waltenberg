<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

    <?php require('partials/Navbar.php') ?>
        <?php require('partials/theme.php') ?>
        <div class="container mt-5 pt-5">
            <h1>Welcome to the game. </h1>
            <p>
                To start, you will need to login. If you don't have account, you can register one in the top right.
                You will be able to begin the game once you have logged in.
            </p>
            <?php if (isset($_SESSION['user_roles']) ?? false) : ?>
                
                <h1><a href="/Project-2-Waltenberg/public/game" class="link-danger" style="text-decoration: none;">Begin the Game</a></h1>

            <?php endif; ?>
        </div> 
    </body> 
</html>
