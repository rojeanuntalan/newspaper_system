<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-md px-4 py-3 rounded-b-2xl" 
     style="background: linear-gradient(90deg, #fceabb, #f8b500); font-family: 'Comic Neue', cursive;">
  <a class="navbar-brand flex items-center gap-2 text-xl font-bold text-purple-700 drop-shadow-sm" href="index.php">
    📖 Writer Panel
  </a>

  <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" 
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav items-center gap-2">
      <li class="nav-item">
        <a class="nav-link px-3 py-2 rounded-lg bg-white/60 text-blue-800 font-semibold hover:bg-blue-200 transition shadow-sm" 
           href="index.php">
          🏠 Home
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-3 py-2 rounded-lg bg-white/60 text-orange-800 font-semibold hover:bg-orange-200 transition shadow-sm" 
           href="articles_submitted.php">
          ✍️ Articles Submitted
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-3 py-2 rounded-lg bg-white/60 text-pink-800 font-semibold hover:bg-pink-200 transition shadow-sm" 
           href="shared_articles.php">
          🗂️ Shared Articles
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-3 py-2 rounded-lg bg-white/60 text-green-800 font-semibold hover:bg-green-200 transition shadow-sm" 
           href="edit_request.php">
          ✏️ Edit Requests
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-3 py-2 rounded-lg bg-white/60 text-red-800 font-semibold hover:bg-red-200 transition shadow-sm" 
           href="core/handleForms.php?logoutUserBtn=1">
          🚪 Logout
        </a>
      </li>
    </ul>
  </div>
</nav>

<!-- Add Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
