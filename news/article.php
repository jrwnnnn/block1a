<?php
    session_start();
    include '../functions/connect.php';

    $id = $_GET['id'] ?? '';
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if ($post['tag'] == 'server_updates') {
        $post['tag'] = 'Server Updates';
        $tagColor = 'text-orange-500';
    } elseif ($post['tag'] == 'event') {
        $post['tag'] = 'Event';
        $tagColor = 'text-blue-500';
    } elseif ($post['tag'] == 'game_updates') {
        $post['tag'] = 'Game Updates';
        $tagColor = 'text-green-500';
    } elseif ($post['tag'] == 'tech') {
        $post['tag'] = 'Tech';
        $tagColor = 'text-red-500';
    } else {
        $post['tag'] = 'Unknown Tag';
        $tagColor = 'text-white';
    }

    if (!$post) {
    echo "Post not found.";
    exit;
    }
?>


<!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../src/output.css" rel="stylesheet">
        <title>Block1A - <?= htmlspecialchars($post['title']) ?></title>
    </head>
    <body>
        <?php include 'includes/navigation.php'; ?>
        <img src="<?= htmlspecialchars($post['cover']) ?>" alt="cover" class="w-full max-h-[40vh] object-cover object-center">
        <section class="flex flex-col bg-[#2D3748] space-y-2 md:px-30 px-5 pt-10">
            <p class="md:text-6xl text-4xl text-center font-bold text-white"><?= htmlspecialchars($post['title']) ?></p>
            <p class="text-lg text-center text-white"><?= htmlspecialchars($post['subtitle']) ?></p>
            <div class="flex self-center gap-3 pt-5">
                <p class="text-sm <?= $tagColor ?>"><?= htmlspecialchars($post['tag']) ?></p>
                <p class="text-gray-500 text-sm">|</p>
                <p class="text-white text-sm"><?= htmlspecialchars($post['author']) ?></p>
                <p class="text-gray-500 text-sm">|</p>
                <p class="text-white text-sm"><?= htmlspecialchars($post['date_posted']) ?></p>
            </div>
            <hr class="border-t-2 border-[#4A5568] mt-5">
        </section>
        <div id="content" class="bg-[#2D3748] px-5 md:px-[25vw] py-20 text-white markdown"></div>
        <?php include 'includes/footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script>
            const content = <?= json_encode($post['content']) ?>;
            document.querySelector('#content').innerHTML = marked.parse(content);
        </script>
    </body>
    </html>