<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../index.php');
        exit();
    } 
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
        <img id="coverPreview" src="" alt="cover" class="w-full max-h-[30vh] object-cover object-center hidden">
        <section class="flex flex-col md:px-30 px-5 py-10 pb-20 text-white bg-[#2D3748]">
            <form id="postForm" class="md:space-y-4 space-y-3">
                <input type="text" id="title" placeholder="Title" class="text-white md:text-6xl text-4xl font-bold w-full focus:outline-none" required autocomplete="off">  
                <input type="text" id="subtitle" placeholder="Subtitle" class="text-white text-2xl w-full focus:outline-none" required autocomplete="off">
                <div class="flex md:flex-row flex-col gap-3">
                    <input type="text" id="cover" placeholder="Cover Image URL" class="bg-gray-800 px-3 py-2 rounded-lg focus:outline-none text-white" required autocomplete="off">
                    <select id="tag" class="bg-gray-800 px-3 py-2 rounded-lg focus:outline-none text-white" >
                        <option value="server_updates">Server Updates</option>
                        <option value="event">Event</option>
                        <option value="game_updates">Game Updates</option>
                        <option value="game_updates">Tech</option>
                    </select>
                </div>
                <textarea id="editor"></textarea>
                <div class="flex items-start justify-between gap-3 md:mt-0 mt-7">
                    <button type="submit" class="bg-yellow-500 text-[#2D3748] text-lg font-bold py-2 px-5 rounded-md hover:bg-[#1A212B] hover:text-white hover:cursor-pointer transition duration-300 ease-in-out"">Post</button>
                    <label for="spotlight" class="flex items-center gap-2 text-white">
                            <input type="checkbox" id="spotlight" class="w-4 h-4 text-blue-500 focus:ring focus:ring-blue-300 rounded">
                            Spotlight
                    </label>
                </div>
            </form>
        </section>
        <?php include 'includes/footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
        <script src="../script/simplemde.js"></script>
        <script>
            const coverInput = document.getElementById("cover");
            const coverPreview = document.getElementById("coverPreview");

            coverInput.addEventListener("input", () => {
                const url = coverInput.value.trim();
                if (url) {
                    coverPreview.src = url;
                    coverPreview.classList.remove("hidden");
                } else {
                    coverPreview.src = "";
                    coverPreview.classList.add("hidden");
                }
            });
        </script>
    </body>
    </html>

