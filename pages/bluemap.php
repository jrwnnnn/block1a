<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../src/output.css" rel="stylesheet">
  <title>Block1A - BlueMap</title>
</head>
<body>
    <body class="min-h-screen flex flex-col">
        <section class="bg-[#1A212B] bg-cover bg-center bg-no-repeat flex flex-col h-screen">
            <nav class="bg-[#1A212B] p-4 px-5 md:px-30 flex items-center justify-between">
                <img src="../assets/cs1a.png" alt="logo" class="w-20  hover:cursor-pointer" onclick="window.location.replace('index.php')">
                
                <button id="menu-toggle" class="md:hidden text-white focus:outline-none">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                       viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                  </svg>
                </button>
              
                <div id="nav-links"
                     class="hidden md:grid md:grid-cols-7 absolute md:static top-20 left-0 w-full md:w-auto bg-[#1A212B] text-center md:flex-row md:space-x-4 transition-all duration-300 ease-in-out z-10">
                  <a href="../index.php" class="nav-tab block py-2 md:inline">Home</a>
                  <a href="blog.php" class="nav-tab block py-2 md:inline">Blog</a>
                  <a href="preamble.html" class="nav-tab block py-2 md:inline">Rules</a>
                  <a href="bluemap.php" class="nav-tab block py-2 md:inline">BlueMap</a>
                  <a href="../404.php" class="nav-tab block py-2 md:inline">Playpass</a>
                  <a href="../404.php" class="nav-tab block py-2 md:inline">Help and Support</a>
                  <a href="signup.php" class="nav-tab block py-2 md:inline">Me</a>
                </div>
              </nav>
            <div class="flex flex-grow flex-col jusity-center items-center">
                <div id="loading">
                    <p class="text-white text-center pt-40">Loading...</p>
                </div>
                <iframe src="https://bluecolored.de/bluemap/#acrana:302:1778:0.81:113.91:0.78:67" class="w-full h-full z-100" onload="document.getElementById('loading').style.display='none';"></iframe>
            </div>
        </section>
    </body>
    </html>
    <script src="script/index.js"></script>
</body>
</html>