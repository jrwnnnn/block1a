<?php
session_start();
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <title>Block1A - Contact</title>
</head>
<body class="min-h-screen flex flex-col">
    <?php include 'includes/navigation.php'; ?>
    <section class="bg-[#2D3748] flex flex-col h-screen text-white md:px-30 px-5 pt-20">
        <h1 class="text-6xl font-bold pb-5">Contact Us</h1>
        <p class="text-lg">To report a player, or to ask a generic question about our server, join our <a href="https://discord.gg/" class="text-blue-500 underline">Discord</a>!</p>
        <p class="text-lg">You can email our support team at <a href="mailto:support@block1a.com" class="text-blue-500 underline">support@block1a.com</a>, we aim to reply within 24 hours.</p>
        <p class="text-lg">You can also contact us in-game using the <code class="bg-gray-800 text-gray-200 px-2 py-1 rounded">/helpop</code> command.</p>
        <img src="assets/panda-and-cat.webp" alt="panda" class="w-full mt-20 max-h-[40vh] object-cover object-center">
    </section>
  
    <?php include 'includes/footer.php'; ?>
</body>
</html>