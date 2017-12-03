<?php
require_once dirname(__DIR__) . '/inc.php';

if ( !varify_login() )
    exit('Please login to view page!');

try {
    $id   = isset($_GET['id']) ? $_GET['id'] : null;
    $date = date('Y-m-d H:i:s');

    if ( is_null($id) )
        throw new Exception('ID required');

    $stm = $conn->prepare($queries['message_single']);
    $stm->execute(array('id' => $id, 'receiver' => $user['id']));

    if ( $stm->rowCount() === 0 )
        throw new Exception('Cannt read this message');

    $message  = $stm->fetch();
    $dateSent = date('D, d M Y h:i A', strtotime($message['date_sent']));
    
    $checkStm = $conn->prepare($queries['message_ifread']);
    $checkStm->execute(array('message_id' => $id, 'reader_id' => $user['id']));

    if ( $checkStm->rowCount() == 0 ) {

        // Mark the message as read
        $stm = $conn->prepare($queries['message_markread']);
        $stm->execute(array(
            'message_id' => $id,
            'reader_id' => $user['id'],
            'date_read' => $date
        ));
    }

    echo '<div class="message_sender">From: ' . $message['sender'] . ' <strong>[' . $message['subject'] . ']</strong></div>';
    echo '<div class="message_body">' . $message['body'] . '</div>';
    echo '<div class="message_date">' . $dateSent . '</div>';
}
catch (Exception $e) {
    echo '<p class="error">' . $e->getMessage() . '</p>';
}