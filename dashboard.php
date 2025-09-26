<?php
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION['fullname'] ?? $_SESSION['username']; 


// Extract first name safely
$firstName = explode(' ', trim($fullname))[0];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="./output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
</head>

<body class="bg-pink-50 flex min-h-screen font-sans">

<!-- Sidebar 
<aside class="w-64 bg-white/90 backdrop-blur-md shadow-lg h-screen p-6 flex flex-col rounded-tr-2xl rounded-br-2xl"> -->
<aside class="w-64 bg-gray-100/90 backdrop-blur-md shadow-lg h-screen p-6 flex flex-col rounded-tr-xl rounded-br-xl">


  
<!-- Dashboard Heading with Logo -->
<div class="flex items-center mb-6 gap-3">
  <!-- Logo -->
  <img src="img/logo.png" alt="Logo" class="w-10 h-10 rounded-full">

  <!-- Heading Text -->
  <h2 class="text-2xl font-bold text-pink-700">Dashboard</h2>
</div>

<!-- NAVLINK -->
 <nav class="flex-1 space-y-3">
   <a href="#" class="block px-4 py-2 rounded-lg hover:bg-pink-200 text-pink-700 transition"
     onclick="showContent('dashboard', this)">
     <i class="fa-solid fa-house"></i> Home
  </a>
  <a href="#" class="block px-4 py-2 rounded-lg hover:bg-pink-200 text-pink-700 transition" 
     onclick="showContent('menu1', this)">
     <i class="fa-solid fa-face-smile"></i> Menu 1
  </a>
  <a href="#" class="block px-4 py-2 rounded-lg hover:bg-pink-200 text-pink-700 transition"
     onclick="showContent('menu2', this)">
     <i class="fa-solid fa-file"></i> Menu 2
  </a>
  <a href="#" class="block px-4 py-2 rounded-lg hover:bg-pink-200 text-pink-700 transition"
     onclick="showContent('menu3', this)">
     <i class="fa-solid fa-hippo"></i> Menu 3
  </a>
</nav>


  <!-- Logout at the bottom -->
  <div class="mt-auto">
    <a href="logout.php" class="block px-4 py-2 rounded-lg text-white bg-pink-700 hover:bg-pink-800 transition text-center flex items-center justify-center gap-2">
  <i class="fa-solid fa-right-from-bracket"></i>
  Logout
</a>

</aside>


  <!-- Main Content -->
  <main class="flex-1 p-8">
    <h1 class="text-3xl font-bold mb-4 text-pink-600 flex items-center gap-2">
  Welcome, <?= htmlspecialchars($firstName) ?>!
  <img src="img/welcome.png" alt="Flower" class="w-11 h-11">
</h1>


  

    <!-- Dashboard Content Sections -->
 <section class="space-y-6">

    <!-- Main Dashboard -->
    <div id ="dashboard" class="content-section hidden grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-lg hover:scale-105 transition-transform">
        <h3 class="font-semibold mb-2 text-pink-500">👤 Profile</h3>
        <p class="text-gray-600">Update your personal information.</p>
      </div>
      <div class="bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-lg hover:scale-105 transition-transform">
        <h3 class="font-semibold mb-2 text-pink-500">⚙️ Settings</h3>
        <p class="text-gray-600">Manage account preferences and privacy.</p>
      </div>
      <div class="bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-lg hover:scale-105 transition-transform">
        <h3 class="font-semibold mb-2 text-pink-500">🔔 Notifications</h3>
        <p class="text-gray-600">View your latest alerts and updates.</p>
      </div>
    </div>


  <!-- Menu 1 Section -->
  <div id="menu1" class="content-section hidden">
    <h1 class="text-3xl font-bold mb-4 text-pink-600">Menu 1 Content</h1>
    <p>This is the content for Menu 1.</p>
  </div>

  <!-- Menu 2 Section -->
  <div id="menu2" class="content-section hidden">
    <h1 class="text-3xl font-bold mb-4 text-pink-600">Menu 2 Content</h1>
    <p>This is the content for Menu 2.</p>
  </div>

  <!-- Menu 3 Section -->
  <div id="menu3" class="content-section hidden">
    <h1 class="text-3xl font-bold mb-4 text-pink-600">Menu 3 Content</h1>
    <p>This is the content for Menu 3.</p>
  </div>

</section>



  </main>

<script src="dashboard.js"></script>





</body>

</html>
