<?php

session_start();

$name = $_SESSION['customer_name'] ?? null;
$email = $_SESSION['customer_email'] ?? null;
$number = $_SESSION['customer_number'] ?? null;

// Data hanya sementara; hapus setelah ditampilkan satu kali.
unset($_SESSION['customer_name'], $_SESSION['customer_email'],$_SESSION['customer_number']);

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
    <title>Hasil Pengiriman Customer</title>
    <style>
        body{font:16px/1.5 Arial,sans-serif;max-width:680px;margin:40px auto;padding:0 16px;color:#203129}
        .card{padding:24px;border:1px solid #d8e2dc;border-radius:12px;background:#fff}
        h1{color:#0f6a4a}.muted{color:#5c6d63}a{color:#0f6a4a}
    </style>
</head>
<body>
    <main class="card">
        <h1>200 — Halaman Berhasil Dimuat</h1>
        <?php if ($name !== null && $email !== null && $number !== null): ?>
            <p>JavaScript mengizinkan submit dan server juga menerima data yang valid.</p>
            <p><strong>Nama:</strong> <?= e((string) $name) ?></p>
            <p><strong>Email:</strong> <?= e((string) $email) ?></p>
            <p><strong>Number:</strong> <?= e((string) $number) ?></p>
            <p class="muted">Data ini disimpan sementara di session, bukan database.</p>
        <?php else: ?>
            <p>Belum ada data customer dari pengiriman terbaru.</p>
        <?php endif; ?>
        <p><a href="index.php">Kembali ke formulir</a></p>
    </main>
</body>
</html>