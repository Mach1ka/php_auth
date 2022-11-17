<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require 'mysql_connect.php';

    $sql = 'SELECT * FROM `articles` WHERE `id` = :id';

    $id = $_GET['id'];
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $id]);

    $article = $query->fetch(PDO::FETCH_OBJ);

    $website_title = $article->title;
    require 'blocks/head.php';
    ?>

</head>

<body>

    <?php require 'blocks/header.php'; ?>


    <main class="container mt-5">
        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="bg-light py-5 px-5">
                    <h1>
                        <?= $article->title ?>
                    </h1>
                    <p><b>Автор статьи:</b> <mark>
                            <?= $article->author ?>
                        </mark> </p>
                    <?php
                    $date = date('d ', $article->date);
                    $array = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря"];
                    $date .= $array[date('n', $article->date) - 1];
                    $date .= date(' H:i', $article->date);
                    ?>

                    <p><b>Время публикации:</b> <u>
                            <?= $date ?>
                        </u> </p>
                    <p>
                        <hr>
                        <?= $article->intro ?>
                            <br><br>
                            <?= $article->text ?>
                    </p>
                </div>
                <h3 class="mt-5">Комментарии</h3>
                <form action="/news.php?id=<?= $_GET['id'] ?>" method="post">
                    <label for="username">Ваше имя</label>
                    <input type="text" name="username" value="<?= $_COOKIE['login'] ?>" id="username"
                        class="form-control">




                    <label for="message">Сообщение</label>
                    <textarea name="message" id="message" class="form-control"></textarea>

                    <button type=submit id="message_send" class="btn btn-danger mt-3 mb-5">
                        Отправить комментарий
                    </button>
                </form>
                <?php
                if ($_POST['username'] != '' && $_POST['message'] != '') {
                    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
                    $message = trim(filter_var($_POST['message'], FILTER_SANITIZE_STRING));

                    $sql = 'INSERT INTO comments(name,message,article_id) VALUES(?,?,?)';
                    $query = $pdo->prepare($sql);
                    $query->execute([$username, $message, $_GET['id']]);
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