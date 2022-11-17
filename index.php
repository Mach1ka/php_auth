<!DOCTYPE html>
<html lang="en">

<head>

    <?php


    $website_title = 'PHP BLOG';
    require 'blocks/head.php';
    ?>

</head>

<body>

    <?php require 'blocks/header.php'; ?>


    <main class="container mt-5">
        <div class="row">
            <div class="col-md-8 mb-3">
                <?php
                    require 'mysql_connect.php';

                    $sql = 'SELECT * FROM `articles` ORDER BY `date` DESC';
                    $query = $pdo->query($sql);
                    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                        echo "<h2>$row->title</h2>
                <p>$row->intro</p>
                <p><b>Автор статьи: </b><mark>$row->author</mark></p>
                <a href='/news.php?id=$row->id' title='$row->title'>
                <button class='btn btn-warning mb-5'>Прочитать больше</button>
                </a>";

                    }
                    ?>

            </div>
            <?php require 'blocks/aside.php'; ?>
        </div>

    </main>
    <?php require 'blocks/footer.php'; ?>


















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>


</body>

</html>