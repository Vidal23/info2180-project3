<?PHP
function validate_password($password) {
    return preg_match('/^(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]+$/', $password);
}

function varify_login() {
    if ( isset($_SESSION['user']) && is_array($_SESSION['user']) )
        return true;
    else
        return false;
}
