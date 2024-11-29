<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Item</title>
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
            <!-- Formulir Input Role -->
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Item</h2>
                <form action="index.php?modul=item&insert=edit&id=<?php echo $item->item_id?>" method="POST">

                    <!-- Nama Role -->
                    <div class="mb-4">
                        <label for="item_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Item:</label>
                        <input type="text" id="item_name" name="item_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Nama Barang" required
                        value="<?php echo htmlspecialchars($item->item_name)?>">
                    </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <label for="item_price" class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
                        <input id="item_price" name="item_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Harga" required 
                        value="<?php echo htmlspecialchars($item->item_price)?>">
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-4">
                        <label for="item_qty" class="block text-gray-700 text-sm font-bold mb-2">Jumlah:</label>
                        <input id="item_qty" name="item_qty" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Jumlah" required 
                        value="<?php echo htmlspecialchars($item->item_qty)?>">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Submit
                        </button>
                        <button>
                            <a href="index.php?modul=item" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-md">Close</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>