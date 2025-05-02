<?php
    session_start();

    if (isset($_SESSION['permission_level']) && $_SESSION['permission_level'] == 1) {
        include '../functions/connect.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $action = $_GET['action'] ?? 'create';
        $article_id = $_GET['id'] ?? null;

        if ($action == 'edit' && $article_id) {
            $stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
            $stmt->bind_param("s", $article_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $article = $result->fetch_assoc();
            $stmt->close();
        } else {
            $article = null;
        }
    } else {
        header('Location: ../news.php');
        exit;
    }

    $conn->close();
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link href="../src/output.css" rel="stylesheet">
    <link href="../src/simplemde.css" rel="stylesheet">
    <title>Block1A - Editor</title>
</head>
<body class="min-h-screen flex flex-col">
    <?php include 'includes/navigation.php'; ?>
    <!-- <img src="" id="coverPreview" alt="cover" class="w-full max-h-[40vh] object-cover object-center"> -->

    <section class="flex flex-col md:px-30 px-5 py-10 pb-20 text-white bg-[#2D3748]">
        <form id="postForm" class="space-y-4" action="../functions/submit_article.php" method="POST">
            <input type="hidden" name="action" value="<?= $action ?>">
            <input type="hidden" name="id" value="<?= $article ? $article['id'] : '' ?>">

            <input type="text" name="title" placeholder="Title" class="text-white md:text-6xl text-4xl font-bold w-full focus:outline-none" value="<?= $article ? htmlspecialchars($article['title']) : '' ?>" required autocomplete="off">
            <textarea type="text" name="subtitle" placeholder="Subtitle" class="text-white md:text-2xl text-lg w-full focus:outline-none" value="<?= $article ? htmlspecialchars($article['subtitle']) : '' ?>" required autocomplete="off"></textarea >

            <div class="flex md:flex-row flex-col gap-3">
                <input type="text" name="cover" placeholder="Cover Image URL" class="bg-gray-800 px-3 py-2 rounded-lg focus:outline-none text-white" value="<?= $article ? htmlspecialchars($article['cover']) : '' ?>" required autocomplete="off">
                <div class="flex gap-3">
                    <select name="tag" class="md:w-auto md:order flex-grow bg-gray-800 px-3 py-2 rounded-lg focus:outline-none text-white">
                        <option value="server_updates" <?= $article && $article['tag'] == 'server_updates' ? 'selected' : '' ?>>Server Updates</option>
                        <option value="event" <?= $article && $article['tag'] == 'event' ? 'selected' : '' ?>>Event</option>
                        <option value="game_updates" <?= $article && $article['tag'] == 'game_updates' ? 'selected' : '' ?>>Game Updates</option>
                        <option value="tech" <?= $article && $article['tag'] == 'tech' ? 'selected' : '' ?>>Tech</option>
                    </select>
                    <div class="flex gap-3 px-3 py-2 bg-gray-800 rounded-md">
                        <img src="https://mc-heads.net/avatar/<?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');?>" alt="avatar" class="w-5 aspect-square rounded">
                        <p class="text-white"><?= $_SESSION['username'] ?></p>
                    </div>
                </div>
            </div>
            <textarea name="content" id="editor"><?= $article ? htmlspecialchars($article['content']) : '' ?></textarea>
            <div class="flex items-start justify-between gap-3">
                <button type="submit" class="bg-yellow-500 text-black md:text-lg font-bold py-2 px-5 rounded-md hover:bg-yellow-300 hover:cursor-pointer transition duration-300 ease-in-out">
                    <?= $action == 'edit' ? 'Update Article' : 'Post Article' ?>
                </button>

                <label for="spotlight" class="flex items-center gap-2 text-white">
                    <input type="checkbox" name="spotlight" id="spotlight" class="w-4 h-4 text-blue-500 focus:ring focus:ring-blue-300 rounded" <?= $article && $article['spotlight'] == 1 ? 'checked' : '' ?>>Spotlight
                </label>
            </div>
        </form>
    </section>
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="../script/simplemde.js"></script>
</body>
</html>
