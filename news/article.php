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
        <?php if (isset($_SESSION['user_id'])): ?>
            <div id="actionButton" class="flex items-center gap-2 fixed bottom-5 right-5 p-4 bg-yellow-500 hover:cursor-pointer rounded-md z-10"
                onclick="window.location.href='editor.php?action=edit&id=<?= htmlspecialchars($post['id']) ?>';">
                <img id="actionIcon" src="https://cdn-icons-png.flaticon.com/128/9356/9356210.png" class="w-5">
            </div>
        <?php endif; ?>
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
        <div id="content" class="bg-[#2D3748] md:px-[25vw] px-5 py-20 text-white markdown"></div>
        <?php include 'includes/footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script>
            const content = <?= json_encode($post['content']) ?>;
            document.querySelector('#content').innerHTML = marked.parse(content);

            const btn = document.getElementById('actionButton');
            const icon = document.getElementById('actionIcon');
            let toggled = false;
            const articleId = "<?= htmlspecialchars($post['id']) ?>";

            function editArticle() {
                window.location.href = `editor.php?action=edit&id=${articleId}`;
            }

            function deleteArticle() {
                const confirmed = confirm("Are you sure you want to delete this article?");
                if (confirmed) {
                    window.location.href = `../functions/delete-article.php?id=${articleId}`;
                }
            }

            btn.addEventListener('contextmenu', (e) => {
                e.preventDefault();
                toggled = !toggled;

                if (toggled) {
                    btn.classList.remove('bg-yellow-500');
                    btn.classList.add('bg-red-600');
                    icon.src = "https://cdn-icons-png.flaticon.com/128/565/565491.png";
                    btn.setAttribute('onclick', "deleteArticle()");
                } else {
                    btn.classList.remove('bg-red-600');
                    btn.classList.add('bg-yellow-500');
                    icon.src = "https://cdn-icons-png.flaticon.com/128/9356/9356210.png";
                    btn.setAttribute('onclick', "editArticle()");
                }
            });
        </script>
    </body>
    </html>