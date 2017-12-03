<?php
require_once dirname(dirname(__FILE__)) . '/inc.php';

if ( !varify_login() )
    exit('Please login to view page!');

try {
    $stm = $conn->prepare($queries['message_recent']);
    $stm->execute(array('receiver' => $user['id']));

    $messages = $stm->fetchAll();
}
catch (Exception $e) {
    echo '<p class="error">' . $e->getMessage() . '</p>';
}

$read   = 0;
$unread = 0;
$total  = count($messages);
?>
<div class="text-center" style="font-size: 1.4rem;line-height: 2;">Welcome to Cheapomail</div>
<table class="messages">
    <thead>
        <tr>
            <th style="width: 20%">Sender</th>
            <th style="width: 20%">Subject</th>
            <th>Date Sent</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($messages as $message) {

            if ( is_null($message['date_read']) ) {
                echo '<tr class="bold">';
                $unread++;
            }
            else {
                echo '<tr>';
                $read++;
            }

            $link = 'read_message.php?id=' . $message['id'];

            echo '<td style="width: 20%"><a href="#" onclick="loadPath(event, \'' . $link . '\')">' . $message['sender'] . '</a></td>';
            echo '<td style="width: 20%"><a href="#" onclick="loadPath(event, \'' . $link . '\')">' . $message['subject'] . '</a></td>';
            echo '<td><a href="#" onclick="loadPath(event, \'' . $link . '\')">' . $message['date_sent'] . '</a></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<br>
<?php
echo '<div>Total: ' . $total . ' Read: ' . $read . ' Unread: ' . $unread . '</div>';

if ( $total == 0 ) {
    echo '<p style="text-align: center;">No Messages</p>';
}
?>
<script>
    // add 10 second timeout to reload the homepage
    // adjust for faster/slower page refresh
    var timeout = 20;
    setInterval(refreshRecent, timeout * 1000);
</script>