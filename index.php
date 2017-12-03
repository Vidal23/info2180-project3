<?PHP
require_once './inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CheapoMail</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <script type="text/javascript" src="assets/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="assets/script.js"></script>
    </head>
    <body>
        <div class="container">
            <div id="nav" style="clear: both;">
                <?PHP
                if ( varify_login() ) {
                    ?>
                    <a class="nav-item brand" onclick="loadPath(event, 'home.php')" href="#home.php">Cheapomail</a>
                    <div style="float: right;">
                        <a class="nav-item loadpath" href="#create_message.php">Compose Message</a> /
                        <a  class="nav-item loadpath" href="#create_user.php">Add User</a> /
                        <a  class="nav-item" href="logout.php">Logout</a>
                    </div>
                    <?PHP
                }
                ?>
            </div>
            <div class="wrapper">

                <div id="app">
                    <?php
                    if ( varify_login() ) {
                        include './partials/home.php';
                    }
                    else {
                        include './partials/login.php';
                    }
                    ?>
                </div>
            </div>
            <div class="copyright">&copy;2017 Cheapomail</div>
        </div>
    </body>
</html>
