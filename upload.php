<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$message = '';
$alertType = 'info';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $target_dir = 'uploads/';
    $originalName = basename($_FILES['file']['name']);
    $target_file = $target_dir . $originalName;
    $fileSize = $_FILES['file']['size'];
    $tmpName = $_FILES['file']['tmp_name'];

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt', 'doc', 'docx'];
    $allowedMimes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'application/pdf',
        'text/plain',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $maxSize = 2 * 1024 * 1024;

    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $message = "Upload error. Please try again.";
        $alertType = 'danger';
    } elseif (!in_array($extension, $allowedExtensions, true)) {
        $message = "File extension not allowed.";
        $alertType = 'danger';
    } elseif ($fileSize > $maxSize) {
        $message = "File is too large (max 2 MB).";
        $alertType = 'danger';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $tmpName);
        finfo_close($finfo);

        if (!in_array($mime, $allowedMimes, true)) {
            $message = "File MIME type not allowed.";
            $alertType = 'danger';
        } else {
            $safeName = bin2hex(random_bytes(8)) . '.' . $extension;
            $target_file = $target_dir . $safeName;

            if (move_uploaded_file($tmpName, $target_file)) {
                $safeLink = htmlspecialchars($target_file, ENT_QUOTES, 'UTF-8');
                $message = "The file has been uploaded. <a href='$safeLink' target='_blank'>View file</a>";
                $alertType = 'success';
            } else {
                $message = "Sorry, there was an error uploading your file.";
                $alertType = 'danger';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload - VulnLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">VulnLab</span>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="search.php">Search</a>
                <a class="nav-link" href="ping.php">Ping</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Upload Avatar / Document</h5>
            </div>
            <div class="card-body">
                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $alertType; ?>"><?php echo $message; ?></div>
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="file" class="form-label">Select file (allowed: jpg, jpeg, png, gif, pdf, txt, doc, docx – max 2 MB)</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>