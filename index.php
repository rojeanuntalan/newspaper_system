<?php require_once 'writer/classloader.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Newspaper System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 font-sans">
  <div class="min-h-screen flex flex-col justify-center items-center text-center p-6 relative">

    <img src="https://cdn-icons-png.flaticon.com/128/15558/15558009.png" alt="Writer Icon" class="w-32 h-32 mb-6">

    <h1 class="text-4xl font-extrabold text-purple-800 mb-2 drop-shadow-lg">School Newspaper System</h1>
    <p class="text-lg text-gray-700 mb-8 italic">Write. Share. Learn. Create.</p>

    <div class="flex gap-6">
      <a href="writer/login.php" 
         class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl shadow-lg text-lg font-semibold flex items-center gap-2">
          <img src="https://cdn-icons-png.flaticon.com/128/189/189869.png" alt="writer" class="w-5 h-5">
         <span>Writer Login</span> 
      </a>
      <a href="admin/login.php" 
         class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg text-lg font-semibold flex items-center gap-2">
          <img src="https://cdn-icons-png.flaticon.com/128/3790/3790055.png" alt="admin" class="w-5 h-5">
         <span>Admin Login</span> 
      </a>
    </div>

    <footer class="mt-12 text-sm text-gray-500">
      <span class="inline-flex items-center gap-2">
        <img src="https://cdn-icons-png.flaticon.com/128/15557/15557933.png" alt="Book" class="w-5 h-5">
        <span>Empowering young minds through creativity and learning!</span>
      </span>
    </footer>
  </div>
</body>
</html>