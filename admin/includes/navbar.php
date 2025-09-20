<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #3B82F6, #06B6D4); padding: 0.8rem 2rem; box-shadow: 0 3px 10px rgba(0,0,0,0.15);">
  <a class="navbar-brand font-weight-bold" href="index.php" style="font-size: 1.4rem; color: #FFF; text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">
    🛠 Admin Panel
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item mx-2">
        <a class="nav-link nav-link-custom" href="articles_from_students.php">📄 Pending Articles</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link nav-link-custom" href="articles_submitted.php">✅ Articles Submitted</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link nav-link-custom text-red-200 font-weight-bold" href="login.php">🚪 Logout</a>
      </li>
    </ul>
  </div>
</nav>

<style>
.navbar {
    width: 100%;
}

.navbar-nav .nav-link-custom {
    color: #FFF;
    font-weight: 500;
    padding: 6px 14px;
    border-radius: 10px;
    transition: background-color 0.2s, transform 0.2s;
}

.navbar-nav .nav-link-custom:hover {
    background-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}
</style>
