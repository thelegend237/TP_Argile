<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>

<body>
    <!--<h1>Hello, world!</h1>-->
    <!--<button type="button" class="btn btn-primary">Primary</button>-->
    <br><br>
    <div class="container">
        <div class="row">
            <h1>PHP CRUD</h1>
        </div>
        <br>
        <div class="row">
            <p class="">
                <a href="create.php" class="btn btn-success"> Create</a>
            </p>

            <!--        bare de recherche-->
            <div style="margin-left: 820px; margin-top: -55px">
                <form class="form-inline my-2 my-lg-0" method="GET" action="">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>

            <!--        tableau des data-->
            <table class="table table-striped table-bordered" style="margin-top: 25px">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Mobile Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        include 'database.php';
                        $pdo = Database::connect();
                        
                        // Gérer la recherche
                        $sql = 'SELECT * FROM customers ORDER BY id DESC';
                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                            $search = $_GET['search'];
                            $sql = "SELECT * FROM customers WHERE name LIKE :search OR email LIKE :search OR mobile LIKE :search ORDER BY id DESC";
                        }
                        
                        $stmt = $pdo->prepare($sql);
                        if (isset($search)) {
                            $search = "%" . $search . "%";
                            $stmt->bindParam(':search', $search, PDO::PARAM_STR);
                        }
                        $stmt->execute();
                        
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['mobile']) . '</td>';
                            echo '<td width=250>
                                <a class="btn btn-dark" href="read.php?id=' . htmlspecialchars($row['id']) . '">Read</a>
                                <a class="btn btn-success" href="update.php?id=' . htmlspecialchars($row['id']) . '">Update</a>
                                <a class="btn btn-danger" href="delete.php?id=' . htmlspecialchars($row['id']) . '">Delete</a>
                            </td>';
                            echo '</tr>';
                        }
                        
                        Database::disconnect();
                    } catch (Exception $e) {
                        echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div> <!-- /container -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>