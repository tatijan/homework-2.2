<?php
if (isset($_POST['upload'])) {
    if (!empty(glob('tests/*.json'))) {
        $allFiles = glob('tests/*.json');
    } else {
        $allFiles = [0];
    }
    $uploadfile = 'tests/' . basename($_FILES['testfile']['name']);
    if (pathinfo($_FILES['testfile']['name'], PATHINFO_EXTENSION) !== 'json') {
        $result = "<p class='error'>Можно загружать файлы только с расширением json</p>";
    } else if ($_FILES["testfile"]["size"] > 1024 * 1024 * 1024) {
        $result = "<p class='error'>Размер файла превышает три мегабайта</p>";
    } else if (in_array($uploadfile, $allFiles, true)) {
        $result = "<p class='error'>Файл с таким именем уже существует.</p>";
    } else if (move_uploaded_file($_FILES['testfile']['tmp_name'], $uploadfile)) {
        $result = "<p class='success'>Файл корректен и успешно загружен на сервер</p>";
    } else {
        $result = "<p class='error'>Произошла ошибка</p>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="styles/admin.css">
</head>
<body>
<?php if (isset($_POST['upload'])): ?>
    <a href="<?php $_SERVER['HTTP_REFERER'] ?>"><div>< Назад</div></a>
    <?php echo $result; ?>
    <h1>Служебная информация:</h1>
    <pre>
        <?php print_r($allFiles); ?>
        <hr>
        <?php print_r($_FILES); ?>
    </pre>
<?php endif; ?>
<?php if (!isset($_POST['create']) && !isset($_POST['upload'])): ?>

    <form id="load-json" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Загрузите свой тест в формате json</legend>
            <input type="file" name="testfile" id="uploadfile" required>
            <input type="submit" value="Добавить в базу" id="submit-upload" name="upload">
        </fieldset>
    </form>

    <div class="all-tests">
        <fieldset>
            <a href="list.php">Посмотреть все тесты >></a>
        </fieldset>
    </div>

    <form method="POST" id="create-json">
        <fieldset>


<?php endif; ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="js/admin.js"></script>
</body>
</html>