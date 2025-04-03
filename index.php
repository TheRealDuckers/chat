<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chat App</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px; }
        .chat-box { max-width: 600px; margin: 0 auto; border: 1px solid #ccc; background: #fff; padding: 10px; border-radius: 5px; }
        .message { margin-bottom: 10px; padding: 5px; }
        .username { font-weight: bold; color: #007BFF; }
        .timestamp { font-size: 0.85em; color: #888; }
        .chat-form { margin-top: 15px; }
        input[type="text"] { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 10px; background-color: #007BFF; color: #fff; border: none; border-radius: 5px; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="chat-box">
        <h2>Chat Room</h2>

        <!-- Display messages -->
        <div id="messages">
            <?php
                // Database credentials
                $host = 'sql8.freesqldatabase.com';
                $dbname = 'sql8771054';
                $username = 'sql8771054';
                $password = 'fuhtnH6Znn';
                $port = 3306;

                // Create database connection
                $conn = new mysqli($host, $username, $password, $dbname, $port);

                // Check connection
                if ($conn->connect_error) {
                    die("<p>Connection failed: " . $conn->connect_error . "</p>");
                }

                // Fetch messages
                $sql = "SELECT username, message, timestamp FROM chat_messages ORDER BY timestamp DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='message'>";
                        echo "<span class='username'>" . htmlspecialchars($row['username']) . "</span>: ";
                        echo htmlspecialchars($row['message']);
                        echo " <span class='timestamp'>[" . $row['timestamp'] . "]</span>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No messages yet.</p>";
                }

                $conn->close();
            ?>
        </div>

        <!-- Form to submit new messages -->
        <form class="chat-form" action="chat.php" method="POST">
            <input type="text" name="username" placeholder="Enter your username" required>
            <input type="text" name="message" placeholder="Type your message" required>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
