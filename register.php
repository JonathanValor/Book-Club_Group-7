<?php
session_start();

$name = "";
$email = "";
$favorite_book = "";
$error = "";
$success = "";

// USING CONDITIONAL STATEMENTS
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $favorite_book = $_POST['favorite_book'];
    $membership = $_POST['membership'];
    
    // if statement - check name
    if (empty($name)) {
        $error = "Please enter your name";
    }
    // elseif - check email
    elseif (empty($email)) {
        $error = "Please enter your email";
    }
    // elseif - check password
    elseif (empty($password)) {
        $error = "Please create a password";
    }
    // elseif - check password length
    elseif (strlen($password) < 4) {
        $error = "Password must be at least 4 characters";
    }
    // elseif - check passwords match
    elseif ($password != $confirm_password) {
        $error = "Passwords do not match";
    }
    // else - everything is good!
    else {
        
        // if-else for file upload
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
            
            $file_name = $_FILES['profile_pic']['name'];
            $file_tmp = $_FILES['profile_pic']['tmp_name'];
            
            // Create unique filename
            $new_filename = time() . '_' . $file_name;
            
            // Save file
            move_uploaded_file($file_tmp, "uploads/" . $new_filename);
            
            $_SESSION['profile_pic'] = $new_filename;
        } else {
            $_SESSION['profile_pic'] = "default-avatar.jpg";
        }
        
        // Save user info in session
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        $_SESSION['favorite_book'] = $favorite_book;
        $_SESSION['membership'] = $membership;
        
        $success = "🎉 Welcome to the Book Club! You can now login.";
        
        // Clear form
        $name = "";
        $email = "";
        $favorite_book = "";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Join Book Club</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📝 Become a Member 📝</h1>
    </header>
    
    <nav>
        <a href="index.php">🏠 Home</a>
        <a href="login.php">🔑 Login</a>
        <a href="register.php">📝 Register</a>
    </nav>
    
    <main>
        <h2>Join Our Book Club</h2>
        
        <?php if($success != ""): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <?php if($error != ""): ?>
            <div class="error">❌ <?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>📛 Full Name:</label>
                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your full name">
            </div>
            
            <div class="form-group">
                <label>📧 Email:</label>
                <input type="email" name="email" value="<?php echo $email; ?>" placeholder="your@email.com">
            </div>
            
            <div class="form-group">
                <label>🔐 Password:</label>
                <input type="password" name="password" placeholder="Create a password">
            </div>
            
            <div class="form-group">
                <label>🔐 Confirm Password:</label>
                <input type="password" name="confirm_password" placeholder="Re-enter password">
            </div>
            
            <div class="form-group">
                <label>📖 Favorite Book:</label>
                <input type="text" name="favorite_book" value="<?php echo $favorite_book; ?>" placeholder="What's your favorite book?">
            </div>
            
            <div class="form-group">
                <label>⭐ Membership Type:</label>
                <select name="membership">
                    <option value="regular">Regular Member (Free)</option>
                    <option value="premium">Premium Member (50 GHCedis/month)</option>
                    <option value="lifetime">Lifetime Member (500 GHCedis one-time)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>📸 Profile Picture (optional):</label>
                <input type="file" name="profile_pic" accept="image/*">
                <small style="color: #666;">Upload a photo so we know who you are!</small>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Join Book Club! 📚">
            </div>
        </form>
        
        <p style="text-align: center; margin-top: 20px;">
            Already a member? <a href="login.php">Login here</a>
        </p>
    </main>
    
    <footer>
        <p>📚 Read more, grow more! 📚</p>
    </footer>
</body>
</html>