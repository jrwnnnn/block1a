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
            <p class="md:text-6xl text-5xl text-center font-bold pb-5 md:pt-0 pt-9">HOP IN, BUILD STUFF, HAVE FUN</p>
            <p class="md:text-lg text-center">The Official Minecraft Server of BSCS-1A! Available for both Minecraft Java and Bedrock Platform.</p>
            <button id="copy-button" onclick="copyToClipboard()" class="bg-yellow-500 text-black md:text-lg font-bold py-2 px-5 rounded-md mt-5 hover:bg-[#2D3748] hover:text-white hover:cursor-pointer transition duration-300 ease-in-out">Copy IP : cs1a.minecra.fr</button>
        </div>        
    </section>
    <section class="bg-[#1a202a] md:px-30 px-5 py-5">
        <div class="grid grid-cols-3 md:gap-10 gap-3">
            <div class="text-white text-center">
                <p class="text-yellow-500 md:text-5xl text-2xl font-bold">27</p>
                <p>Unique players</p>
            </div>
            <div class="text-white text-center">
                <p id="player-count" class="text-yellow-500 md:text-5xl text-2xl font-bold">Loading...</p>
                <p>Online players</p>
            </div>
            <div class="text-white text-center">
                <p class="text-yellow-500 md:text-5xl text-2xl font-bold">99.8%</p>
                <p>Server Uptime</p>
            </div>
        </div>
    </section>
    <section class="relative bg-[#2D3748] text-white">
        <?php if ($spotlightPost): ?>
            <div class="relative">
                <img src="<?= htmlspecialchars($spotlightPost['cover']) ?>" class="w-full max-h-[70vh] object-cover object-top brightness-75">
                <div class="absolute inset-0 flex flex-col justify-center items-start md:px-30 px-5 py-10">
                    <p class="text-blue-400 text-lg tracking-widest">Spotlight</p>
                    <p class="md:text-5xl text-3xl font-bold pb-5"><?= htmlspecialchars($spotlightPost['title']) ?></p>
                    <p class="md:text-lg text-base"><?= htmlspecialchars($spotlightPost['subtitle']) ?></p>
                    <button id="copy-button" onclick="window.location.href='news/article.php?id=<?= $spotlightPost['id'] ?>'" class="bg-blue-500 text-white md:text-lg font-bold py-2 px-5 rounded-md mt-5 hover:bg-white hover:text-black hover:cursor-pointer transition duration-300 ease-in-out">Read</button>
                </div>
            </div>
        <?php endif; ?>
    </section>
    <section class="flex flex-col bg-white md:px-30 px-5 py-10">
        <p class="text-black md:text-5xl text-3xl font-bold mb-7">News</p>
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
                <div onclick="window.location.href='news/article.php?id=<?= $post['id'] ?>'" class="hover:cursor-pointer text-black">
                    <div class="aspect-video w-full overflow-hidden rounded-md mb-4">
                        <img src="<?= htmlspecialchars($post['cover']) ?>" class="h-full w-full object-cover transition ease-in-out duration-500 hover:scale-105">
                    </div>
                    <p class="<?= $tagColor ?> capitalize"><?= htmlspecialchars(str_replace('_', ' ', $post['tag'])) ?></p>
                    <p class="text-2xl font-bold mb-2"><?= htmlspecialchars($post['title']) ?></p>
                    <p><?= htmlspecialchars($post['subtitle']) ?></p>
                    <p class="text-gray-600 pt-5 text-sm"><?= date("F d, Y", strtotime($post['date_posted'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="news.php" class="text-blue-500 hover:text-blue-700 tracking-widest mt-5">
            See all news
        </a>
    </section>
    <section class="grid md:grid-cols-2 gap-7.5 bg-[#2D3748] md:px-30 px-5 py-10">
        <div class="relative overflow-hidden rounded-md w-full">
          <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
            <img src="assets/carousel-1.webp" alt="Screenshot 1" class="w-full flex-shrink-0">
            <img src="assets/carousel-2.webp" alt="Screenshot 2" class="w-full flex-shrink-0">
            <img src="assets/carousel-3.webp" alt="Screenshot 3" class="w-full flex-shrink-0">
            <img src="assets/carousel-4.webp" alt="Screenshot 4" class="w-full flex-shrink-0">
            <img src="assets/carousel-5.webp" alt="Screenshot 5" class="w-full flex-shrink-0">
          </div>
        </div>
        <div>
          <p class="md:text-6xl text-4xl text-yellow-500 font-bold mb-7">The Server</p>
          <p class="text-white md:text-lg">This server kicked off on December 10, 2024, right before Christmas break. It started as a chill place for just 7 of us, playing for fun on Aternos. Since then, things have grown — we’ve moved to a premium server for smoother gameplay and more cool stuff to do. It’s still the same cozy vibe, just better performance and more space to hang out.</p>
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