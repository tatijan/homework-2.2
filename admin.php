<?php
ini_set('display_errors','Off');
if (empty(($_POST['add']))) {
    if (empty($_POST['add'])) {
        ?>
        <p>Загрузите ваш тест - файл с расширением JSON</p>
        <?php
