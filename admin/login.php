<?php
// Start session before any output
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Login</title>
  </head>
  <body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-blue-100 to-cyan-100">
    
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl text-gray-800">
      <!-- Header -->
      <div class="rounded-t-2xl px-6 py-6 text-center bg-gradient-to-r from-indigo-500 to-blue-500">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin Icon" class="w-16 mx-auto mb-2">
        <h2 class="text-2xl font-bold text-white">Admin Login</h2>
        <p class="mt-1 text-sm text-white/90">Welcome back, Admin 👨‍💻</p>
      </div>

      <!-- Form -->
      <form action="core/handleForms.php" method="POST" class="px-6 py-8">
        <?php  
        if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
          $msg = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8');
          if ($_SESSION['status'] == "200") {
            echo "<p class='text-green-600 font-semibold mb-4'>{$msg}</p>";
          } else {
            echo "<p class='text-red-600 font-semibold mb-4'>{$msg}</p>";
          }
          unset($_SESSION['message']);
          unset($_SESSION['status']);
        }
        ?>

        <div class="mb-4">
          <label class="block mb-1 font-medium">Email</label>
          <input type="email" name="email" required
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
        </div>

        <div class="mb-6">
          <label class="block mb-1 font-medium">Password</label>
          <input type="password" name="password" required
                 class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
        </div>

        <button type="submit" name="loginUserBtn"
                class="w-full py-3 rounded-lg bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition">
          Login
        </button>

        <p class="mt-6 text-center text-sm">
          Don’t have an account?  
          <a href="register.php" class="text-indigo-600 hover:underline font-medium">Register here</a>
        </p>
      </form>
    </div>
  </body>
</html>
