<?php

// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "feedback_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Function to submit feedback
function submitFeedback($user_id, $rating, $comment) {
  global $conn;

  $sql = "INSERT INTO Feedback (user_id, rating, comment)
          VALUES (?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $user_id, $rating, $comment);
  $stmt->execute();

  $stmt->close();
}

// Function to retrieve feedback data
function getFeedback() {
  global $conn;

  $sql = "SELECT f.*, u.username FROM Feedback f
          INNER JOIN Users u ON f.user_id = u.user_id";

  $result = $conn->query($sql);

  $feedback = [];
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $feedback[] = $row;
    }
  }

  return $feedback;
}
?>
