<?php
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
$articles = array_slice($articles, 0, 6);

$articleHTML = '';
foreach ($articles as $article) {
    $articleHTML .= '
    <div onclick="window.location.replace(\'article.php?slug=' . htmlspecialchars($article['id']) . '\')" class="hover:cursor-pointer">
        <img src="https://block1a.onrender.com/assets/' . htmlspecialchars($article['cover']) . '" alt="cover" class="mb-5 rounded-md block transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:opacity-95">
        <p class="' . htmlspecialchars($article['tag-col']) . ' text-md">' . htmlspecialchars($article['tag']) . '</p>
        <p class="article-title">' . htmlspecialchars($article['title']) . '</p>
        <p class="article-subtext">' . htmlspecialchars($article['subtitle']) . '</p>
        <p class="text-gray-400 pt-5">' . htmlspecialchars($article['date']) . '</p>
    </div>';
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
        <section class="flex flex-col items-center justify-center text-white bg-cover bg-center bg-no-repeat min-h-[40vh] px-5" style="background-image: url('assets/7BjxfxL.png')">
            <p class="text-6xl text-yellow-500 font-bold">Blog</p>
            <p class="text-lg text-center mt-5">The Official Blog of Block1A! Stay tuned for updates and events.</p>
        </section>
        <section class="bg-[#2D3748] grid md:grid-cols-3 md:px-30 px-5 py-15 gap-10">
            <?= $articleHTML ?>
        </section>
        <?php include 'includes/footer.php'; ?>
        <script src="script/index.js"></script>
    </body>
</html>