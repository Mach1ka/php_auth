<?php
if ($_COOKIE['login'] == '') {
    header('Location: /reg.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $website_title = 'Статьи';
    require 'blocks/head.php'; ?>

</head>

<body>

    <?php require 'blocks/header.php'; ?>


    <main class="container mt-5">
        <div class="row">
            <div class="col-md-8 mb-3">
                <h4>Статьи</h4>
                <form action="" method="post">
                    <label for="title">Заголовок</label>
                    <input type="text" name="title" id="title" class="form-control">

                    <label for="intro">Интро статьи</label>
                    <textarea name="intro" id="intro" class="form-control"></textarea>

                    <label for="text">Текст статьи</label>
                    <textarea name="text" id="text" class="form-control"></textarea>

                    <div class="alert alert-danger mt-2" id="errorBlock"></div>
                    <button type="button" id="article_send" class="btn btn-danger mt-4">
                        Добавить статью
                    </button>
                </form>
            </div>
            <?php require 'blocks/aside.php'; ?>

        </div>

    </main>
    <?php require 'blocks/footer.php'; ?>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>

        $('#article_send').click(function () {
            var title = $('#title').val();
            var intro = $('#intro').val();
            var text = $('#text').val();

            $.ajax({
                url: 'ajax/add_article.php',
                type: 'POST',
                cache: false,
                data: {
                    'title': title, 'intro': intro, 'text': text,
                },
                dataType: 'html',
                success: function (data) {
                    if (data == 'ready') {
                        $('#article_send').text('Статья добавлена');
                        $('#article_send').removeClass('btn-danger').addClass('btn-success');
                        document.location.reload();



                        $('#errorBlock').hide();
                    }
                    else {
                        $('#errorBlock').show();
                        $('#errorBlock').text(data);

                    }
                }

            });

        })

    </script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>


</body>

</html>