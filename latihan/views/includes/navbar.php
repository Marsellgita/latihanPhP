<?php
// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil data pengguna dari session
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$password = $_SESSION['password'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAM GROUP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-orange-500 p-4 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Left Section: Logo and My Application text -->
        <div class="flex items-center text-white font-bold text-xl">
            <img src="images/logo3.png" alt="Logo" class="w-8 h-8 rounded-full mr-3">
            <span>TAM GROUP</span>
        </div>
        
        <!-- Right Section: Navigation Menu -->
        <div class="flex items-center space-x-4">
            <!-- Home link -->
            <img src="images/home.png" alt="Logo" class="w-5 h-5 rounded-full">
            <a href="index.php?modul=dashboard" class="text-white hover:text-gray-200">Home</a>
            
            <!-- Akun dropdown -->
            <div class="relative">
                <button class="text-white hover:text-gray-200 flex items-center" id="akunButton">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM12 14c-3.87 0-7 3.13-7 7h14c0-3.87-3.13-7-7-7z"></path>
                    </svg>
                    Akun
                    <svg class="ml-2 w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div class="akun-dropdown absolute right-0 hidden mt-2 bg-white shadow-lg rounded-md w-40 py-2">
                    <a href="#" id="profileLink" class="block px-4 py-2 text-gray-700">Profil</a>
                    <a href="index.php?logout=true" class="block px-4 py-2 text-gray-700">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Modal Profil -->
<div id="profileModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Profil Pengguna</h1>
        <p class="text-lg text-gray-700"><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p class="text-lg text-gray-700"><strong>Role:</strong> <?php echo htmlspecialchars($role); ?></p>
        <p class="text-lg text-gray-700"><strong>Password:</strong>
            <span id="passwordField" class="font-mono">********</span>
            <button id="togglePassword" class="ml-2 text-gray-600 hover:text-gray-800">
                <svg id="eyeIcon" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0c0-3.866-3.582-7-8-7S4 8.134 4 12s3.582 7 8 7 8-3.134 8-7z"></path>
                </svg>
            </button>
        </p>

        <!-- Tombol logout -->
        <a href="index.php?logout=true" class="mt-6 inline-block px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300">Logout</a>

        <!-- Tombol untuk menutup modal -->
        <button onclick="closeModal()" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Close</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const akunButton = document.getElementById('akunButton');
        const akunDropdown = document.querySelector('.akun-dropdown');
        const profileLink = document.getElementById('profileLink');
        const profileModal = document.getElementById('profileModal');
        const passwordField = document.getElementById('passwordField');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        // Menambahkan event listener untuk tombol Akun
        akunButton.addEventListener('click', function() {
            akunDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!akunButton.contains(event.target) && !akunDropdown.contains(event.target)) {
                akunDropdown.classList.add('hidden');
            }
        });

        // Tampilkan modal ketika "Profil" diklik
        profileLink.addEventListener('click', function(event) {
            event.preventDefault();  // Mencegah halaman berpindah
            profileModal.classList.remove('hidden');
        });

        // Fungsi untuk menutup modal
        window.closeModal = function() {
            profileModal.classList.add('hidden');
        };

        // Password toggle functionality
        let isPasswordVisible = false;
        togglePassword.addEventListener('click', function () {
            isPasswordVisible = !isPasswordVisible;
            if (isPasswordVisible) {
                passwordField.textContent = "<?php echo htmlspecialchars($password); ?>"; // Tampilkan password asli
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m7 0c0-3.866-3.582-7-8-7S4 8.134 4 12s3.582 7 8 7 8-3.134 8-7zM12 8c.862 0 1.568.724 1.568 1.6 0 .873-.706 1.6-1.568 1.6-.863 0-1.568-.727-1.568-1.6C10.432 8.724 11.137 8 12 8z"></path>
                `;
            } else {
                passwordField.textContent = "********"; // Sembunyikan password
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0c0-3.866-3.582-7-8-7S4 8.134 4 12s3.582 7 8 7 8-3.134 8-7z"></path>
                `;
            }
        });
    });
</script>

</body>
</html>