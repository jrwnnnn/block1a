<?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    if (!isset($_SESSION['user_id'])) {
        header('Location: pages/login.php');
        exit();
    }
?>

<div class="space-y-10 md:pr-100">    
    <div class="text-white">
        <p class="mb-5 text-2xl font-bold e">Profile Settings</p>
        <form action="functions/update_profile.php" method="POST" enctype="multipart/form-data" class="space-y-2">
            <div>
                <label for="username" class="block mb-2 text-gray-300">Username</label>
                <input type="text" id="username" name="username" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" value=<?= $_SESSION['username'] ?>>
            </div>
            <div>
                <label for="email" class="block mb-2 text-gray-300">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" value=<?= $_SESSION['email'] ?>>
            </div>
            <button type="submit" class="px-4 py-2 mt-5 bg-blue-500 rounded-lg hover:bg-blue-600 hover:cursor-pointer">Save Changes</button>
        </form>
    </div>
    <div class="text-white">
        <p class="mb-5 text-2xl font-bold">Password</p>
        <p>Please remember your password as there is currently no way to reset it.</p>
        <p class="mb-5 text-sm italic text-gray-300">Last changed: 02/23/2024</p>
        <button id="show-form" onclick="togglePasswordForm();" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 hover:cursor-pointer">Change Password</button>
        <form id="change-password-form" action="functions/update_profile.php" method="POST" enctype="multipart/form-data" class="hidden space-y-2">
            <div class="mb-4">
                <label for="password_current" class="block mb-2 text-gray-300">Current Password</label>
                <input type="password" id="password_current" name="password_current" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2 text-gray-300">New Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block mb-2 text-gray-300">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="w-full px-3 py-2 text-white bg-gray-800 border-2 border-gray-600 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            <button type="submit" class="px-4 py-2 mt-5 text-white bg-blue-500 rounded-lg hover:bg-blue-600 hover:cursor-pointer">Change Password</button>
        </form>
    </div>
    <div class="text-white">
        <p class="mb-5 text-2xl font-bold">Account Removal</p>
        <p>Disabling your account will make it inactive and hide your profile and posts from other users. You can reactivate it by logging back in. Deleting your account is permanent and cannot be undone. All your data, including posts and profile information, will be removed.</p>
        <div class="flex items-start gap-5 mt-5">
            <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600 hover:cursor-pointer">Disable Account</button>
            <button type="submit" class="px-4 py-2 text-red-400 bg-gray-700 rounded-lg hover:bg-gray-600 hover:cursor-pointer">Delete Account</button>
        </div>
    </div>
</div>

    <script>
        function togglePasswordForm() {
            const form = document.getElementById('change-password-form');
            const button = document.getElementById('show-form');
            form.classList.remove('hidden');
            button.classList.add('hidden');
        }
    </script>