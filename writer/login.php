<?php
// Start session before any output
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Writer Login</title>
  </head>
  <body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100">
    
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl text-gray-800">
      <!-- Header -->
      <div class="rounded-t-2xl px-6 py-6 text-center bg-gradient-to-r from-purple-400 to-pink-400">
        <img src="https://cdn-icons-png.flaticon.com/128/1154/1154473.png" alt="Writer Icon" class="w-16 mx-auto mb-2">
        <h2 class="text-2xl font-bold text-white">Writer Login</h2>
        <p class="mt-1 text-sm text-white/90">Access your writer dashboard ✨</p>
      </div>

      <!-- Form -->
      <form action="core/handleForms.php" method="POST" class="px-6 py-8">
        <?php
        if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
          $msg = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8');
          if ($_SESSION['status'] === "200") {
            echo "<p class='text-green-600 font-semibold mb-4'>{$msg}</p>";
          } else {
            echo "<p class='text-red-600 font-semibold mb-4'>{$msg}</p>";
          }
          unset($_SESSION['message'], $_SESSION['status']);
        }
        ?>

        <div class="mb-4">
          <label class="block mb-1 font-medium">Email</label>
          <input type="email" name="email" required 
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

        <div class="mb-6">
          <label class="block mb-1 font-medium">Password</label>
          <input type="password" name="password" required 
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

        <button type="submit" name="loginUserBtn" 
                class="w-full py-3 rounded-lg bg-purple-500 text-white font-bold hover:bg-purple-600 transition">
          Login
        </button>

        <p class="mt-6 text-center text-sm">
          Don’t have an account yet?  
          <a href="register.php" class="text-purple-600 hover:underline font-medium">Register here!</a>
        </p>
      </form>
    </div>
  </body>
</html>
