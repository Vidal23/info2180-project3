<?php
require_once dirname(__DIR__) . '/inc.php';

if ( !varify_login() )
    exit('Please login to view page!');

try {
    if ( !isset($_POST['recipient']) )
        throw new Exception('Recipient required');
    
    $recps   = $_POST['recipient'];
    $subject = htmlspecialchars($_POST['subject']);
    $body    = htmlspecialchars($_POST['body']);
    $date    = date('Y-m-d H:i:s');

    /*
      // OPTION 2
      $recip = explode(',', $_POST['recip']);
      $fullnames = array();

      foreach($recip as $user){
      // remove spaces from before/after
      $fullname = trim($user);

      // " name
      $fullnames[] = '"'.$fullname.'"';
      }

      // create a mysql set eg: ("Mary Jane", "Jhon Doe")
      $set = '('.implode(',', $fullnames).')';

      $stm = $conn->prepare('SELECT id FROM users WHERE CONCAT_WS(" ", firstname, lastname) IN '.$set);
      $stm->execute();

      $ids = $stm->fetchAll();

      $stm = $conn->prepare($queries['message_add']);

      foreach($ids as $id){
      $stm->execute(array(
      'recipient_ids' => $id['id'],
      'sender_id' => $user['id'],
      'subject' => $subject,
      'body' => $body,
      'date_sent' => $date
      ));
      }

      // END OPTION 2
     */

    // OPTION 1
    $stm = $conn->prepare($queries['message_add']);

    foreach ($recps as $receiverId) {

        if ( !is_numeric($receiverId) )
            continue;

        $stm->execute(array(
            'recipient_ids' => $receiverId,
            'sender_id' => $user['id'],
            'subject' => $subject,
            'body' => $body,
            'date_sent' => $date
        ));
    }

    // END OPTION 1

    echo '<p>Message Sent</p>';
}
catch (Exception $e) {
    echo '<p class="error">' . $e->getMessage() . '</p>';
}