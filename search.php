<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$q = isset($_GET['q']) ? $_GET['q'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search - VulnLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">VulnLab</span>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="upload.php">Upload</a>
                <a class="nav-link" href="ping.php">Ping</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">User Search</h5>
            </div>
            <div class="card-body">
                <form method="get" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Search by name..." value="<?php echo htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>

                <?php if ($q !== ''): ?>
                    <h5>Search results for:
                        <span class="text-danger"><?php echo htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?></span>
                    </h5>
                    <hr>
                    <?php
                    try {
                        $pdo = new PDO('sqlite:vuln_lab.db');
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $stmt = $pdo->prepare("SELECT username FROM users WHERE username LIKE :q");
                        $stmt->execute([':q' => '%' . $q . '%']);

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="list-group-item">' . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . '</div>';
                        }
                    } catch (PDOException $e) {
                        echo '<div class="alert alert-danger">Database error.</div>';
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
