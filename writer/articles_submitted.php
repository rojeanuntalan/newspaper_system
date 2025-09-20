<?php 
require_once 'classloader.php';

if (!$userObj->isLoggedIn()) {
  header("Location: login.php");
  exit;
}

if ($userObj->isAdmin()) {
  header("Location: ../admin/index.php");
  exit;
}

$notifications = $notificationObj->getNotificationsByUser($_SESSION['user_id']);
$categories = $categoryObj->getCategories(); // fetch categories for dropdown

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
  <title>Articles Submitted</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="icon" type="image/svg+xml" href="../images/logo.svg">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
    font-family: 'Comic Neue', cursive; /* playful font for kids */
    background-color: #FFF8F0; /* soft pastel background */
    color: #333;
    }

    /* Section Titles */
    .section-title {
        font-weight: 700;
        color: #FF6F61; /* bright, fun color */
        text-align: center;
        margin-bottom: 15px;
    }

    /* Card Container */
    .card-box {
        background-color: #FFFAE3; /* soft yellowish for kids */
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        padding: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
        transition: transform 0.2s ease;
    }

    .card-box:hover {
        transform: translateY(-3px);
    }

    /* Article Card */
    .card {
        background-color: #FFF3E0; /* light orange cream */
        border-radius: 20px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        transition: transform 0.2s ease;
        padding: 25px;
        margin-bottom: 25px;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    /* Headings */
    .card h2, .card h1 {
        font-size: 1.8rem;
        color: #FF6F61;
        margin-bottom: 10px;
    }

    /* Paragraphs */
    p {
        font-size: 1rem;
        color: #555;
        line-height: 1.6;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }

    /* Article Meta */
    .article-meta {
        display: flex;
        justify-content: flex-end;
        font-size: 0.85rem;
        color: #355E3B;
        align-items: center;
    }

    .article-meta strong {
        margin-right: 5px;
    }

    /* Article Images */
    .article-img {
        max-width: 280px; /* not too big for kids */
        width: 100%;
        margin: 10px auto;
        border-radius: 15px;
        border: 3px solid #FFD6A5; /* fun border */
        display: block;
        object-fit: cover;
    }

    /* Article Icon */
    .article-icon {
        max-width: 25%;
        display: block;
        margin: 5px auto;
    }

    /* Buttons */
    .btn-warning, .btn-success, .btn-secondary, .btn-danger, .btn-primary, .btn-custom {
        border-radius: 15px;
        font-weight: 600;
        padding: 6px 14px;
        font-size: 0.9rem;
        margin-right: 5px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-warning { background-color: #FFB347; color: #fff; border: none; }
    .btn-warning:hover { background-color: #FFA500; transform: translateY(-2px); }

    .btn-success { background-color: #8BC34A; color: #fff; border: none; }
    .btn-success:hover { background-color: #7CB342; transform: translateY(-2px); }

    .btn-danger { background-color: #FF6F61; color: #fff; border: none; }
    .btn-danger:hover { background-color: #E63946; transform: translateY(-2px); }

    .btn-custom {
        background-color: #FFB347;
        color: #fff;
    }
    .btn-custom:hover {
        background-color: #FFA500;
        transform: translateY(-2px);
    }

    /* Textarea */
    textarea.form-control {
        resize: vertical;
        border-radius: 12px;
        border: 2px solid #FFD6A5;
        padding: 10px;
    }

    /* Select */
    select.form-control {
        border-radius: 12px;
        border: 2px solid #FFD6A5;
        padding: 5px 10px;
    }
  </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="text-center mt-4 mb-4">
          <button id="toggleFormBtn" class="mt-2 btn btn-custom">
              Submit a New Article
          </button>
      </div>

      <div id="submitFormBox" class="card-box d-none">
          <h2 class="section-title">New Article</h2>
          <form action="core/handleForms.php" method="POST" enctype="multipart/form-data">
              <input type="text" class="form-control mt-3" name="title" placeholder="Article Title" required>
              <textarea name="description" class="form-control mt-3" placeholder="Write your article here..." required></textarea>

              <select name="category_id" class="form-control mt-3" required>
                  <option value="">Select Category</option>
                  <?php foreach ($categories as $cat): ?>
                      <option value="<?php echo $cat['category_id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                  <?php endforeach; ?>
              </select>

              <input type="file" name="article_image" class="form-control mt-3" accept="image/*">

              <div class="d-flex justify-content-end mt-3">
                  <input type="submit" class="btn btn-custom" name="insertArticleBtn" value="Submit">
              </div>
          </form>
      </div>

      <div class="icon-header">
        <h1 class="section-title">All Submitted Articles</h1>
        <p class="lead text-muted text-center mb-4">Double-click an article to edit it.</p>
      </div>

      <?php $articles = $articleObj->getArticlesByUserID($_SESSION['user_id']); ?>
      <?php foreach ($articles as $article) { ?>
      <div class="card mt-3">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <h2 class="mb-0"><?php echo $article['title']; ?></h2>
            <div class="text-right article-meta mt-1">
                <strong><?php echo $article['username']; ?></strong>
                <small class="text-muted"> - <?php echo $article['created_at']; ?></small>
            </div>
        </div>

        <?php if (!empty($article['category_name'])): ?>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($article['category_name']); ?></p>
        <?php endif; ?>

        <?php if (!empty($article['image_path'])): ?>
            <img src="../uploads/<?php echo $article['image_path']; ?>" alt="Article Image" class="article-img mb-2">
        <?php endif; ?>

        <p><?php echo $article['content']; ?></p>
        <?php if ($article['is_active'] == 0) { ?>
            <p class="text-danger">Status: PENDING</p>
        <?php } else { ?>
            <p class="text-success">Status: ACTIVE</p>
        <?php } ?>

        <div class="mt-2">
            <form class="deleteArticleForm d-inline">
                <input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>" class="article_id">
                <input type="submit" class="btn btn-danger btn-sm" value="Delete">
            </form>
        </div>

        <div class="updateArticleForm d-none mt-3">
            <h5>Edit Article</h5>
            <form action="core/handleForms.php" method="POST" enctype="multipart/form-data">
                <input type="text" class="form-control mt-2" name="title" value="<?php echo $article['title']; ?>">
                <textarea name="description" class="form-control mt-2"><?php echo $article['content']; ?></textarea>

                <select name="category_id" class="form-control mt-2" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['category_id']; ?>" 
                            <?php echo ($article['category_id'] == $cat['category_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <input type="file" name="article_image" class="form-control mt-2" accept="image/*">
                <input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>">

                <div class="d-flex justify-content-end mt-4">
                    <input type="submit" class="btn btn-custom" name="editArticleBtn" value="Submit">
                </div>
            </form>
        </div>
      </div>
      <?php } ?>

    </div>
  </div>
</div>

<script>
$('#toggleFormBtn').on('click', function() {
    $('#submitFormBox').toggleClass('d-none');
});

$('.card').on('dblclick', function () {
    $(this).find('.updateArticleForm').toggleClass('d-none');
});

$('.deleteArticleForm').on('submit', function (event) {
    event.preventDefault();
    var formData = {
        article_id: $(this).find('.article_id').val(),
        deleteArticleBtn: 1
    };
    if (confirm("Are you sure you want to delete this article?")) {
        $.ajax({
            type:"POST",
            url: "core/handleForms.php",
            data:formData,
            success: function (data) {
                if (data) { location.reload(); }
                else { alert("Deletion failed"); }
            }
        });
    }
});
</script>
</body>
</html>