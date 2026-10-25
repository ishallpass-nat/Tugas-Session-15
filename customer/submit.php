<?php

session_start();
require_once __DIR__ . '/Customer.php';

// Endpoint ini hanya menerima POST.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    header('Content-Type: text/plain; charset=UTF-8');
    echo '405 - Method Not Allowed. Gunakan POST untuk mengirim form.';
    exit;
}

// Baca data dari request body.
$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$number = trim((string) ($_POST['number'] ?? ''));
// Validasi server tetap wajib walaupun sudah ada JavaScript di browser.
$errors = [];

if ($name === '') {
    $errors[] = 'Nama customer wajib diisi.';
}

if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'Email wajib diisi dengan format yang valid.';
}

if ($number === '' || filter_var($number, FILTER_VALIDATE_NUMBER) === false) {
    $errors[] = 'Nomor wajib diisi dengan format yang valid.';
}

if ($errors !== []) {
    http_response_code(422);
    header('Content-Type: text/html; charset=UTF-8');

    function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
    ?>
    <!doctype html>
    <html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>422 - Data Tidak Valid</title>
        <style>body{font:16px/1.5 Arial,sans-serif;max-width:680px;margin:40px auto;padding:0 16px;color:#203129}h1{color:#9b1c1c}a{color:#0f6a4a}</style>
    </head>
    <body>
        <h1>422 — Data Tidak Valid</h1>
        <p>Request sudah mencapai server, tetapi data belum lolos validasi.</p>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <p><a href="index.php">Kembali ke formulir</a></p>
    </body>
    </html>
    <?php
    exit;
}

// Buat object dari class yang sudah dikenal sejak Session 14.
$customer = new Customer($name, $email, $number);

// Simpan sementara untuk menunjukkan session lintas-request.
$_SESSION['customer_name'] = $customer->getName();
$_SESSION['customer_email'] = $customer->getEmail();
$_SESSION['customer_number'] = $customer->getNumber();

session_write_close();

// PRG: POST -> 303 -> GET halaman sukses.
header('Location: success.php', true, 303);
exit;