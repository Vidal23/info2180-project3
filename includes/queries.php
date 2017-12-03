<?php
$queries = array(
    'user_all' => 'SELECT * FROM users WHERE id != :id',
    'user_byid' => 'SELECT * FROM users WHERE id = :id',
    'user_byusername' => 'SELECT * FROM users WHERE username = :name'
);

$queries['user_add'] = '
    INSERT INTO users(firstname,lastname,username,password)
    VALUES(:firstname, :lastname, :username, :password)';


$queries['message_add'] = '
    INSERT INTO messages(recipient_ids, sender_id, subject, body, date_sent)
    VALUES(:recipient_ids, :sender_id, :subject, :body, :date_sent)';

$queries['message_single'] = '
    SELECT m.*, u.firstname, u.lastname, CONCAT_WS(" ", u.firstname, u.lastname) as sender
    FROM messages m
    JOIN users u
    ON m.sender_id = u.id
    WHERE m.id = :id
    AND recipient_ids = :receiver';

// most recent messages query
$queries['message_recent'] = '
    SELECT m.*, mr.date_read, CONCAT_WS(" ", u.firstname, u.lastname) as sender
    FROM messages m
    INNER JOIN users u
    ON m.sender_id = u.id
    LEFT JOIN messages_read mr
    ON m.id = mr.message_id
    WHERE m.recipient_ids = :receiver
    ORDER BY m.date_sent DESC
    LIMIT 10';

// check if the message is already read
$queries['message_ifread'] = '
    SELECT m.* FROM messages_read m
    WHERE m.message_id = :message_id
    AND m.reader_id = :reader_id';

$queries['message_markread'] = '
    INSERT INTO messages_read(message_id, reader_id, date_read)
    VALUES(:message_id, :reader_id, :date_read)';
