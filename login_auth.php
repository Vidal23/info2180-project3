<?php
require __DIR__ . '/inc.php';

try {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    if ( is_null($username) || is_null($password) )
        throw new Exception('Username or Password isrequired');

    $stm = $conn->prepare($queries['user_byusername']);
    $stm->execute(array('name' => $username));

    if ( $stm->rowCount() === 0 )
        throw new Exception('Username not found');
    $user = $stm->fetch();

    // hash password using md5 algorithm
    $hashPassword = md5($password);

    //strict binary safe compare both hashed password
    if ( strcmp($user['password'], $hashPassword) === 0 ) {
        
        // assign the user session
        $_SESSION['user'] = $user;

        // indicated back to ajax that is was a success
        echo 'success';
    }
    else {
        throw new Exception('Incorrect password');
    }
}
catch (Exception $e) {
    echo $e->getMessage();
}