<?php
session_start();
require_once 'models/user_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Membuat objek modelUser untuk mengambil data user
    $modelUser = new modelUser();

    // Cek apakah username dan password cocok
    $user = $modelUser->getUserByName($username);
    if ($user && $user->password == $password) {
        // Jika login sukses, simpan data user ke sesi dan arahkan ke halaman utama
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['username'] = $user->username;
        $_SESSION['role'] = $user->role->role_name; // Simpan role jika perlu
        $_SESSION['password'] = $user->password;
        
        // Redirect ke halaman utama setelah login
        header("Location: index.php");
        exit;
    } else {
        // Jika login gagal, tampilkan pesan error
        $error_message = "Username atau password salah!";
    }
}
?>

<!-- Menggunakan Tailwind CSS CDN untuk desain -->
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

        <form action="login.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                <input type="text" id="username" name="username" class="mt-1 p-2 w-full border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-lg" required>
            </div>
            <div class="mb-4">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700">Login</button>
            </div>
        </form>

        <!-- Tampilkan error message jika ada -->
        <?php if (isset($error_message)) { ?>
            <p class="text-red-500 text-sm text-center"><?php echo $error_message; ?></p>
        <?php } ?>
    </div>

</body>