<?php
require_once 'includes/Parsedown.php';

    $slug = $_GET['slug'] ?? 'patch-2.25.9';
    $filepath = "articles/$slug.md";

    if (!file_exists($filepath)) {
        header("Location: 404.php");
        exit();
    }

    $content = file_get_contents($filepath);

    preg_match('/---(.*?)---(.*)/s', $content, $matches);
    $frontmatter = array_filter(array_map('trim', explode("\n", trim($matches[1]))));
    $markdownBody = trim($matches[2]);

    $meta = [];
    foreach ($frontmatter as $line) {
        [$key, $value] = explode(':', $line, 2);
        $meta[trim($key)] = trim($value);
    }

    $Parsedown = new Parsedown();
    $parsedBody = $Parsedown->text($markdownBody);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <title><?= htmlspecialchars($meta['title']) ?></title>
</head>
<body>
    <?php include 'includes/navigation.php'; ?>
    
    <img src="https://block1a.onrender.com/assets/<?= htmlspecialchars($meta['cover']) ?>" alt="cover" class="w-full max-h-[40vh] object-cover object-center">

    <section class="flex flex-col bg-[#2D3748] space-y-2 md:px-30 px-5 pt-10">
        <p class="md:text-6xl text-4xl text-center font-bold text-white"><?= htmlspecialchars($meta['title']) ?></p>
        <p class="text-lg text-center text-white"><?= htmlspecialchars($meta['subtitle']) ?></p>
        <div class="flex self-center gap-3 pt-5">
            <p class="<?= htmlspecialchars($meta['tag-col']) ?> text-sm"><?= htmlspecialchars($meta['tag']) ?></p>
            <p class="text-gray-500 text-sm">|</p>
            <p class="text-white text-sm"><?= htmlspecialchars($meta['author']) ?></p>
            <p class="text-gray-500 text-sm">|</p>
            <p class="text-white text-sm"><?= htmlspecialchars($meta['date']) ?></p>
        </div>
        <hr class="border-t-2 border-[#4A5568] mt-5">
    </section>

    <div class="bg-[#2D3748] px-5 md:px-90 py-20 text-white prose prose-invert max-w-none space-y-5 article-main">
    <?= $parsedBody ?>

    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="script/index.js"></script>
</body>
</html>
