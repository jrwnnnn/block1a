<?php
    session_start();
    include 'functions/connect.php';

    $spotlightStmt = $conn->prepare("SELECT * FROM articles WHERE spotlight = 1 ORDER BY date_posted DESC LIMIT 1");
    $spotlightStmt->execute();
    $spotlightResult = $spotlightStmt->get_result();
    $spotlightPost = $spotlightResult->fetch_assoc();
    $spotlightStmt->close();

    $nonSpotlightStmt = $conn->prepare("SELECT * FROM articles WHERE spotlight = 0 ORDER BY date_posted DESC LIMIT 3");
    $nonSpotlightStmt->execute();
    $nonSpotlightResult = $nonSpotlightStmt->get_result();
    $nonSpotlightPosts = $nonSpotlightResult->fetch_all(MYSQLI_ASSOC);
    $nonSpotlightStmt->close();

    $conn->close();
?>


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <title>Block1A - Home</title>
</head>
<body>
    <section class="flex flex-col bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('assets/home_splash.webp')">
        <?php include 'includes/navigation.php'; ?>
        <div class="flex flex-col md:items-start md:justify-end justify-center items-center flex-grow text-white pb-20 md:px-30 px-10">
            <p class="text-6xl text-center font-bold pb-5">HOP IN, BUILD STUFF, HAVE FUN</p>
            <p class="text-lg text-center">The Official Minecraft Server of BSCS-1A! Available for both Minecraft Java and Bedrock Platform.</p>
            <button id="copy-button" onclick="copyToClipboard()" class="bg-yellow-500 text-[#2D3748] text-lg font-bold py-2 px-5 rounded-md mt-5 hover:bg-[#2D3748] hover:text-white hover:cursor-pointer transition duration-300 ease-in-out">Copy IP : cs1a.minecra.fr</button>
        </div>        
    </section>
    <section class="bg-[#1a202a] md:px-30 px-5 py-5">
        <div class="grid grid-cols-3 md:gap-10 gap-3">
            <div class="text-white text-center">
                <p class="text-yellow-500 md:text-5xl text-3xl font-bold">27</p>
                <p>Unique players</p>
            </div>
            <div class="text-white text-center">
                <p id="player-count" class="text-yellow-500 md:text-5xl text-3xl font-bold">Loading...</p>
                <p>Online players</p>
            </div>
            <div class="text-white text-center">
                <p class="text-yellow-500 md:text-5xl text-3xl font-bold">99.8%</p>
                <p>Server Uptime</p>
            </div>
        </div>
    </section>
    <section class="bg-[#2D3748] md:px-30 px-5 py-7">
    <?php if ($spotlightPost): ?>
    <div onclick="window.location.href='news/article.php?id=<?= htmlspecialchars($spotlightPost['id']) ?>'" class="grid grid-cols-2 gap-5 cursor-pointer">
        <div class="aspect-auto w-full overflow-hidden rounded-md">
            <img src="<?= htmlspecialchars($spotlightPost['cover']) ?>" class="h-full w-full object-cover transition ease-in-out duration-500 hover:scale-105">
        </div>
        <div>
            <p class="text-blue-400 text-md">Spotlight</p>  
            <p class="text-white md:text-5xl text-2xl font-bold pb-5"><?= htmlspecialchars($spotlightPost['title']) ?></p>
            <p class="text-white md:text-lg"><?= htmlspecialchars($spotlightPost['subtitle']) ?></p>
            <p class="text-gray-400 pt-5"><?= htmlspecialchars($spotlightPost['date_posted']) ?></p>
        </div>
    </div>
<?php endif; ?>

    </section>
    <section class="flex flex-col items-end bg-[#2D3748] md:px-30 px-5 py-7">
        <div class="grid md:grid-cols-3 gap-7.5 hover:cursor-pointer">
            <?php foreach ($nonSpotlightPosts  as $post): ?>
                <?php
                    $tagColor = match ($post['tag']) {
                        'server_updates' => 'text-red-500',
                        'event' => 'text-blue-500',
                        'game_updates' => 'text-green-500',
                        'tech' => 'text-red-500',
                        default => 'text-white',
                    };
                ?>
                <div onclick="window.location.href='news/article.php?id=<?= $post['id'] ?>'" class="hover:cursor-pointer text-white">
                <div class="aspect-video w-full overflow-hidden rounded-md mb-4">
                    <img src="<?= htmlspecialchars($post['cover']) ?>" class="h-full w-full object-cover transition ease-in-out duration-500 hover:scale-105">
                </div>
                    <p class="text-md <?= $tagColor ?> capitalize"><?= htmlspecialchars(str_replace('_', ' ', $post['tag'])) ?></p>
                    <p class="text-2xl font-bold mb-2"><?= htmlspecialchars($post['title']) ?></p>
                    <p><?= htmlspecialchars($post['subtitle']) ?></p>
                    <p class="text-gray-400 pt-5 text-sm"><?= htmlspecialchars($post['date_posted']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <button onclick="window.location.href='news.php';" class="bg-yellow-500 text-[#2D3748] text-lg font-bold py-2 px-5 rounded-md mt-10 hover:bg-[#1A212B] hover:text-white hover:cursor-pointer transition duration-300 ease-in-out">View more...</button>
    </section>
    <section class="bg-[#2D3748] md:px-30 px-5 py-7">
        <div class="mb-10">
          <p class="text-5xl text-yellow-500 font-bold mb-5">The Server</p>
          <p class="text-md text-white">This server kicked off on December 10, 2024, right before Christmas break. It started as a chill place for just 7 of us, playing for fun on Aternos. Since then, things have grown — we’ve moved to a premium server for smoother gameplay and more cool stuff to do. It’s still the same cozy vibe, just better performance and more space to hang out.</p>
        </div>
      
        <div class="relative overflow-hidden rounded-md w-full">
          <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
            <img src="assets/carousel-1.webp" alt="Screenshot 1" class="w-full flex-shrink-0">
            <img src="assets/carousel-2.webp" alt="Screenshot 2" class="w-full flex-shrink-0">
            <img src="assets/carousel-3.webp" alt="Screenshot 3" class="w-full flex-shrink-0">
          </div>
        </div>
    </section>
    <section class="flex flex-col items-center bg-[#2D3748] md:px-30 px-5 py-7">
        <img src="assets/cs1aminecrafr1.png" class="w-200">
        <p class="md:text-lg mt-3 text-white text-center"> Whether you’re here to build, explore, or just vibe with friends, welcome to the crew!</p>
    </section>
    <?php include 'includes/footer.php'; ?>
    <script src="script/index.js"></script>
</body>
</html>