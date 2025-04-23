<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <title>Block1A - 404</title>
</head>
<body>
  <section class="flex flex-col bg-[#2D3748] bg-cover bg-center bg-no-repeat min-h-screen">
    <?php include 'includes/navigation.php'; ?>
      <div class="text-white flex flex-col justify-center items-center flex-grow text-center pb-30 md:px-30 px-10">
        <img src="assets/i-am-steve-minecraft.gif" alt="Steve" class="">
        <p class="text-5xl text-center font-bold pb-5 pt-5">I... Am Steve</p>
        <p class="text-lg text-center">Sorry, we're still crafting the page that you are looking for.</p>
        <p class="text-lg text-center">Return to the <a href="index.php" class="text-blue-300">home page</a>.</p>
      </div>
  </section>
  <?php include 'includes/footer.php'; ?>
  <script src="script/index.js"></script>
</body>
</html>