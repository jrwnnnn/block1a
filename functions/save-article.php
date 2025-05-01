<?php
  session_start();

  include 'connect.php';
  if (!isset($_SESSION['username'])) {
    echo "Not logged in.";
    exit;
  }

  $data = json_decode(file_get_contents("php://input"), true);
  $id = $data['id'];
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
  $stmt->bind_param("sssssiiss", $id, $title, $subtitle, $cover, $tag, $spotlight, $author, $date_posted, $content);
  $stmt->execute();
  $stmt->close();
  $conn->close();

  echo "Post saved successfully.";
?>
