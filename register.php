<?php
include 'db.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname         = trim($_POST['fullname'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $username         = trim($_POST['username'] ?? '');
    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    
    if (empty($fullname)) $errors[] = "Full Name is required.";
    if (empty($email)) $errors[] = "Email is required.";
    if (empty($username)) $errors[] = "Username is required.";
    if (empty($password)) $errors[] = "Password is required.";
    if (empty($confirm_password)) $errors[] = "Confirm Password is required.";

    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if ($password && strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    if ($password && $confirm_password && $password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

 
    if (empty($errors)) {
        
        $stmtEmail = $conn->prepare("SELECT 1 FROM users WHERE email = ?");
        $stmtEmail->bind_param("s", $email);
        $stmtEmail->execute();
        $stmtEmail->store_result();
        if ($stmtEmail->num_rows > 0) {
            $errors[] = "Email already exists!";
        }
        $stmtEmail->close();

   
        $stmtUsername = $conn->prepare("SELECT 1 FROM users WHERE username = ?");
        $stmtUsername->bind_param("s", $username);
        $stmtUsername->execute();
        $stmtUsername->store_result();
        if ($stmtUsername->num_rows > 0) {
            $errors[] = "Username already exists!";
        }
        $stmtUsername->close();

   
        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertStmt = $conn->prepare(
                "INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)"
            );
            $insertStmt->bind_param("ssss", $fullname, $email, $username, $hashedPassword);
            $insertStmt->execute();
            $insertStmt->close();

            header("Location: login.php?success=1");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registration</title>
  <link href="./output.css" rel="stylesheet" />
  <link href="styles.css" rel="stylesheet" />
</head>
<body class="h-screen w-screen">
  <div class="relative h-full w-full bg-cover bg-center" style="background-image: url('img/red.jpg');">
    <div class="absolute inset-0 bg-black/50"></div>

    <div class="relative z-10 flex h-full w-full justify-center items-center gap-20 px-10">

   
      <div class="flex-1 flex items-center justify-center logo-area">
        <img src="img/um.png"
             alt="University Logo"
             class="w-2/3 max-w-sm object-contain drop-shadow-2xl" />
      </div>


      <div class="flex-1 flex items-center justify-center">
        <div class="bg-white/90 backdrop-blur-md p-8 rounded-xl shadow-2xl w-full max-w-md">

          <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Create an Account</h2>

          <?php if (!empty($errors)): ?>
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
              <ul class="list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                  <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form action="register.php" method="POST" id="registerForm" class="space-y-4">

            <input type="text" name="fullname" placeholder="Full Name" required
                   value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>"
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 transition">

            <input type="text" name="username" placeholder="Username" required
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 transition">

            <input type="email" name="email" placeholder="Email Address" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 transition">

            <input type="password" name="password" placeholder="Password" required
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 transition">

            <input type="password" name="confirm_password" placeholder="Confirm Password" required
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-pink-500 transition">

            <button type="submit"
                    class="w-full py-3 rounded-xl bg-pink-500 text-white font-semibold hover:bg-pink-600 transition">
              Register
            </button>

            <p class="text-center text-gray-700 mt-2">
              Already have an account?
              <a href="login.php" class="text-pink-500 hover:underline">Login here</a>.
            </p>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>
</html>
