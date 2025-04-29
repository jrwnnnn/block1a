<?php

$grid7 = "Login"; // Default value

if (isset($_SESSION['user_id'])) {
    $grid7 = "Profile";
    $grid7_link = "profile.php";
} else {
    $grid7_link = "pages/login.php";
}
?>

<nav class="bg-[#1A212B] p-4 px-5 md:px-30 flex items-center justify-between">
    <img src="assets/cs1a.png" alt="logo" class="w-20 hover:cursor-pointer" onclick="window.location.replace('index.php')">
    
    <button id="menu-toggle" class="md:hidden text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
    
    <div id="nav-links" class="hidden md:grid md:grid-cols-6 absolute md:static top-19.5 left-0 w-full md:w-auto bg-[#1A212B] text-center md:flex-row md:space-x-4 transition-all duration-300 ease-in-out z-10">
        <a href="index.php" class="nav-tab block py-2 md:inline">Home</a>
        <a href="blog.php" class="nav-tab block py-2 md:inline">Blog</a>
        <a href="rules.php" class="nav-tab block py-2 md:inline">Rules</a>
        <a href="bluemap.php" class="nav-tab block py-2 md:inline">BlueMap</a>
        <a href="404.php" class="nav-tab block py-2 md:inline">Playpass</a>
        <a href="404.php" class="nav-tab block py-2 md:inline">Help and Support</a>
        <a href="<?php echo $grid7_link; ?>" class="nav-tab block py-2 md:inline"><?php echo $grid7; ?></a>
    </div>
</nav>