<?php
    session_start();
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
        <title>Block1A - News</title>
    </head>
    <body>
        <?php include 'includes/navigation.php'; ?>
        <section class="flex flex-col items-center justify-center text-white bg-cover bg-center bg-no-repeat min-h-[40vh] px-5" style="background-image: url('assets/blog-hero.webp')">
            <p class="text-6xl text-yellow-500 font-bold">News</p>
            <p class="text-lg text-center mt-5">Stay updated with the latest news, updates, and events happening in our community.</p>
        </section>
        <section class="flex bg-[#2D3748] px-5 md:px-30 py-2">
            <button onclick="window.location.href='news/editor.php';" class="flex-grow bg-yellow-500 text-[#2D3748] text-lg font-bold py-2 px-5 mt-5 rounded-md hover:bg-[#1A212B] hover:text-white hover:cursor-pointer transition duration-300 ease-in-out">Create Post</button>
        </section>
        <section class="bg-[#2D3748] grid md:grid-cols-3 px-5 md:px-30 py-20 gap-10">
            <?php foreach ($posts as $post): ?>
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
        </section>
        <?php include 'includes/footer.php'; ?>
    </body>
    </html>
