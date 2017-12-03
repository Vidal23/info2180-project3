<?php
require_once dirname(__DIR__) . '/inc.php';

try {
    $username  = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $password  = $_POST['password'];

    if ( mb_strlen($username) <= 1 )
        throw new Exception('Invalid username');
    if ( mb_strlen($firstname) <= 1 )
        throw new Exception('Invalid firstname');
    if ( mb_strlen($lastname) <= 1 )
        throw new Exception('Invalid lastname');
    if ( mb_strlen($password) < 8 )
        throw new Exception('Password must be at least 8 characters long');
    if ( validate_password($password) == false )
        throw new Exception('Passwords must have at least one number and one letter, and one capital letter');

    $stm = $conn->prepare($queries['user_byusername']);
    $stm->execute(array('name' => $username));

    if ( $stm->rowCount() > 0 )
        throw new Exception('Username already exists');
    
    $hashpassword = md5($password);

    $stm = $conn->prepare($queries['user_add']);
    $stm->execute(array(
        'firstname' => $firstname,
        'lastname' => $lastname,
        'username' => $username,
        'password' => $hashpassword
    ));

    echo '<p>User added</p>';
}
catch (Exception $e) {
    echo '<p class="error">' . $e->getMessage() . '</p>';
}