<?PHP
require_once dirname(__DIR__) . '/inc.php';
?>
<h2 style="text-align: center">Cheapomail</h2>
<div id="login_wrapper">
    <form method="post" onsubmit="checklogin(event, this)">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>