<!DOCTYPE html>
<h lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" defer src="../Js/game.js"></script>
</head>
<?php require('partials/Navbar.php') ?>
    <?php require('partials/theme.php') ?>

    <div class="d-flex justify-content-center align-items-center full-height pt-5 mt-5">
        <div class="card text-light" style="width: 500px; background: #121212;">
            <div class="card-body "> <!-- Added text-center for centering content -->
            <div id="text" class="m-3 h4 lead">TEST</div>
                <div class="container mt-5">
                    <div id="option-buttons" class="row ">
                        <div class="col-md-6 mb-4">
                            <button type="button" class="btn btn-secondary w-100">Button</button>
                        </div>
                        <div class="col-md-6 mb-4">
                            <button type="button" class="btn btn-secondary w-100">Button</button>
                        </div>
                        <div class="col-md-6 mb-4">
                            <button type="button" class="btn btn-secondary w-100">Button</button>
                        </div>
                        <div class="col-md-6 mb-4">
                            <button type="button" class="btn btn-secondary w-100">Button</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="d-flex justify-content-center align-items-center pt-2">
        <div class="card text-light" style="width: 500px; background: #121212;">
            <div class="card-body text-center"> <!-- Added text-center for centering content -->
            <div id="text" class="m-3 h3">Loading and Saving</div>
            <div class="container mt-5">
                <div class="row">
                <?php if (isset($_SESSION['user_roles'] ) ?? false) : ?>
                        <?php if ($_SESSION['user_roles'] === 'user') : ?>
                        <div class="col-md-6 mb-4">
                            <button id="save" type="button" class="btn btn-secondary w-100">Save</button>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <button id="load" type="button" class="btn btn-secondary w-100">Load</button>
                        </div>
                        <?php endif?>

                        <?php if ($_SESSION['user_roles'] === 'admin' ) : ?>
                            <div class="col-md-4 mb-4">
                                <button id="save" type="button" class="btn btn-secondary w-100">Save</button>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <button id="load" type="button" class="btn btn-secondary w-100">Load</button>
                            </div>

                            <div class="col-md-4 mb-4">
                                <button id="AdminLoad" type="button" class="btn btn-secondary w-100">AdminLoad</button>
                            </div>
                        <?php endif; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>