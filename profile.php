<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: pages/login.php');
        exit();
    }

    $tab = $_GET['tab'];
    if (!in_array($tab, ['profile', 'posts', 'settings', 'privacy', 'language'])) {
        $tab = 'profile';
        header('Location: profile.php?tab=settings');
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">
    <link href="src/output.css" rel="stylesheet">
    <title>Block1A - Blog</title>
</head>
    <!-- TODO: Improve mobile layout -->
    <body class="flex flex-col min-h-screen">
        <?php include 'includes/navigation.php'; ?>
        <section class="bg-[#2D3748] flex md:flex-row flex-col gap-5 flex-grow">
            <div class="flex flex-col p-7 md:w-100  md:pl-30 bg-[#151a22]">
                <div class="mb-5">
                    <img src="https://mc-heads.net/avatar/<?= $_SESSION['username'] ?>" class="object-cover w-20 aspect-square" alt="avatar">
                    <p class="pt-5 text-2xl font-bold text-white md:text-4xl"><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');?></p>
                    <p class="flex items-center text-gray-400">ID: 54636479 </p>
                    <div class="flex items-center mt-2 text-gray-400">
                        <span class="w-3 h-3 mr-2 bg-green-500 rounded-full"></span>
                        <p class="text-white">Online</p>
                    </div>
                </div>
                <div class="flex flex-col space-y-[4px] text-gray-300 ">
                    <button onclick="window.location.href='profile.php?tab=settings';" class="py-2 px-3 text-left rounded-md hover:bg-[#222a37] hover:text-white focus:bg-blue-500 focus:text-white hover:cursor-pointer">User Settings</button>
                    <button onclick="window.location.href='profile.php?tab=privacy';" class="py-2 px-3 text-left rounded-md hover:bg-[#222a37] hover:text-white focus:bg-blue-500 focus:text-white hover:cursor-pointer">Data and Privacy</button>
                    <button onclick="window.location.href='profile.php?tab=language';" class="py-2 px-3 text-left rounded-md hover:bg-[#222a37] hover:text-white focus:bg-blue-500 focus:text-white hover:cursor-pointer">Language</button>
                    <hr class="flex-grow my-2 border-gray-800 border-1">
                    <form action="functions/logout.php" method="POST" class="flex">
                        <button type="submit" class="flex-grow px-3 py-2 text-left text-gray-300 rounded-md hover:bg-red-500 hover:text-white hover:cursor-pointer">Logout</button>
                    </form>
                </div>
            </div>
            <div class="flex flex-col flex-grow w-full pb-20 text-white p-7 md:w-100">
                <?php include 'includes/profile/' . $tab . '.php'; ?>
            </div>
        </section>
    </body>
</html>