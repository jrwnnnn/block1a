<?php    
    $data = json_decode(file_get_contents('data/faq.json'), true);

    $pageTitle = $data['pageTitle'] ?? 'Block1A';
    $mainTopic = $data['mainTopic'] ?? 'Main Topic';
    $description = $data['description'] ?? '';
    $mainContent = $data['mainContent'] ?? '';
    $relatedArticles = $data['relatedArticles'] ?? [];
    $subTopics = $data['subTopics'] ?? [];
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
</head>
<body>
    <?php include 'includes/navigation.php'; ?>
    <section class="flex gap-5 bg-[#2D3748] pt-10 pb-20 md:px-30 px-10">
        <div class="text-white gap-5">
            <p class="text-5xl font-bold"><?php echo htmlspecialchars($mainTopic); ?></p>
            <p class="text-lg text-gray-400 mt-3"><?php echo htmlspecialchars($description); ?></p>

            <div class="bg-[#1A212B] px-8 py-5 rounded-lg my-5">
                <p class="text-lg text-white font-bold mb-2">Table of Contents</p>
                <ul class="text-white list-disc ml-5">
                    <?php foreach ($subTopics as $sub): ?>
                        <li><a href="#<?php echo urlencode(strtolower(str_replace(' ', '-', $sub['title']))); ?>" class="text-blue-400 hover:underline"><?php echo htmlspecialchars($sub['title']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="text-white py-5 prose prose-invert max-w-none">
                <?php echo $mainContent; ?>
            </div>

            <?php foreach ($subTopics as $sub): ?>
                <p id="<?php echo urlencode(strtolower(str_replace(' ', '-', $sub['title']))); ?>" class="text-2xl text-white font-bold py-4"><?php echo htmlspecialchars($sub['title']); ?></p>
                <div class="text-white py-5 prose prose-invert max-w-none">
                    <?php echo $sub['content']; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="min-w-[25vw]">
            <div class="bg-[#1A212B] px-8 py-5 rounded-lg">
                <p class="text-lg text-white font-bold mb-2">Related Articles</p>
                <ul class="text-white list-disc ml-5">
                    <?php foreach ($relatedArticles as $article): ?>
                        <li><a href="<?php echo htmlspecialchars($article['link']); ?>" class="text-blue-400 hover:underline"><?php echo htmlspecialchars($article['title']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
    <?php include 'includes/footer.php'; ?>
    <script src="script/index.js"></script>
</body>
</html>
