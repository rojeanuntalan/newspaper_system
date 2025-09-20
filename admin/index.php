<?php
require_once 'classloader.php';

if (!$userObj->isLoggedIn()) {
  header("Location: login.php");
  exit;
}

if (!$userObj->isAdmin()) {
  header("Location: ../writer/index.php");
  exit;
}

$notifications = $notificationObj->getNotificationsByUser($_SESSION['user_id']);

$unreadCount = 0;
foreach ($notifications as $notif) {
    if (!$notif['is_read']) $unreadCount++;
}

$notificationObj->markAllAsRead($_SESSION['user_id']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="../images/logo.svg">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { 
      font-family: 'Comic Neue', cursive;
      background-color: #F0F9FF; /* soft sky blue */
    }

    /* Page Heading */
        .display-4 {
        font-weight: 700;
        margin-top: 25px;
        text-align: center;
        color: #FF8C42; /* soft, friendly orange instead of harsh coral */
        font-size: 2.5rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.08); /* softer shadow */
    }
    /* Cards */
    .card {
        background: #FFFCEB; /* warm cream background */
        border-radius: 25px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding: 20px;
        margin-bottom: 30px;
        position: relative;
    }

    /* Card hover effect */
    .card:hover { 
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(0,0,0,0.15);
    }

    /* Card Titles */
    .card h2, .card h1 { 
        font-size: 1.8rem; 
        margin-bottom: 12px;
        color: #FF8C42; /* aligned orange accent */
    }

    /* Paragraphs */
    .card p { 
        color: #333; 
        line-height: 1.6; 
        margin-top: 0.5rem; 
        margin-bottom: 0.5rem; 
    }

    /* Admin alert badge */
    .alert-admin {
        display: block;
        width: fit-content;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        background-color: #FFD966; /* sunny yellow accent */
        color: #333;
        margin-bottom: 10px;
        font-weight: 700;
        text-align: center;
    }

    /* Article images */
    .article-img {
        display: block;
        margin: 15px auto;
        max-width: 90%;
        height: 180px;
        border-radius: 20px;
        border: 3px solid #9EE3F0; /* pastel blue border */
        object-fit: cover; 
    }

    /* Article Icon Container */
    .article-icon-container {
        display: flex;
        align-items: center;
        justify-content: center; 
        gap: 12px;
        margin: 25px auto;      
        max-width: 70%;       
    }

    .article-icon-container .line {
        flex: 1;                
        height: 5px;
        background-color: #9EE3F0; /* pastel blue line */
        border-radius: 3px;
    }

    .article-icon {
        width: 140px;
        height: 90px;
        object-fit: contain;
    }

    /* Modals */
    .modal-content { 
        border-radius: 25px; 
    }

    /* Alerts */
    .alert-warning { 
        background-color: #FFEDD5; /* aligned pastel orange */
        color: #7A4F01; 
        border-radius: 15px; 
    }

    .alert-secondary { 
        background-color: #E2E3E5; 
        color: #41464B; 
        border-radius: 15px; 
    }

    /* Article metadata */
    .article-meta { 
        display: flex; 
        justify-content: flex-end; 
        font-size: 0.9rem; 
        color: #355E3B; /* aligned forest green */
        align-items: center; 
    }

    .article-meta strong { 
        margin-right: 6px; 
    }

    /* Subtle card background decoration */
    .card::before {
        content: '';
        position: absolute;
        top: -10px;
        right: -10px;
        width: 60px;
        height: 60px;
        background: #FFCCCB; /* soft pink accent */
        border-radius: 50%;
        opacity: 0.2;
        z-index: 0;
    }

    </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>

    <div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="notificationsModalLabel">Notifications</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php if (count($notifications) === 0): ?>
                <p>No notifications.</p>
            <?php else: ?>
                <?php foreach ($notifications as $notif): ?>
                    <?php $class = $notif['is_read'] ? "alert-secondary" : "alert-warning"; ?>
                    <div class="alert <?php echo $class; ?>">
                        <?php echo $notif['message']; ?> <br>
                        <small class="text-muted"><?php echo $notif['created_at']; ?></small>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
        <div class="text-center">
            <h1 class="display-4">
            Welcome, <span style="color: #efd442;"><?php echo $_SESSION['username']; ?></span>!
            </h1>
            <p class="lead text-muted mb-4">You can manage all published articles here.</p>
            <div class="article-icon-container">
              <span class="line"></span>
              <span class="line"></span>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php $articles = $articleObj->getActiveArticles(); ?>
                <?php foreach ($articles as $article): ?>
                    <div class="card mt-4 shadow-sm">
                        <div class="card-body">
                            <?php if ($article['is_admin'] == 1): ?>
                                <span class="alert-admin">Message From Admin</span>
                            <?php endif; ?>

                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h2 class="mb-0"><?php echo $article['title']; ?></h2>
                                <div class="text-right article-meta mt-1">
                                    <strong><?php echo $article['username'] ?></strong> 
                                    <small class="text-muted">- <?php echo $article['created_at']; ?></small>
                                </div>
                            </div>

                            <?php if (!empty($article['category_name'])): ?>
                                <p><strong>Category:</strong> <?php echo htmlspecialchars($article['category_name']); ?></p>
                            <?php endif; ?>

                          <?php if (!empty($article['image_path'])): ?>
                            <div class="text-center w-100">
                              <img src="../uploads/<?php echo $article['image_path']; ?>" class="article-img">
                            </div>
                          <?php endif; ?>

                            <p><?php echo $article['content']; ?></p>

                            <form action="core/handleForms.php" method="POST" class="mt-3">
                                <input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>">
                                <button type="submit" name="deleteWriterArticleBtn" class="btn btn-danger btn-sm">Delete Article</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
