<?php

/* @var $this yii\web\View */

$this->title = 'Posts Index';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
        <table class="table table-hover">
            <thead>
            <tr>
                <?php foreach( $model as $name => $value ): ?>
                    <th scope="col"><?= $model->getAttributeLabel( $name ) ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach( $posts as $post ): ?>
                <tr>
                    <?php foreach( $model as $name => $value ): ?>
                        <th><?= $post[ $name ] ?></th>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>