<?php
    include 'functions/connect.php';

    $stmt = $conn->prepare("SELECT * FROM articles ORDER BY date_posted DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
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
        <section class="flex flex-col items-center justify-center text-white bg-cover bg-center bg-no-repeat min-h-[40vh] px-5" style="background-image: url('assets/blog-hero.webp')">
            <p class="text-6xl text-yellow-500 font-bold">Blog</p>
            <p class="text-lg text-center mt-5">The Official Blog of Block1A! Stay tuned for updates and events.</p>
        </section>
        <section class="bg-[#2D3748] grid md:grid-cols-3 px-5 md:px-30 py-20 gap-10">
            <?php foreach ($posts as $post): ?>
                <?php
                    $tagColor = match ($post['tag']) {
                        'server_updates' => 'text-red-500',
                        'event' => 'text-blue-500',
                        'game_updates' => 'text-green-500',
                        default => 'text-white',
                    };
                ?>
                <div onclick="window.location.href='article.php?id=<?= $post['id'] ?>'" class="hover:cursor-pointer text-white">
                    <img src="<?= htmlspecialchars($post['cover']) ?>" alt="cover" class="mb-5 rounded-md block transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg aspect-video object-cover">
                    <p class="text-md <?= $tagColor ?> capitalize"><?= htmlspecialchars(str_replace('_', ' ', $post['tag'])) ?></p>
                    <p class="text-2xl font-bold mb-2"><?= htmlspecialchars($post['title']) ?></p>
                    <p><?= htmlspecialchars($post['subtitle']) ?></p>
                    <p class="text-gray-400 pt-5 text-sm"><?= htmlspecialchars($post['date_posted']) ?></p>
                </div>
            <?php endforeach; ?>
        </section>
        <?php include 'includes/footer.php'; ?>
    </body>
    </html>
