<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
    <title>Block1A - Blog</title>
</head>
    <body>
        <nav class="bg-[#1A212B] p-4 px-5 md:px-30 flex items-center justify-between">
            <img src="../assets/cs1a.png" alt="logo" class="w-20 hover:cursor-pointer" onclick="window.location.replace('../index.php')">
            
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
        <section class="flex flex-col items-center justify-center text-white bg-[url(../assets/7BjxfxL.png)] bg-cover bg-center bg-no-repeat min-h-[40vh] px-5">
            <p class="text-6xl text-yellow-500 font-bold">Blog</p>
            <p class="text-lg text-center mt-5">The Official Blog of Block1A! Stay tuned for updates and events.</p>
        </section>
        <section class="flex items-center justify-center bg-[#2D3748] md:px-30 px-5 pt-5">
            <button onclick="window.location.replace('../404.php')" class="bg-yellow-500 text-[#2D3748] text-lg font-bold py-2 px-5 rounded-md mt-5 hover:bg-[#1A212B] hover:text-white hover:cursor-pointer transition duration-300 ease-in-out flex-grow">Create Post</button>
        </section>
        <section class="bg-[#2D3748] grid md:grid-cols-3 md:px-30 px-5 py-15 gap-10">
            <div>
                <img src="../assets/bahay-ni-jieben.png" alt="cover" class="mb-5 rounded-md ">
                <p class="text-green-500 text-md">Blog</p>
                <p class="article-title">Screenshot Dump – March Builds Edition</p>
                <p class="article-subtext">No words, just vibes. Here’s a bunch of screenshots showing off what the community’s been building lately. You might even spot your own creation.</p>
                <p class="text-gray-400 pt-5">March 15, 2025</p>
            </div>
            <div onclick="window.location.replace('../articles/perf-report-mar25.html')" class="hover:cursor-pointer">
                <img src="../assets/spark.jpg" alt="cover" class="mb-5 rounded-md ">
                <p class="text-green-500 text-md">Blog</p>
                <p class="article-title">Monthly Server Performance Report - March 2025</p>
                <p class="article-subtext">March 2025 Server Performance Report: A Smooth Month with Fewer Lag Spikes and Optimized Gameplay</p>
                <p class="text-gray-400 pt-5">March 15, 2025</p>
            </div>
            <div onclick="window.location.replace('../articles/patch-2-25-9.html')" class="hover:cursor-pointer">
                <img src="../assets/wallpaper_minecraft_caves_cliffs(part1)_1920x1080.png" alt="cover" class="mb-5 rounded-md ">
                <p class="text-orange-500 text-md">Patch Notes</p>
                <p class="article-title">Patch 2.25.9</p>
                <p class="article-subtext">Auto-planting saplings, fiery creepers, CS1A Bot joins the chat, mention pings, and more in Update 2.25.9.</p>
                <p class="text-gray-400 pt-5">March 15, 2025</p>
            </div>
        </section>
        <footer class="bg-[#1A212B] flex flex-col items-center justify-center">
            <div class="social-icons flex justify-center items-center mt-7 gap-10">
                <img src="../assets/social_icons/twitter.png" alt="twitter" class="w-9 hover:cursor-pointer" onclick="window.open('https://x.com')">
                <img src="../assets/social_icons/discord.png" alt="discord" class="w-10 hover:cursor-pointer" onclick="window.open('https://discord.gg')">
                <img src="../assets/social_icons/instagram.png" alt="instagram" class="w-10 hover:cursor-pointer" onclick="window.open('https://www.instagram.com')">
            </div>
            <div class="flex flex-col justify-center items-center my-7 md:mx-0 mx-5">
                <p class="text-sm text-white text-center">© 2020-2025, Block1A Server - All rights reserved.</p>
                <p class="text-sm text-white text-center">Not affiliated with Mojang, AB. Nor should we be considered a server endorsed by Mojang, AB.</p>
            </div>
        </footer>
        <script src="../script/index.js"></script>
    </body>
</html>