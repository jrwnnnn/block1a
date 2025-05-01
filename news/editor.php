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
        <section class="flex flex-col md:px-30 px-5 py-10 pb-20 text-white bg-[#2D3748]">
            <form id="postForm" class="space-y-4">
                <input type="text" id="title" placeholder="Title" class="text-white text-6xl font-bold w-full focus:outline-none" required autocomplete="off">  
                <input type="text" id="subtitle" placeholder="Subtitle" class="text-white text-2xl w-full focus:outline-none" required autocomplete="off">
                <div class="flex gap-3">
                    <input type="text" id="cover" placeholder="Cover Image URL" class="bg-gray-800 px-3 rounded-lg focus:outline-none text-white" required autocomplete="off"><br>
                    <select id="tag" class="bg-gray-800 px-3 py-2 rounded-lg focus:outline-none text-white" >
                        <option value="server_updates">Server Updates</option>
                        <option value="event">Event</option>
                        <option value="game_updates">Game Updates</option>
                    </select>
                </div>
                <textarea id="editor"></textarea>
                <div class="flex items-start justify-between gap-3">
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
    </body>
    </html>

