<?php
session_start();

$isLoggedIn = isset($_SESSION['username']);
$fullname = $_SESSION['fullname'] ?? ($_SESSION['username'] ?? 'Guest');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Intramurals 2025</title>
  
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>


</head>
<body class="bg-gray-50 text-gray-800">


<nav class="bg-[#B02A24] text-white p-4">
    <div class="container mx-auto flex justify-between items-center">

      
        <div class="flex items-center space-x-2">
        <img src="img/um.png" alt="College Logo" class="h-10 w-10">
        <span class="font-bold text-xl">UM Intramurals</span>
        </div>

        
      
        <ul class="flex space-x-8 font-semibold text-lg flex-1 justify-center">
            <li><a href="#home" class="hover:underline hover:text-yellow-400 transition">Home</a></li>
            <li><a href="#events" class="hover:underline hover:text-yellow-400 transition">Events</a></li>
            <li><a href="#about" class="hover:underline hover:text-yellow-400 transition">About</a></li>
        </ul>


        <div>
            <?php if ($isLoggedIn): ?>
                <a href="logout.php" 
                   class="flex items-center justify-center w-10 h-10 bg-[#B02A24] hover:bg-[#8A1F1B] text-white rounded-full 
                          text-2xl transition transform hover:scale-110" title="Logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            <?php else: ?>
                <a href="login.php" 
                   class="flex items-center justify-center w-10 h-10 bg-[#B02A24] hover:bg-[#8A1F1B] text-white rounded-full 
                          text-2xl transition transform hover:scale-110" title="Login">
                    <i class="fa-solid fa-user"></i>
                </a>
            <?php endif; ?>
        </div>


    </div>
</nav>


<!-- Section 1: Home -->
<header 
    id="home" 
    class="relative text-center py-32 text-white bg-cover bg-center" 
    style="background-image: url('img/bg.jpg');"
>
  
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

   
<div class="relative z-10 max-w-2xl mx-auto">
    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 drop-shadow-lg 
               bg-clip-text text-transparent bg-gradient-to-r from-[#F7D517] via-[#B02A24] to-[#F7D517]">
        Welcome to Intramurals 2025!
    </h1>
</div>
        
<p class="text-xl md:text-2xl mb-8 drop-shadow-lg max-w-3xl mx-auto text-white">
    GA! Join the excitement! Celebrate sports, teamwork, and school spirit with your classmates at Intramurals 2025!
</p>


       <a href="login.php" 
   class="inline-block mt-4 bg-[#B02A24] text-white px-6 py-3 rounded-full text-lg font-semibold 
          shadow-md hover:shadow-yellow-400/50
 hover:shadow-lg transform hover:scale-105 transition-all duration-300">
    Let the games begin!
</a>

    </div>
</header>




    <!-- Section 2: Events -->
<section id="events" class="py-20 px-8 bg-gray-50">
    <h2 class="text-3xl font-extrabold mb-12 text-center text-[#B02A24]">Intramural Events</h2>

   
    <div class="flex space-x-6 overflow-x-auto scrollbar-hide px-4">

<div class="min-w-[250px] h-72 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300 flex-shrink-0 relative overflow-hidden">
    <img src="img/basketball.jpg" alt="Basketball" class="absolute inset-0 w-full h-full object-cover">
    
  
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>


    <div class="relative z-10 p-4 flex flex-col justify-end h-full">
        <h3 class="text-xl font-semibold text-white mb-2">Basketball Tournament</h3>
        <p class="text-white text-sm">Compete in thrilling matches with your classmates and showcase your skills.</p>
    </div>
</div>


 


<div class="min-w-[250px] h-72 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300 flex-shrink-0 relative overflow-hidden">
    
    <img src="img/volleyball.jpg" alt="Volleyball" class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

  
    <div class="relative z-10 p-4 flex flex-col justify-end h-full">
        <h3 class="text-xl font-semibold text-white mb-2">Volleyball Matches</h3>
        <p class="text-white text-sm">Form teams and battle it out on the court for glory and fun.</p>
    </div>
</div>



<div class="min-w-[250px] h-72 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300 flex-shrink-0 relative overflow-hidden">
    <img src="img/track.jpg" alt="Track & Field" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 p-4 flex flex-col justify-end h-full">
        <h3 class="text-xl font-semibold text-white mb-2">Track & Field</h3>
        <p class="text-white text-sm">Test your speed, endurance, and teamwork in various track events.</p>
    </div>
</div>


<div class="min-w-[250px] h-72 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300 flex-shrink-0 relative overflow-hidden">
    <img src="img/chess.jpg" alt="Chess" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 p-4 flex flex-col justify-end h-full">
        <h3 class="text-xl font-semibold text-white mb-2">Chess Championship</h3>
        <p class="text-white text-sm">Strategize and outsmart your opponents in this classic board game.</p>
    </div>
</div>


<div class="min-w-[250px] h-72 rounded-2xl shadow-lg hover:scale-105 transform transition duration-300 flex-shrink-0 relative overflow-hidden">
    <img src="img/fun.jpg" alt="Fun Activities" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 p-4 flex flex-col justify-end h-full">
        <h3 class="text-xl font-semibold text-white mb-2">Other Fun Activities</h3>
        <p class="text-white text-sm">Enjoy games, competitions, and activities that bring everyone together.</p>
    </div>
</div>

</section>

<!-- Section 3: About -->
<section id="about" class="relative py-20 px-8 text-center text-white bg-cover bg-center" style="background-image: url('img/umtrack.jpg');">
    

    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="relative z-10">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-10 drop-shadow-md">
            About College Intramurals
        </h2>

  
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
           
            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center hover:scale-105 transform transition duration-300">
                <i class="fa-solid fa-basketball-ball text-4xl text-[#B02A24] mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-gray-800">Exciting Sports</h3>
                <p class="text-gray-700 text-sm text-center">
                    Compete in basketball, volleyball, track, and more. Fun and thrill await every participant!
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center hover:scale-105 transform transition duration-300">
                <i class="fa-solid fa-people-group text-4xl text-[#F7D517] mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-gray-800">Teamwork & Spirit</h3>
                <p class="text-gray-700 text-sm text-center">
                    Build bonds with classmates, support your team, and celebrate collaboration in every event.
                </p>
            </div>

          
            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center hover:scale-105 transform transition duration-300">
                <i class="fa-solid fa-flag text-4xl text-[#B02A24] mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-gray-800">School Pride</h3>
                <p class="text-gray-700 text-sm text-center">
                    Showcase your school spirit, cheer for your classmates, and make memories that last a lifetime.
                </p>
            </div>
        </div>

     
        <a href="login.php" class="inline-block mt-4 bg-[#B02A24] text-white px-8 py-3 rounded-full text-lg font-semibold 
           shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300">
            Join the Games!
        </a>
    </div>
</section>





    <footer class="bg-[#B02A24] text-white text-center p-4">
        <p>&copy; Matugas and Nanding Group. All rights reserved.</p>
    </footer>

  


</body>
</html>