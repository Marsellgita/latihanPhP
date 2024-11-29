<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Role</title>
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
        <!-- Your main content goes here -->
        <div class="container mx-auto">
            <!-- Button to Insert New Item -->
            <div class="mb-4">
                <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    <a href="index.php?modul=item&insert=addItem">Insert New Item</a>
                </button>
            </div>

            <!-- Roles Table -->
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-200 text-gray-800">

                    <tr>
                        <th class="w-1/12 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">ID</th>
                        <th class="w-1/4 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">Item Name</th>
                        <th class="w-1/3 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">Price</th>
                        <th class="w-1/6 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">Quantity</th>
                        <th class="w-1/6 py-3 px-4 border border-gray-300 uppercase font-semibold text-sm">Actions</th>
                    </tr>

                    </thead>
                    <tbody class="text-gray-700">
                    <!-- Static Data Rows -->
                     <?php foreach($items as $item){?>
                    <tr class="text-center">
                        <td class="py-3 px-4 border border-gray-300"><?php echo htmlspecialchars($item->item_id);?></td>
                        <td class="py-3 px-4 border border-gray-300"><?php echo htmlspecialchars($item->item_name);?></td>
                        <td class="py-3 px-4 border border-gray-300"><?php echo htmlspecialchars($item->item_price);?></td>
                        <td class="py-3 px-4 border border-gray-300"><?php echo htmlspecialchars($item->item_qty);?></td>
                        <td class="py-3 px-4 border border-gray-300">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="index.php?modul=item&insert=update&id=<?php echo htmlspecialchars($item->item_id); ?>">Update</a>
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="index.php?modul=item&insert=delete&id=<?php echo htmlspecialchars($item->item_id); ?>">Delete</a>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                    <!-- More rows can be added statically here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>