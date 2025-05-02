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
    <link href="src/output.css" rel="stylesheet">
    <title>Block1A - Blog</title>
</head>
    <body>
        <?php include 'includes/navigation.php'; ?>
            <section class="bg-[#2D3748] md:px-30 px-5 py-10 flex flex-col items-center">
                <img src="https://mc-heads.net/avatar/<?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');?>" class="object-cover md:w-30 w-20 aspect-square" alt="pfp">
                <p class="text-white md:text-4xl text-2xl font-bold pt-5"><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');?></p>
                <div class="py-2 flex flex-col items-center">
                    <p class="text-gray-400 flex items-center">ID: 54636479 
                        <button onclick="copyID()" class="ml-2">
                            <img src="https://cdn-icons-png.flaticon.com/128/1620/1620767.png" alt="Copy Icon" class="h-4 w-4 hover:opacity-80" style="filter: invert(100%);">
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
                <form action="update_profile.php" method="POST" enctype="multipart/form-data" class="md:px-100 px-0">
                    <div class="mb-4">
                        <label for="username" class="block text-white font-bold mb-2">Username</label>
                        <input type="text" id="username" name="username" class="bg-gray-800 w-full px-3 py-2 border-white border-2 rounded-lg focus:outline-none focus:border-blue-500 text-white" placeholder="Enter your new username" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-white font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="bg-gray-800 w-full px-3 py-2 border-white border-2 rounded-lg focus:outline-none focus:border-blue-500 text-white" placeholder="Enter your new email" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-white font-bold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="bg-gray-800 w-full px-3 py-2 border-white border-2 rounded-lg focus:outline-none focus:border-blue-500 text-white" placeholder="Enter your new password" required>
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="block text-white font-bold mb-2">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-800 w-full px-3 py-2 border-white border-2 rounded-lg focus:outline-none focus:border-blue-500 text-white" placeholder="Confirm your new password" required>
                    </div>
                    <div class="text-center pt-5">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 hover:cursor-pointer">Update Profile</button>
                    </div>
                </form>
            </section>
            <section class="bg-[#2D3748] md:px-30 px-5 py-10 flex justify-center">
                <form action="functions/logout.php" method="POST">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500 hover:cursor-pointer">Logout</button>
                </form>
            </section>
        <?php include 'includes/footer.php'; ?>
        
    </body>
</html>