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
<!doctype html>
<html lang="en">

<head>
    <title>Editar Producto</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="dp.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Mitr', sans-serif;
            background-color: #fd7e1b;
            margin: 0;
            padding: 0;
        }
        .header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            height: 50px;
            padding: 5px 13px 11px 0px;
            width: 100%;
            color: white;
            font-family: 'Mitr', sans-serif;
            margin-top: 0px;
            background-color: #298dba;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header p {
            margin-left: 20px;
        }
        .button-logout {
            text-decoration: none;
            border: transparent;
            border-radius: 15px;
            background-color: #e60000;
            padding: 10px;
            color: white;
            transition: 0.5s;
        }
        .button-logout:hover {
            background-color: #D9ddd4;
            color: red;
        }
        .container {
            margin: 90px auto;
            border-radius: 30px;
            text-align: center;
            background-color: white;
            width: 80%;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 10px 0px;
        }

        th {
            color: white;
            background-color: #298dba;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .timeregis {
            text-align: center;
        }
        .form-group {
            margin-left: 600px;
        }
        input[type=text] {
            border-radius: 15px;
            border: transparent;
            padding: 7px;
        }
        .return {
            border-radius: 15px;
            background-color: #ffcc33;
            color: black;
            text-decoration: none;
            padding: 10px;
            margin: 0px 0px 50px 100px;
            font-size: 20px;
            transition: 0.5s;
        }
        .return:hover {
            background-color: #fdb515;
            color: white;
        }
        .modify {
            border-radius: 15px;
            border: transparent;
            color: white;
            padding: 10px;
            margin: 0px 50px 50px 100px;
            font-size: 20px;
            background-color: #00A600;
            transition: 0.5s;
        }
        .modify:hover {
            color: black;
            background-color: #BBFFBB;
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
    </div>
    <div class="table-product">
        <table>
            <thead>
                <tr>
                    <th scope="col">Orden</th>
                    <th scope="col">ID:Producto</th>
                    <th scope="col">Nombre:Producto</th>
                    <th scope="col">Cantidades</th>
                    <th scope="col">Fecha:Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $idpro = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td scope="row"><?php echo $idpro ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['proname'] ?></td>
                        <td><?php echo $row['amount'] ?></td>
                        <td class="timeregis"><?php echo $row['time'] ?></td>
                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="fixproduct">
        <form method="POST" action="main/fix.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre del Producto</label>
                <br>
                <input type="text" name="name" value="<?php echo $_GET['message']; ?>" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Cantidad</label>
                <br>
                <input type="text" value="<?php echo $_GET['amount'] ?>" name="value" required>
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" />
            </div>
            <br>
            <div class="form-button">
                <button type="submit" class="modify">Editar</button>
                <a class="return" href="list.php">Volver</a>
            </div>
        </form>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>
</html>