<?php

include "connect.php";

$sql = "SELECT * FROM data";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        print("<p>" . $row["username"] . "</p>");
    }
}

require 'includes/Parsedown.php';

$dir = 'articles/';
$files = array_diff(scandir($dir), ['..', '.']);
$articles = [];

foreach ($files as $file) {
    $content = file_get_contents($dir . $file);

    if (preg_match('/---(.*?)---/s', $content, $matches)) {
        $frontMatterRaw = trim($matches[1]);
        $lines = explode("\n", $frontMatterRaw);
        $meta = [];

        foreach ($lines as $line) {
            [$key, $value] = explode(':', $line, 2);
            $meta[trim($key)] = trim($value);
        }

        if (!isset($meta['spotlight']) || $meta['spotlight'] !== 'true') {
            $meta['slug'] = $meta['id'] ?? basename($file, '.md');
            $articles[] = $meta;
        }
    }
}

usort($articles, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));
$latestArticles = array_slice($articles, 0, 3);

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
    <section class="flex flex-col bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('assets/home_splash.png')">
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
        <div class="grid md:grid-cols-2 gap-5 hover:cursor-pointer">
            <img src="assets/season-end-thumb.jpg" alt="cover" class="rounded-md">
            <div>
                <p class="text-blue-400 text-md">Spotlight</p>
                <p class="text-white md:text-5xl text-2xl font-bold pb-5">Season End Fest</p>
                <p class="text-white md:text-lg">Season 1 ended with a bang, and now we're starting fresh with a brand new world! Come hang out as we take a trip down memory lane and relive the stories, moments, and chaos we've all shared.</p>
                <p class="text-gray-400 pt-5">March 15, 2025</p>
            </div>
        </div>
    </section>
    <section class="flex flex-col items-end bg-[#2D3748] md:px-30 px-5 py-7">
        <div class="grid md:grid-cols-3 gap-7.5 hover:cursor-pointer">
            <?php foreach ($latestArticles as $article): ?>
                <div class="text-white" onclick="window.location.href='pages/article.php?slug=<?= htmlspecialchars($article['id']) ?>'">
                    <img src="https://block1a.onrender.com/assets/<?= htmlspecialchars($article['cover']) ?>" alt="cover" class="mb-5 rounded-md block transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:opacity-95 cursor-pointer">
                    <p class="<?= htmlspecialchars($article['tag-col']) ?> text-md"><?= htmlspecialchars($article['tag']) ?></p>
                    <p class="font-bold text-2xl mb-3"><?= htmlspecialchars($article['title']) ?></p>
                    <p><?= htmlspecialchars($article['subtitle']) ?></p>
                    <p class="text-gray-400 pt-5"><?= htmlspecialchars($article['date']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <button onclick="window.location.replace('pages/blog.php')" class="bg-yellow-500 text-[#2D3748] text-lg font-bold py-2 px-5 rounded-md mt-10 hover:bg-[#1A212B] hover:text-white hover:cursor-pointer transition duration-300 ease-in-out">View more...</button>
    </section>
    <section class="bg-[#2D3748] md:px-30 px-5 py-7">
        <div class="mb-10">
          <p class="text-5xl text-yellow-500 font-bold mb-5">The Server</p>
          <p class="text-md text-white">This server kicked off on December 10, 2024, right before Christmas break. It started as a chill place for just 7 of us, playing for fun on Aternos. Since then, things have grown — we’ve moved to a premium server for smoother gameplay and more cool stuff to do. It’s still the same cozy vibe, just better performance and more space to hang out.</p>
        </div>
      
        <div class="relative overflow-hidden rounded-md w-full">
          <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
            <img src="assets/q6shntis2cx61.webp" alt="Screenshot 1" class="w-full flex-shrink-0">
            <img src="assets/rixf6ht2oyaa1.png" alt="Screenshot 2" class="w-full flex-shrink-0">
            <img src="assets/0kgnyorv6j691.webp" alt="Screenshot 3" class="w-full flex-shrink-0">
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