<?php
  session_start();
  $page = $_GET['page'] ?? 'preamble';
  $rules = json_decode(file_get_contents('data/rules.json'), true);

  if (!isset($rules[$page])) {
      header("Location: 404.php");
      exit;
  }
  $current = $rules[$page];

  $pages = array_keys($rules);
  $currentIndex = array_search($page, $pages);
  $prevPage = $pages[$currentIndex - 1] ?? null;
  $nextPage = $pages[$currentIndex + 1] ?? null;
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <title>Block1A - Rules</title>
</head>
<body>
  <div class="flex flex-col">
    <?php include 'includes/navigation.php'; ?>
    <div class="bg-[#2D3748] flex flex-grow md:flex-row flex-col text-white min-h-screen md:px-30 px-5 sidebar">
      <div class="min-w-[20vw] py-10 pr-5 md:border-r-1 md:border-gray-500">
        <div class="flex flex-col text-md space-y-4">
          <?php foreach ($pages as $key): ?>
            <a href="rules.php?page=<?= $key ?>" class="<?= $key === $page ? 'focused' : '' ?>">
              <?= ucwords(str_replace('_', ' ', $key)) ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="md:p-5 mt-5">
        <hr class="md:hidden block border-gray-500 mb-10">
        <p class="md:text-6xl text-5xl font-bold mb-10"><?= htmlspecialchars($current['title']) ?></p>

        <?php foreach ($current['sections'] as $i => $section): ?>
          <p id="sec<?= $i+1 ?>" class="text-2xl font-bold mb-10"><?= htmlspecialchars($section['heading']) ?></p>
          <div class="flex flex-col space-y-4 mb-10">
            <?php foreach ($section['paragraphs'] as $para): ?>
              <p><?= htmlspecialchars($para) ?></p>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>

        <div class="flex md:justify-between flex-col md:flex-row mt-20 mb-10">
          <?php if ($prevPage): ?>
            <button onclick="window.location.replace('rules.php?page=<?= $prevPage ?>')" class="bg-yellow-500 text-[#2D3748] font-bold py-2 px-5 rounded-md mt-5 hover:bg-[#1A212B] hover:text-white transition duration-300">Previous: <?= ucwords(str_replace('_', ' ', $prevPage)) ?></button>
          <?php endif; ?>
          <?php if ($nextPage): ?>
            <button onclick="window.location.replace('rules.php?page=<?= $nextPage ?>')" class="bg-yellow-500 text-[#2D3748] font-bold py-2 px-5 rounded-md mt-5 hover:bg-[#1A212B] hover:text-white transition duration-300">Next: <?= ucwords(str_replace('_', ' ', $nextPage)) ?></button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php include 'includes/footer.php'; ?>
  <script src="script/index.js"></script>
</body>
</html>
