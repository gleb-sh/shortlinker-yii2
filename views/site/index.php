<?php

/* @var $this yii\web\View */

$this->title = 'Сервис | Короткая ссылка ';
?>

<div class="wrapper">
    <div class="unical">
        <div class="unical-title">
            <h1>Создать короткую ссылку</h1>
            <p>без регистрации и смс</p>
        </div>
        <form class="unical-form" data-method="createlink">
            <input type="text" name="string" required placeholder="ваша длинная ссылка">
            <button type="submit">Получить короткую ссылку</button>
        </form>
        <div class="unical-result">
            <h2>Ваша ссылка:</h2>
            <h3>Произошла ошибка:</h3>
            <a href="" target="_blank" rel="noopener noreferrer"></a>
            <p></p>
            <div class="button" data-copy=".unical-result a">Копировать</div>
            <div class="button js-newlink">Создать новую ссылку</a>
        </div>
    </div>
</div>