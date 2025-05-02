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

    $tagColor = match ($post['tag']) {
        'server_updates' => 'text-orange-500',
        'event' => 'text-blue-500',
        'game_updates' => 'text-green-500',
        'tech' => 'text-red-500',
        default => 'text-white',
    };

    $post['tag'] = match ($post['tag']) {
        'server_updates' => 'Server Updates',
        'event' => 'Event',
        'game_updates' => 'Game Updates',
        'tech' => 'Tech',
        default => 'Unknown Tag',
    };

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
        <?php if (isset($_SESSION['permission_level']) && $_SESSION['permission_level'] == 1): ?>
            <div class="flex flex-col fixed bottom-5 right-5 gap-3 z-10">
                <div class="flex items-center gap-2 md:p-4 p-3 bg-red-500 hover:cursor-pointer rounded-md"
                    onclick="if (confirm('Are you sure you want to delete this article? (This action is irreversable)')) { window.location.href='../functions/delete-article.php?id=<?= htmlspecialchars($post['id']) ?>'; }">
                    <img src="https://cdn-icons-png.flaticon.com/128/3096/3096687.png" class="w-5">
                </div>
                <div class="flex items-center gap-2 md:p-4 p-3 bg-yellow-500 hover:cursor-pointer rounded-md"
                    onclick="window.location.href='editor.php?action=edit&id=<?= htmlspecialchars($post['id']) ?>';">
                    <img src="https://cdn-icons-png.flaticon.com/128/9356/9356210.png" class="w-5">
                </div>
        </div>
        <?php endif; ?>
        <img src="<?= htmlspecialchars($post['cover']) ?>" alt="cover" class="w-full max-h-[40vh] object-cover object-center">
        <section class="flex flex-col bg-[#2D3748] space-y-2 md:px-30 px-5 pt-10">
            <p class="md:text-6xl text-4xl text-center font-bold text-white"><?= htmlspecialchars($post['title']) ?></p>
            <p class="md:text-lg text-center text-white"><?= htmlspecialchars($post['subtitle']) ?></p>
            <div class="flex self-center gap-3 pt-5">
                <p class="text-sm <?= $tagColor ?>"><?= htmlspecialchars($post['tag']) ?></p>
                <p class="text-gray-500 text-sm">|</p>
                <p class="text-white text-sm"><?= htmlspecialchars($post['author']) ?></p>
                <p class="text-gray-500 text-sm">|</p>
                <p class="text-white text-sm"><?= htmlspecialchars($post['date_posted']) ?></p>
            </div>
            <hr class="border-t-2 border-[#4A5568] mt-5">
        </section>
        <div id="content" class="bg-[#2D3748] md:px-[25vw] px-5 py-20 text-white markdown"></div>
        <?php if (!$post['last_edited'] == NULL): ?>
            <div class="flex justify-center items-flex-end bg-[#2D3748] md:px-30 px-5 pb-5">
                <p class="text-gray-500 text-center italic">Last edited on <?= htmlspecialchars($post['last_edited']) ?></p>
            </div>
        <?php endif; ?>
        <?php include 'includes/footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script>
            const content = <?= json_encode($post['content']) ?>;
            document.querySelector('#content').innerHTML = marked.parse(content);
        </script>
    </body>
    </html>