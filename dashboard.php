<?php
session_start();

// if - protect this page
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get current hour for greeting
$hour = date("H");

// if-elseif-else for greeting
if($hour < 12) {
    $greeting = "Good Morning";
} elseif($hour < 17) {
    $greeting = "Good Afternoon";
} else {
    $greeting = "Good Evening";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Member Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📊 Member Dashboard 📊</h1>
    </header>
    
    <nav>
        <a href="index.php">🏠 Home</a>
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="logout.php">🚪 Logout</a>
    </nav>
    
    <main>
        <h2><?php echo $greeting; ?>, <?php echo $_SESSION['username']; ?>! 👋</h2>
        
        <!-- Member Profile Card -->
        <div class="book-card">
            <h3>📋 Your Member Profile</h3>
            
            <?php if(isset($_SESSION['profile_pic']) && $_SESSION['profile_pic'] != "default-avatar.jpg"): ?>
                <img src="uploads/<?php echo $_SESSION['profile_pic']; ?>" alt="Profile" class="profile-image">
            <?php endif; ?>
            
            <p><strong>📛 Name:</strong> <?php echo $_SESSION['user_name']; ?></p>
            <p><strong>📧 Email:</strong> <?php echo $_SESSION['user_email']; ?></p>
            <p><strong>📖 Favorite Book:</strong> <?php echo $_SESSION['favorite_book']; ?></p>
            <p><strong>⭐ Membership:</strong> <?php echo $_SESSION['membership']; ?></p>
        </div>
        
        <!-- Book Recommendations based on favorite book -->
        <div class="book-card">
            <h3>📚 Book Recommendations</h3>
            
            <?php
            // SWITCH STATEMENT - recommend books based on favorite genre
            $favorite = strtolower($_SESSION['favorite_book']);
            
            switch(true) {
                case strpos($favorite, "harry") !== false:
                case strpos($favorite, "potter") !== false:
                    echo "<p>Since you like Harry Potter, try:</p>";
                    echo "<ul>";
                    echo "<li>✨ 'Percy Jackson' by Rick Riordan</li>";
                    echo "<li>✨ 'His Dark Materials' by Philip Pullman</li>";
                    echo "<li>✨ 'The Hobbit' by J.R.R. Tolkien</li>";
                    echo "</ul>";
                    break;
                    
                case strpos($favorite, "love") !== false:
                case strpos($favorite, "romance") !== false:
                    echo "<p>Romance lovers enjoy:</p>";
                    echo "<ul>";
                    echo "<li>💕 'The Notebook' by Nicholas Sparks</li>";
                    echo "<li>💕 'Pride and Prejudice' by Jane Austen</li>";
                    echo "<li>💕 'Me Before You' by Jojo Moyes</li>";
                    echo "</ul>";
                    break;
                    
                case strpos($favorite, "mystery") !== false:
                case strpos($favorite, "murder") !== false:
                    echo "<p>Mystery fans recommend:</p>";
                    echo "<ul>";
                    echo "<li>🔍 'And Then There Were None' by Agatha Christie</li>";
                    echo "<li>🔍 'The Girl with the Dragon Tattoo'</li>";
                    echo "<li>🔍 'Gone Girl' by Gillian Flynn</li>";
                    echo "</ul>";
                    break;
                    
                default:
                    echo "<p>Based on your taste, you might enjoy:</p>";
                    echo "<ul>";
                    echo "<li>📖 'The Midnight Library' by Matt Haig</li>";
                    echo "<li>📖 'Where the Crawdads Sing' by Delia Owens</li>";
                    echo "<li>📖 'The Alchemist' by Paulo Coelho</li>";
                    echo "</ul>";
            }
            ?>
        </div>
        
        <!-- Upcoming Events -->
        <div class="book-card">
            <h3>📅 Club Events</h3>
            <ul>
                <li>📖 Saturday 3 PM - Book Discussion</li>
                <li>☕ Sunday 11 AM - Coffee & Books</li>
                <li>📖 30-Day Reading Challenge - Starts April 1 </li>
                <li>⭐ Member of the Month - Announced April 5</li>
            </ul>
        </div>
    </main>
    
    <footer>
        <p>📚 Happy reading, <?php echo $_SESSION['username']; ?>! 📚</p>
    </footer>
</body>
</html>