<?php
require_once dirname(__DIR__) . '/inc.php';

if ( !varify_login() )
    exit('Please login to view page!');
?>
<div id="xhr_message"></div>
<form method="post" id="adduser" onsubmit="addUser(event, this)">
    <div class="input-group">
        <label>Firstname</label>
        <input name="firstname" type="text" required>
    </div>
    <div class="input-group">
        <label>Lastname</label>
        <input name="lastname" type="text" required>
    </div>
    <br>
    <div class="input-group">
        <label>Username</label>
        <input name="username" type="text" required>
    </div>
    <div class="input-group">
        <label>password</label>
        <input name="password" type="password" required>
    </div>
    <button type="submit" alert(Successfully created user)>Create User</button>
</form>