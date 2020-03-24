<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Films</title>
</head>
<body>
    <a href="index.php">Terug</a>
    <?php
    $result;
    $host = 'localhost';
    $db   = 'netland';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $query = 'SELECT * FROM films WHERE ID =' . $_GET['id']  ;
        $result = $pdo->query($query)->fetch();
    ?>
    <table>
        <tbody>
            <tr>
                <td><strong>Datum van uitkomst</strong></td>
                <td><?php echo $result['Uitkomst_Datum'] ?></td>
            </tr>
            <tr>
              <td><strong>Land_van_Uitkomst</strong></td>
              <td><?php echo $result['Land_van_Uitkomst'] ?></td>
            </tr>
            <tr>
              <td><strong>Omschrijving</strong></td>
              <td><?php echo $result['Omschrijving'] ?></td>
            </tr>
        </tbody>
    </table>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $result['YouTube_Trailer'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </body>
</html>
