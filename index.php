<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Club Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📚 Welcome to the Group 7 Book Club! 📚</h1>
    </header>

    <nav>
        <a href="index.php">🏠 Home</a>
        <?php
        if(isset($_SESSION['user_id'])) {
            echo '<a href="dashboard.php">📊 Dashboard</a>';
            echo '<a href="logout.php">🚪 Logout</a>';
        } else {
            echo '<a href="login.php">🔑 Login</a>';
            echo '<a href="register.php">📝 Register</a>';
        }
        ?>
    </nav>

    <main>
        <h2>Join Our Reading Community!</h2>
        
        <div style="display: flex; gap: 30px; margin-top: 30px;">
            <!-- Left column -->
            <div style="flex: 1; background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
                <h3 style="color: #ff6b35;">📖 About Our Club</h3>
                <p>We're a group of university students who meet every week to discuss amazing books!</p>
                <ul style="margin-top: 15px;">
                    <li>✅ Meet new friends</li>
                    <li>✅ Read great books</li>
                    <li>✅ Fun discussions</li>
                    <li>✅ Item 13 massively assured! </li>
                </ul>
            </div>
            
            <!-- Right column -->
            <div style="flex: 1; background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
                <h3 style="color: #ff6b35;">📅 This Month's Book</h3>
                <p><strong>"Backend Web Development"</strong> by Mrs Mercy Vicentia Adu Gyamfi</p>
                <p>Meeting: Every Saturday at 3 PM</p>
                <p>Location: KSTU Main Library</p>
                
                <?php
                // SWITCH STATEMENT - shows message based on day
                $today = date("l");
                switch($today) {
                    case "Saturday":
                        echo "<p style='color: #06d6a0; font-weight: bold;'>🎉 Meeting today! See you at 3 PM!</p>";
                        break;
                    case "Sunday":
                        echo "<p style='color: #ff6b35;'>Great meeting yesterday! Next one Saturday.</p>";
                        break;
                    default:
                        echo "<p>Next meeting: Saturday at 3 PM</p>";
                }
                ?>
            </div>
        </div>
        
        <?php if(!isset($_SESSION['user_id'])): ?>
        <div style="text-align: center; margin-top: 40px; padding: 30px; background-color: #2ec4b6; border-radius: 10px; color: white;">
            <h3 style="color: white;">Ready to join? 📚</h3>
            <p style="margin: 15px 0;">Become a member today and get your first book free!</p>
            <a href="register.php" style="background-color: #ff6b35; color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block;">Join Now →</a>
        </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>📚 Book Club &copy; 2024 - Read More, Grow More! 📚</p>
    </footer>
</body>
</html>