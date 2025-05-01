<?php
  session_start();

  include 'connect.php';

  if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
  }

  $data = json_decode(file_get_contents("php://input"), true);
  $baseId = preg_replace('/[^a-z0-9]+/i', '-', strtolower($data['title']));
  $baseId = trim($baseId, '-');
  $counter = 0;
  $finalId = $baseId;
    while (true) {
        $check = $conn->prepare("SELECT COUNT(*) FROM articles WHERE id = ?");
        $check->bind_param("s", $finalId);
        $check->execute();
        $check->bind_result($count);
        $check->fetch();
        $check->close();

        if ($count == 0) break;
        $counter++;
        $finalId = $baseId . '-' . $counter;
    }
  $id = $finalId;
  $title = $data['title'];
  $subtitle = $data['subtitle'];
  $cover = $data['cover'];
  $tag = $data['tag'];
  $spotlight = $data['spotlight'] ? 1 : 0;
  $content = $data['content'];
  $author = $_SESSION['username'];
  $date_posted = date("F j, Y");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("INSERT INTO articles (id, title, subtitle, cover, tag, spotlight, author, date_posted, content)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssisss", $id, $title, $subtitle, $cover, $tag, $spotlight, $author, $date_posted, $content);
  $stmt->execute();
  $stmt->close();
  $conn->close();
  
  echo "posted";
?>
