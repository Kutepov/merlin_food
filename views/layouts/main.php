<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <style>
        #base_url {display:none}
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <div class="container">
        <h1 align="center">Documentation API</h1>

        <h3>Entity names:</h3>
        <img src="/images/design.png" alt="" width="500px" height="500px">
        <br><br>

        <h3>Tokens for testing:</h3>


        <div class="alert alert-info">
            <b>Token for Admin:</b> eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjEsImlzX2FkbWluIjoxfQ.ezySHuOEVex_PhBNbAGVfFz7OAOOVvKHZ7LyEHA9RY8
            <br>
            <b>Token for User:</b> eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjEsImlzX2FkbWluIjowfQ.0vBHhpYuDYK5ZNfrmTFWqO0xdJPOZuLcM7xcf6Z4D4M
        </div>

        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
