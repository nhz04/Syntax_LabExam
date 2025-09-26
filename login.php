<?php
session_start();
include 'db.php';

$errors = [];
$success = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

  
    if(empty($username)) $errors[] = "Username is required.";
    if(empty($password)) $errors[] = "Password is required.";

    if(empty($errors)) {
       
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if(password_verify($password, $user['password'])) {
               
                $_SESSION['username'] = $user['username'];
                $_SESSION['fullname'] = $user['fullname'];

             
            header("Location: dashboard.php");
            exit;

            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "Username not found.";
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="./output.css" rel="stylesheet">
</head>

<body class="h-screen w-screen">
    <div class="relative h-full w-full bg-cover bg-center" 
        style="background-image: url('img/pink.jpg');">

    <div class="absolute inset-0 bg-black/50">
    </div>

   <div class="relative z-10 flex items-center justify-center h-full"> 
        <div class="bg-white/90 backdrop-blur-md p-8 rounded-xl shadow-2xl w-full max-w-md">


     
        <form action="login.php" method="POST" class="space-y-4">
          <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Login</h1>

      
          <?php if(!empty($errors)): ?>
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
              <ul class="list-disc list-inside">
                <?php foreach($errors as $error): ?>
                  <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

      
          <?php if(!empty($success)): ?>
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
              <?= $success ?>
            </div>
          <?php endif; ?>


        <!-- Username -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" required
                   class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-500">
        </div>

        <!-- Password -->
        <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <div class="relative">
        <input type="password" name="password" id="password" required
                     class="w-full px-3 py-2 rounded-lg border border-gray-300 
                     focus:outline-none focus:ring-2 focus:ring-pink-500 pr-10">

        <!-- Toggle Button -->
        <button type="button" id="togglePassword" 
              class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">

        <!-- Eye Icon (show password) -->
        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" 
            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 
                    4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>

        <!-- Eye Off Icon (hide password, hidden by default) -->
        <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" 
            class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 
                    0-8.268-2.943-9.542-7a9.953 
                    9.953 0 012.042-3.362M6.1 
                    6.1A9.953 9.953 0 0112 5c4.478 
                    0 8.268 2.943 9.542 7a9.953 
                    9.953 0 01-4.154 4.568M6.1 
                    6.1L3 3m3.1 3.1L21 21" />
        </svg>
    </button>
  </div>
</div>

          <!-- Submit -->
          <button type="submit"
                  class="w-full bg-pink-500 text-white font-semibold py-2 rounded-lg shadow hover:bg-pink-600 transition">
            Login
          </button>
        </form>

        <!-- Register link -->
        <p class="mt-4 text-center text-gray-600">
          Don’t have an account?
          <a href="register.php" class="text-pink-500 font-medium hover:underline">Register</a>
        </p>
      </div>
    </div>
  </div>


<script src="login.js"></script>

</body>
</html>
