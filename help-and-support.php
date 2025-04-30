<?php
session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <title>Block1A - Help and Support</title>
</head>
    <body>
    <?php include 'includes/navigation.php'; ?>
        <section class="flex flex-col items-center justify-center text-white bg-cover bg-center bg-no-repeat min-h-[40vh] px-5" style="background-image: url('assets/bahay-ni-jieben.png')">
            <p class="md:text-6xl text-4xl text-yellow-500 font-bold text-center">Welcome to the Help and Support!</p>
            <p class="text-lg text-center mt-5">Need a hand? You're at the right place!</p>
        </section>
        <section class="bg-[#2D3748] grid md:grid-cols-2 md:px-30 px-5 pt-15 pb-5 gap-10">
            <div class="flex flex-col md:flex-row items-start bg-[#1A212B] p-5 rounded-md shadow-lg text-white">
                <img src="assets/faq.png" alt="faq" class="w-10 md:mx-5 mb-5" style="filter: invert(100%);">
                <div class="flex flex-col space-y-2">
                    <p class="text-2xl font-bold mb-5">Frequently Asked Questions</p>
                    <div class="flex flex-col space-y-2 mb-5">
                        <a href="faq.php?topic=getting-started#how-do-i-join-the-server%3F" class="text-blue-500 hover:underline">How do I join the server?</a>
                        <a href="faq.php?topic=getting-started#how-do-i-join-the-server-on-bedrock-edition%3F" class="text-blue-500 hover:underline">How do I join the server on Bedrock Edition?</a>
                        <a href="#" class="text-blue-500 hover:underline">*Can I play on a bedrock client?</a>
                        <a href="faq.php?topic=getting-started#what-version-of-minecraft-do-i-need%3F" class="text-blue-500 hover:underline">What version of Minecraft do I need?</a>
                        <a href="#" class="text-blue-500 hover:underline">*Do I need a Minecraft License to join?</a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-start bg-[#1A212B] p-5 rounded-md shadow-lg text-white">
                <img src="assets/technical-support.png" alt="technical" class="w-10 md:mx-5 mb-5" style="filter: invert(100%);">
                <div class="flex flex-col space-y-2">
                    <p class="text-2xl font-bold mb-5">Technical</p>
                    <div class="flex flex-col space-y-2 mb-5">
                        <a href="#" class="text-blue-500 hover:underline">Connection lost</a>
                        <a href="#" class="text-blue-500 hover:underline">Unable to connect to world</a>
                        <a href="#" class="text-blue-500 hover:underline">VPN or Proxy Detected</a>
                        <a href="#" class="text-blue-500 hover:underline">We couldn't validate your login</a>
                        <a href="#" class="text-blue-500 hover:underline">Maintenance Mode</a>
                        <a href="#" class="text-blue-500 hover:underline">Outdated client</a>
                        <a href="#" class="text-blue-500 hover:underline">Invalid IP Address</a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-start bg-[#1A212B] p-5 rounded-md shadow-lg text-white">
                <img src="assets/auction.png" alt="fairplay" class="w-10 md:mx-5 mb-5" style="filter: invert(100%);">
                <div class="flex flex-col space-y-2">
                    <p class="text-2xl font-bold mb-5">Fairplay</p>
                    <div class="flex flex-col space-y-2 mb-5">
                        <a href="faq.php?topic=fairplay#what-are-the-rules%3F" class="text-blue-500 hover:underline">What are the rules?</a>
                        <a href="faq.php?topic=fairplay#i%27ve-been-banned%2Fmuted-—-what-now%3F" class="text-blue-500 hover:underline">I've been banned/muted/jailed</a>
                        <a href="faq.php?topic=fairplay#ban-appeals" class="text-blue-500 hover:underline">Ban Appeals</a>
                        <a href="faq.php?topic=fairplay#someone-griefed-my-base%21" class="text-blue-500 hover:underline">Someone griefed my base!</a>
                        <a href="#" class="text-blue-500 hover:underline">*How do I report rulebreakers?</a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-start bg-[#1A212B] p-5 rounded-md shadow-lg text-white">
                <img src="assets/sword.png" alt="gameplay" class="w-10 md:mx-5 mb-5" style="filter: invert(100%);">
                <div class="flex flex-col space-y-2">
                    <p class="text-2xl font-bold mb-5">Gameplay</p>
                    <div class="flex flex-col space-y-2 mb-5">
                        <a href="#" class="text-blue-500 hover:underline">How do I use /tpa?</a>
                        <a href="#" class="text-blue-500 hover:underline">How do I use /skin?</a>
                        <a href="#" class="text-blue-500 hover:underline">What is the shattered wilds?</a>
                        <a href="#" class="text-blue-500 hover:underline">Why can't I sleep?</a>
                        <a href="#" class="text-blue-500 hover:underline"></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-[#2D3748] md:px-30 px-5 pb-20 pt-5">
            <div class="flex md:flex-row flex-col justify-between items-center bg-[#1A212B] py-5 px-10 rounded-md shadow-lg text-white">
                <div>
                    <p class="text-2xl font-bold">Still need help?</p>
                    <p class="text-lg">Can't find the answer to your question? Contact our support.</p>
                </div>
                <button onclick="window.location.href='contact.php';" class="bg-yellow-500 text-[#2D3748] text-lg font-bold py-2 px-5 md:mt-0 mt-10 rounded-md hover:bg-[#3a4d60] hover:text-white hover:cursor-pointer transition duration-300 ease-in-out">Contact us</button>
            </div>
            <img src="assets/wp6206419.webp" alt="faq" class="w-full mt-20 max-h-[40vh] object-cover object-center">
        </section>
        <?php include 'includes/footer.php'; ?>
        
    </body>
</html>