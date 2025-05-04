<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])) {
        header('Location: pages/login.php');
        exit();
    }
?>

<div class="space-y-10 md:pr-120">    
    <div class="text-white">
        <p class="mb-5 text-2xl font-bold">Data and Privacy</p>
        <p class="mb-5">We use your data to operate essential features—like saving preferences and displaying your content. You can stop this at any time by disabling or deleting your account.</p>
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