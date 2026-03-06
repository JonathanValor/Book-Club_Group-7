<?php
session_start();

// if - check if already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // if-else - check login
    if(isset($_SESSION['user_name']) && $_SESSION['user_name'] == $username) {
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = $username;
        
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "❌ Wrong name or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Club Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>🔐 Member Login 🔐</h1>
    </header>
    
    <nav>
        <a href="index.php">🏠 Home</a>
        <a href="login.php">🔑 Login</a>
        <a href="register.php">📝 Register</a>
    </nav>
    
    <main>
        <h2>Welcome Back, Reader!</h2>
        
        <?php if($error != ""): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>📛 Your Name:</label>
                <input type="text" name="username" required placeholder="Enter the name you registered with">
            </div>
            
            <div class="form-group">
                <label>🔐 Password:</label>
                <input type="password" name="password" required placeholder="Enter your password">
            </div>
            
            <div class="form-group">
                <input type="submit" value="Login to Book Club 📚">
            </div>
        </form>
        
        <p style="text-align: center; margin-top: 20px;">
            Not a member yet? <a href="register.php">Join the club!</a>
        </p>
    </main>
    
    <footer>
        <p>📚 Read more, grow more! 📚</p>
    </footer>
</body>
</html>