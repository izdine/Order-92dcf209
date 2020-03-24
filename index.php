<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Netland!</title>
</head>
<body>
    <?php
        function select($quary){
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

            $formatResult = array();

            $rawResult = $pdo->query($quary);
            while ($row = $rawResult->fetch()) {
                $rowResult = array();

                foreach ($row as $collum => $value) {
                    $rowResult[$collum] = $value;
                }

                $formatResult[] = $rowResult;
            }

            return $formatResult;
        }
        $order = 'SELECT title, rating *FROM series ORDER BY title DESC, rating DESC =' . $_GET['rating'];
    ?>
    <h1>Welkom op het Netland beheerders paneel</h1>

    <h3>Series</h3>

    <table>
        <thead>
            <th>Titel</th>
         <th><a href="<?php if (isset($_GET['sort'])) {
           echo "index.php";
         } else {
           echo "index.php?sort=1";
         }
          ?>">Rating</a></th>

            <th></th>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['sort'])) {
           $rows = select('SELECT * FROM series ORDER BY rating DESC');

            }else {
                $rows = select('SELECT * FROM series');
              }
                foreach ($rows as $row) {
                    echo <<<EOT
                        <tr>
                            <td>${row['title']}</td>
                            <td>${row['rating']}</td>
                            <td><a href="series.php?id=${row['id']}">Meer info</a></td>
                        </tr>
                    EOT;
                }
            ?>
        </tbody>
    </table>


    <h3>Films</h3>

    <table>
        <thead>
            <th>Titel</th>
            <th>Duur</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $rows = select('SELECT * FROM films');
            foreach ($rows as $row) {
                echo <<<EOT
                            <tr>
                                <td>${row['Title']}</td>
                                <td>${row['Duur']}</td>
                                <td><a href="films.php?id=${row['ID']}">Meer info</a></td>
                            </tr>
                        EOT;
            }
            ?>
        </tbody>
    </table>
</body>
</html>
