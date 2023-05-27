<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "g_client";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $sql = "SELECT c.id, c.name, c.telephone, c.email, c.adresse, v.nom_ville AS ville 
                FROM client c
                JOIN ville v ON c.ville = v.id_ville
                WHERE c.name LIKE :search";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':search', '%' . $search . '%');
    } else {
        $sql = "SELECT c.id, c.name, c.telephone, c.email, c.adresse, v.nom_ville AS ville
                FROM client c
                JOIN ville v ON c.ville = v.id_ville";
        $statement = $conn->prepare($sql);
    }


    $statement->execute();
    $client = $statement->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" rel="stylesheet">
    <title>CRUD GESTION CLIENT</title>
    <style>
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="logo.png" alt="Logo" width="40" height="40">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="index.php" method="GET">
                <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search" name="search">
            </form>
        </div>
    </div>
</header>
<div class="container my-5">
    <div class="row">
        <div class="col-10">
            <h5>Clients:</h5>
        </div>
        <div class="col-2 text-end">
            <a class="btn btn-success" href="ajouter.php"><small>+ Nouveau client</small></a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom client</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($client as $value): ?>
    <tr>
        <td><?php echo $value->id ?></td>
        <td><?php echo $value->name ?></td>
        <td><?php echo $value->telephone ?></td>
        <td><?php echo $value->email ?></td>
        <td><?php echo $value->adresse ?></td>
        <td><?php echo $value->ville ?></td>
        <td>
            <a href="modifier.php?id=<?=$value->id?>" class="btn btn-primary btn-sm" title="Modifier">
                <i class="bi bi-pencil-fill"></i>
            </a>
            <a href="supprimer.php?id=<?=$value->id?>" class="btn btn-danger btn-sm" title="Supprimer">
                <i class="bi bi-trash-fill"></i>
            </a>
        </td>
    </tr> 
    <?php endforeach ?>
</tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
