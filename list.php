<?php
session_start();
require_once "Database/Database.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.');</script>";
    header("Refresh:0 , url=index.html");
    exit();
}
$username = $_SESSION['username'];
$sql_fetch_todos = "SELECT * FROM product ORDER BY id ASC";
$query = mysqli_query($conn, $sql_fetch_todos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="icon" href="mueblesAltares.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Mitr", sans-serif;
            background-color: #fd7e1b;
            margin: 0;
            padding: 0;
        }
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 50px;
            background-color: #298dba;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-sizing: border-box;
        }
        .header h3 {
            margin: 0;
            font-size: 20px;
        }
        .button-logout {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #e60000;
            transition: background-color 0.3s;
        }
        .button-logout:hover {
            background-color: #D9ddd4;
        }
        .container {
            margin-top: 60px;
            padding: 20px;
        }
        h1, h2 {
            text-align: center;
            margin: 0;
        }
        .table-product {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #298dba;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .modify a, .delete a, .Addlist a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            transition: background-color 0.3s;
        }
        .modify a:hover, .delete a:hover, .Addlist a:hover {
            color: black;
        }
        .bfix {
            background-color: #ffcc33;
        }
        .bdelete {
            background-color: #e60000;
        }
        .Addlist {
            background-color: #00A600;
            float: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Muebles Altares</h3>
        <a class="button-logout" href="logout.php">Cerrar Sesión</a>
    </div>
    <div class="container">
        <h1>Lista de Productos</h1>
        <h2>Has accedido como <?php echo strtoupper($username) ?></h2>
        <div class="table-product">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Orden</th>
                        <th scope="col">ID Producto</th>
                        <th scope="col">Nombre Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha de Registro</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idpro = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td scope="row"><?php echo $idpro ?></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['proname'] ?></td>
                            <td><?php echo $row['amount'] ?></td>
                            <td><?php echo $row['time'] ?></td>
                            <td class="modify">
                                <a class="bfix" href="fix.php?id=<?php echo $row['id'] ?>&message=<?php echo $row['proname'] ?>&amount=<?php echo $row['amount']; ?>">Editar</a>
                            </td>
                            <td class="delete">
                                <a class="bdelete" href="main/delete.php?id=<?php echo $row['id'] ?>">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                        $idpro++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a class="Addlist" href="addlist.php">Agregar Producto</a>
    </div>
</body>
</html>