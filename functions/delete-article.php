<?php
    session_start();
    include 'connect.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!isset($_SESSION['username'])) {
        header('Location: ../index.php');
        exit;
    }

    if (!isset($_GET['id'])) { 
        header('Location: ../news.php');
        exit;
    }

    $article_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->bind_param("s", $article_id);


    if ($stmt->execute()) {
        header('Location: ../news.php');

        $stmt->close();
        $conn->close();
        exit;
    }
?>