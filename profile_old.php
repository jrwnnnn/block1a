<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: pages/login.php');
        exit();
    } 
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link href="src/output.css" rel="stylesheet">
    <title>Block1A - Profile</title>
</head>
    <body>
        <?php include 'includes/navigation.php'; ?>
            <section class="bg-[#2D3748] md:px-30 px-5 py-10 flex flex-col items-center">
                <img src="https://mc-heads.net/avatar/<?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');?>" class="object-cover w-20 md:w-30 aspect-square" alt="avatar">
                <p class="pt-5 text-2xl font-bold text-white md:text-4xl"><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');?></p>
                <div class="flex flex-col items-center py-2">
                    <p class="flex items-center text-gray-400">ID: 54636479 
                        <button onclick="copyID()" class="ml-2">
                            <img src="https://cdn-icons-png.flaticon.com/128/1620/1620767.png" alt="Copy Icon" class="w-4 h-4 hover:opacity-80" style="filter: invert(100%);">
                        </button>
                    </p>
                    <script>
                        function copyID() {
                            const id = "54636479";
                            navigator.clipboard.writeText(id);
                        }
                    </script>
                </div>
            </section>
            <section class="bg-[#2D3748] md:px-30 px-5 pb-20">
                <form action="functions/update_profile.php" method="POST" enctype="multipart/form-data" class="px-0 md:px-100">
                    <div class="mb-4">
                        <label for="username" class="block mb-2 font-bold text-white">Username</label>
                        <input type="text" id="username" name="username" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-white rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter your new username" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block mb-2 font-bold text-white">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-white rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter your new email" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 font-bold text-white">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-white rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter your new password" required>
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="block mb-2 font-bold text-white">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-white rounded-lg focus:outline-none focus:border-blue-500" placeholder="Confirm your new password" required>
                    </div>
                    <div class="pt-5 text-center">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-500 hover:cursor-pointer">Update Profile</button>
                    </div>
                </form>
            </section>
            <section class="bg-[#2D3748] md:px-30 px-5 py-10 flex justify-center">
                <form action="functions/logout.php" method="POST">
                    <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-500 hover:cursor-pointer">Logout</button>
                </form>
            </section>
        <?php include 'includes/footer.php'; ?>
        
    </body>
</html>