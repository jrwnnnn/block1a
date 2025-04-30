<?php
session_start();
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="src/output.css" rel="stylesheet">
  <title>Block1A - BlueMap</title>
</head>
<body class="min-h-screen flex flex-col">
  <section class="bg-[#1A212B] bg-cover bg-center bg-no-repeat flex flex-col h-screen">
    <?php include 'includes/navigation.php'; ?>
    <div class="flex flex-grow flex-col jusity-center items-center">
      <div id="loading">
        <p class="text-white text-center pt-40">Loading...</p>
      </div>
      <iframe src="https://bluecolored.de/bluemap/#acrana:302:1778:0.81:113.91:0.78:67" class="w-full h-full z-100" onload="document.getElementById('loading').style.display='none';"></iframe>
    </div>
  </section>
  
</body>
</html>