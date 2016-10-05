<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use lowbase\user\components\AuthChoice;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
use lowbase\user\UserAsset;
use kartik\widgets\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper ;
use lowbase\user\models\User;
use branchonline\lightbox\Lightbox;
use app\models\FilesSer;
use kartik\depdrop\DepDrop;
$this->title = Yii::t('user', 'Регистрация');
$this->params['breadcrumbs'][] = $this->title;
UserAsset::register($this);





$script_two = <<< JS
        $("input:radio").click(function() {
            var value = $(this).val();
            if(value==1){
                 $("#category_id").css('display','none');
            }else{
                $("#category_id").css('display','block');
            }
        });
JS;
$this->registerJs($script_two, yii\web\View::POS_READY);
?>





<div class="site-signup row">

        <div class="col-lg-6">


            <?php
            if (Yii::$app->session->hasFlash('signup-success')) {
                echo "<p class='signup-success'>" . Yii::$app->session->getFlash('signup-success') . "</p>";
            } else {
            ?>

            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'fieldConfig' => [
                    'template' => "{input}\n{hint}\n{error}"
                ]
            ]); ?>

            <?= $form->field($model, 'first_name')->textInput([
                'maxlength' => true,
                'placeholder' => $model->getAttributeLabel('first_name')
            ]);?>

                <span style="float: left;margin-right: 10px">Вы : </span>
                <?php $model->type=0;?>
                <?= $form->field($model, 'type')->radioList(User::getTypeArray(),array('template' => "<td>{input}</td><td>{label}</td>")) ?>

                <div id="category_id" style="display: block;">
                <?php
                echo Select2::widget([
                    'name' => 'SignupForm[category_id]',
                    'id'=>'type-category-id',
                    'value' => '',
                    'data' =>\cornernote\menu\models\Menu::findOne(1)->children()
                        ->where(['depth'=>1])->select(['name', 'id'])
                        ->indexBy('id')->asArray()->column(),
                    'options' => ['placeholder' => 'Категория..','id'=>$id],
                ]);
                ?>
                <br>
                </div>

                <?= $form->field($model, 'email')->textInput([
                'maxlength' => true,
                'placeholder' => $model->getAttributeLabel('email')
            ]);?>

            <?= $form->field($model, 'password')->passwordInput([
                'maxlength' => true,
                'placeholder' => $model->getAttributeLabel('password')
            ]); ?>
<!---->
<!--                        --><?//= $form->field($model, 'city_id')->widget(Select2::classname(), [
//                            'initValueText' => ($model->city_id && $model->city) ? $model->city->city .
//                                ' (' . $model->city->state.", ".$model->city->region . ")": '',
//                            'options' => [
//                                'placeholder' => $model->getAttributeLabel('city_id'),
////                                'multiple' => true,
//
//                            ],
//                    'data' => \lowbase\user\models\City::find()->select(['id','city'])->asArray()->all(),
//                    'showToggleAll' => false,
//                    'pluginOptions' => [
//
//                                'allowClear' => true,
//                                'minimumInputLength' => 1,
//                                'ajax' => [
//                                    'url' => Url::to(['city/find']),
//                                    'dataType' => 'json',
//                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
//                                ],
//                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
//                                'templateResult' => new JsExpression('function(city) { return city.text; }'),
//                                'templateSelection' => new JsExpression('function (city) { return city.text; }'),
//                            ],
//                        ]) ?>
<!---->


            <?php
            echo $form->field($model, 'captcha')->widget(Captcha::className(), [
                'captchaAction' => 'lowbase-user/default/captcha',
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => $model->getAttributeLabel('captcha')
                ],
                'template' => '<div class="row">
                <div class="col-lg-8">{input}</div>
                <div class="col-lg-4">{image}</div>
                </div>',
            ]);
            ?>


                <div class="form-group">
                <?= Html::submitButton(Yii::t('user', 'Зарегистрироваться'), [
                    'class' => 'btn btn-lg btn-primary',
                    'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

<!--            <p class="hint-block">--><?//= Yii::t('user', 'Зарегистрироваться с помощью социальных сетей')?><!--:</p>-->
<!---->
<!--            <div class="text-center" style="text-align: center">-->
<!--                --><?//= AuthChoice::widget([
//                    'baseAuthUrl' => ['/lowbase-user/auth/index'],
//                ]) ?>
<!--            </div>-->

            <p class="hint-block">
                <?= Yii::t('user', 'Если регистрировались ранее, можете')?> <?=Html::a(Yii::t('user', 'войти на сайт'), ['login'])?>,
                <?= Yii::t('user', 'используя Email или социальные сети')?>.
            </p>

            <?php } ?>

        </div>
        <div class="col-lg-6">
        </div>
</div>
