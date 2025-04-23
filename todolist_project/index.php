<?php
// Configuration de la base de données
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'todolist');
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');

// Connexion à la base de données
$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'new' && !empty($_POST['title'])) {
        $stmt = $pdo->prepare("INSERT INTO todo (title) VALUES (:title)");
        $stmt->execute(['title' => $_POST['title']]);
    } elseif (($action === 'delete' || $action === 'toggle') && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        if ($action === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM todo WHERE id = :id");
            $stmt->execute(['id' => $id]);
        } elseif ($action === 'toggle') {
            $stmt = $pdo->prepare("UPDATE todo SET done = 1 - done WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }
    }
}

// Récupération des tâches
$stmt = $pdo->query("SELECT * FROM todo ORDER BY created_at DESC");
$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ma Todo List</a>
    </div>
</nav>

<div class="container mt-4">
    <form method="post" class="mb-3">
        <div class="input-group">
            <input type="text" name="title" class="form-control" placeholder="Nouvelle tâche" required>
            <button class="btn btn-primary" type="submit" name="action" value="new">Ajouter</button>
        </div>
    </form>

    <ul class="list-group">
        <?php foreach ($taches as $tache): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center
                <?= $tache['done'] ? 'list-group-item-success' : 'list-group-item-warning' ?>">
                <?= htmlspecialchars($tache['title']) ?>
                <form method="post" class="d-flex gap-2">
                    <input type="hidden" name="id" value="<?= $tache['id'] ?>">
                    <button type="submit" name="action" value="toggle" class="btn btn-sm btn-secondary">Basculer</button>
                    <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>
