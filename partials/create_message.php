<?PHP
require_once dirname(__DIR__) . '/inc.php';

$stm = $conn->prepare($queries['user_all']);
$stm->execute(array('id'=>$user['id']));

$users = $stm->fetchAll();

if ( !varify_login() )
    exit('Please login to view page!');
?>
<form method="post" id="composemessage" onsubmit="sendMessage(event, this)">
    <div class="input-group">
        <label>recipient <input id="checkall" type="checkbox" checked onclick="toggleOption(event, this)"> All</label>
        <select name="recipient[]" id="recipient" multiple>
            <?php
            foreach ($users as $user) {
                $fullname = $user['firstname'].' '.$user['lastname'];
                
                echo '<option value="' . $user['id'] . '" selected>'.$fullname.'</option>';
            }
            ?>
        </select>
        
    </div>
    <div class="input-group">
        <label>RECIPIENT</label>
        <input name="recip" type="text">
    </div>
    <div class="input-group">
        <label>Subject</label>
        <input name="subject" type="text" required>
    </div>
    <div class="input-group">
        <label>Message</label>
        <textarea rows="4" name="body" required></textarea>
    </div>
    <div class="input-group">
        <button type="submit">Send</button>
    </div>
</form>
<div id="xhr_message"></div>