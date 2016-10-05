<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

use yii\helpers\Html;
use lowbase\user\UserAsset;

/* @var $this yii\web\View */
/* @var $model lowbase\user\models\AuthRule */

$this->title = Yii::t('user', 'Новое правило');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Правила контроля доступа'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$assets = UserAsset::register($this);
?>
<div class="auth-rule-create">

    <div class="row">
        <div class="col-lg-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
