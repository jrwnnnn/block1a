<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../src/output.css" rel="stylesheet">
  <title>Block1A - Login</title>
</head>
<body>
    <body class="min-h-screen flex flex-col">
        <section class="bg-[url(../assets/2login-bg.jpg)] bg-cover bg-center bg-no-repeat flex flex-col item-center justify-center min-h-screen md:px-100 px-5">
            <div class="bg-[#1a202a] flex flex-col rounded-md p-8">
                <div class="flex flex-row items-start justify-between pb-7">
                    <p class="text-white text-2xl font-bold">Login to Your Account</p>
                    <img src="../assets/cs1a.png" alt="logo" class="w-20">
                </div>
                <form id="loginForm" class="space-y-4" method="POST" action="/login">
                    <div>
                        <label for="username" class="block text-sm font-medium text-white">Username</label>
                        <input type="text" id="username" name="username" class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-white">Password</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full p-3 py-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="rememberMe" name="rememberMe" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-600 rounded">
                            <label for="rememberMe" class="ml-2 block text-sm text-white">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
                </form>
            </div>
        </section>
    </body>
    </html>