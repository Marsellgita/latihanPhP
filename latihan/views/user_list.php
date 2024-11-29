<?php 
// Pastikan data pengguna sudah didefinisikan sebelumnya
// Misalnya: $users = getUserDataFromDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!-- Navbar -->
<?php include 'includes/navbar.php'; ?>

<!-- Main container -->
<div class="flex">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="container mx-auto">

            <!-- Button to Insert New User -->
            <div class="mb-4">
                <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    <a href="index.php?modul=user&action=add">Insert New User</a>
                </button>
            </div>

            <!-- User Table -->
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="w-1/12 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">User ID</th>
                            <th class="w-1/4 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">Username</th>
                            <th class="w-1/3 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">Password</th>
                            <th class="w-1/6 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">Role Name</th>
                            <th class="w-1/6 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($users as $user): ?>
                            <tr class="text-center">
                                <td class="py-3 px-4 border border-gray-300"><?php echo htmlspecialchars($user->user_id); ?></td>
                                <td class="py-3 px-4 border border-gray-300"><?php echo htmlspecialchars($user->username); ?></td>
                                <td class="py-3 px-4 border border-gray-300"><?php echo htmlspecialchars($user->password); ?></td>
                                <td class="py-3 px-4 border border-gray-300">
                                    <?php 
                                    if ($user->role) {
                                        echo htmlspecialchars($user->role->role_name);
                                    } else {
                                        echo "Role tidak tersedia";
                                    }
                                    ?>
                                </td>
                                <td class="py-3 px-4 border border-gray-300">
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                        <a href="index.php?modul=user&action=update&id=<?php echo htmlspecialchars($user->user_id); ?>">Update</a>
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                        <a href="index.php?modul=user&action=delete&id=<?php echo htmlspecialchars($user->user_id); ?>">Delete</a>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</body>
</html>