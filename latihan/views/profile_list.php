<?php
// Mulai session untuk mengakses data pengguna yang telah login
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil data pengguna dari session
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Misalnya, jika kamu juga ingin menampilkan email atau data lain yang disimpan saat login, ambil dari session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Email tidak ditemukan';

// Tampilkan data pengguna pada halaman profil
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>

    <!-- Mengimpor Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Profil Pengguna</h1>
        <p class="text-lg text-gray-700"><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p class="text-lg text-gray-700"><strong>Role:</strong> <?php echo htmlspecialchars($role); ?></p>
        <p class="text-lg text-gray-700"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

        <!-- Tombol logout -->
        <a href="logout.php" class="mt-6 inline-block px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300">Logout</a>
    </div>

</body>
</html>