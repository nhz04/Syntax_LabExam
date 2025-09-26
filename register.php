<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $gender = $_POST['gender'] ?? null;
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
    $country = $_POST['country'] ?? '';

    $errors = [];

    if(empty($fullname)) $errors[] = "Full Name is required.";
    if(empty($email)) $errors[] = "Email is required.";
    if(empty($username)) $errors[] = "Username is required.";
    if(empty($password)) $errors[] = "Password is required.";
    if(empty($confirm_password)) $errors[] = "Confirm Password is required.";
    if(empty($gender)) $errors[] = "Gender is required.";
    if(empty($country)) $errors[] = "Country is required.";

    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if(!empty($password) && strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }
    if(!empty($password) && !empty($confirm_password) && $password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if(empty($errors)) {
        // Check duplicate email
        $stmtEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmtEmail->bind_param("s", $email);
        $stmtEmail->execute();
        $resultEmail = $stmtEmail->get_result();
        if($resultEmail->num_rows > 0){
            $errors[] = "Email already exists!";
        }
        $stmtEmail->close();

        // Check duplicate username
        $stmtUsername = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmtUsername->bind_param("s", $username);
        $stmtUsername->execute();
        $resultUsername = $stmtUsername->get_result();
        if($resultUsername->num_rows > 0){
            $errors[] = "Username already exists!";
        }
        $stmtUsername->close();

        // Insert user if no errors
        if(empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $hobbiesStr = implode(", ", $hobbies);
            $insertStmt = $conn->prepare(
                "INSERT INTO users (fullname, email, username, password, gender, hobbies, country) VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            $insertStmt->bind_param("sssssss", $fullname, $email, $username, $hashedPassword, $gender, $hobbiesStr, $country);
            $insertStmt->execute();
            $insertStmt->close();
            $success = "Registration successful! You can now <a href='login.php'>login</a>.";
            
            
            header("Location: login.php?success=1");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link href="./output.css" rel="stylesheet">
</head>
<body class="h-screen w-screen">
  <!-- Background Image -->
  <div class="relative h-full w-full bg-cover bg-center" style="background-image: url('img/red.jpg');">
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Centered registration card -->
    <div class="relative z-10 flex items-center justify-center h-full">
      <div class="bg-white/90 backdrop-blur-md p-8 rounded-xl shadow-2xl w-full max-w-2xl">

        <!-- Heading -->
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Create an Account</h2>

        <!-- Error Messages -->
        <?php if(!empty($errors)): ?>
          <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
              <?php foreach($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <!-- Success Message -->
        <?php if(!empty($success)): ?>
          <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            <?= $success ?>
          </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form action="register.php" method="POST" id="registerForm" class="space-y-4">

          <!-- Full Name + Username -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="fullname" placeholder="Full Name" required
                   value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>"
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
            <input type="text" name="username" placeholder="Username" required
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
          </div>

          <!-- Email -->
          <input type="email" name="email" placeholder="Email Address" required
                 value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                 class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">

          <!-- Password + Confirm Password -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="password" name="password" placeholder="Password" required
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
          </div>

          <!-- Gender + Country -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center gap-4">
              <label class="flex items-center gap-2">
                <input type="radio" name="gender" value="Male" required
                       <?= (($_POST['gender'] ?? '') === "Male") ? 'checked' : '' ?> >
                Male
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" name="gender" value="Female" required
                       <?= (($_POST['gender'] ?? '') === "Female") ? 'checked' : '' ?> >
                Female
              </label>
            </div>
            <select name="country" required
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
              <option value="">--Select Country--</option>
              <?php 
              $countries = ["Philippines","USA","Canada","Australia","United Kingdom","Japan","Germany","France","India","China","Brazil","Mexico","South Korea","Singapore","United Arab Emirates"];
              foreach ($countries as $c): ?>
                <option value="<?= $c ?>" <?= (($_POST['country'] ?? '') === $c) ? 'selected' : '' ?>><?= $c ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Hobbies -->
          <div class="flex flex-wrap gap-3">
            <?php
              $hobbyOptions = ["Coding","TikTok","Gaming","Reading","Sports","Music","Traveling","Cooking"];
              foreach($hobbyOptions as $hobby): ?>
              <label class="flex items-center gap-2">
                <input type="checkbox" name="hobbies[]" value="<?= $hobby ?>"
                       <?= (isset($_POST['hobbies']) && in_array($hobby, $_POST['hobbies'])) ? 'checked' : '' ?>>
                <?= $hobby ?>
              </label>
            <?php endforeach; ?>
          </div>

          <!-- Register Button -->
          <button type="submit"
                  class="w-full py-3 rounded-xl bg-pink-500 text-white font-semibold hover:bg-pink-600 transition">
            Register
          </button>

          <!-- Login Link -->
          <p class="text-center text-gray-700 mt-2">
            Already have an account? 
            <a href="login.php" class="text-pink-500 hover:underline">Login here</a>.
          </p>

        </form>

      </div>
    </div>
  </div>


</body>
</html>
