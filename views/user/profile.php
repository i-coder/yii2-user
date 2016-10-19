<?php
use lowbase\user\components\AuthKeysManager;
use lowbase\user\models\Country;
use lowbase\user\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use lowbase\user\UserAsset;
use yii\widgets\MaskedInput;
use kartik\depdrop\DepDrop;

$this->title = Yii::t('user', 'Мой профиль');
$this->params['breadcrumbs'][] = $this->title;
$assets = UserAsset::register($this);
?>

<?php $form = ActiveForm::begin([
    'id' => 'form-profile-client',
    'options' => [
        'class'=>'form',
        'enctype'=>'multipart/form-data'
    ],
    'fieldConfig' => [
        'template' => "{input}\n{hint}\n{error}"
    ]
    ]);
//print_r(\Yii::$app->authManager->getRolesByUser(Yii::$app->user->id));
//var_dump();
?>


<div class="profile row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs nav-justified">
            <li role="presentation"  class="<?=(Yii::$app->controller->route=='user/profile')?"active":""?>"><a href="<?= Url::toRoute(['/profile']) ?>"><?= Html::encode($this->title) ?></a></li>
            <?php
            $app_count = \app\models\Application::find()->where(['whom'=>Yii::$app->user->id])->andWhere(['status'=>\app\models\Application::APP_SUCCESS])->count();
            if($app_count>0){?>
                <li role="presentation"  class="<?=(Yii::$app->controller->route=='user/application')?"active":""?>"><a href="<?= Url::toRoute(['/appuser']) ?>">Ваши заявки  <span class="badge" style="font-size: 14px"><?=$app_count?></span></a></li>
            <?php }
            ?>
            <li role="presentation"  class="<?=(Yii::$app->controller->route=='example')?"active":""?>"><a href="<?= Url::toRoute(['/example']) ?>">Примеры работ</a></li>
            <li role="presentation" class="<?=(Yii::$app->controller->route=='sertificat/sertificat')?"active":""?>"><a href="<?= Url::toRoute(['sertificat/sertificat']) ?>">Сертификаты</a></li>
            <li role="presentation" class="<?=(Yii::$app->controller->route=='servicess/index')?"active":""?>"><a href="<?= Url::toRoute(['servicess/index']) ?>">Услуги</a></li>
            <li role="presentation"  class="disabled"><a href="#">Оплата</a></li>
            <li role="presentation"><a href="<?= Url::toRoute(['/logout']) ?>">Выход</a></li>
        </ul>
        <br>
    </div>

    <div class="col-lg-6">

        <?= $form->field($model, 'first_name')->textInput([
            'maxlength' => true,
            'placeholder' => $model->getAttributeLabel('first_name')
        ]) ?>

<!--        --><?//= $form->field($model, 'last_name')->textInput([
//            'maxlength' => true,
//            'placeholder' => $model->getAttributeLabel('last_name')
//        ]) ?>

        <?= $form->field($model, 'email')->textInput([
            'maxlength' => true,
            'placeholder' => $model->getAttributeLabel('email')
        ]) ?>

        <?= $form->field($model, 'home_phone')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+7(999)-999-99-99',
        ])->textInput(['placeholder' => $model->getAttributeLabel('phone')]) ?>

<!--        --><?//= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
//            'mask' => '+7(7112)-99-99-99',
//        ])->textInput(['placeholder' => $model->getAttributeLabel('home_phone')]) ?>

        <?= $form->field($model, 'birthday')
            ->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder' => $model->getAttributeLabel('birthday'),
                        'autocomplete'=>"off"
                ],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd.mm.yyyy'
                ]
                ]); ?>

        <?php
       echo  $form->field($model, 'city_id')->widget(Select2::classname(), [
            'data' => $country,
            'options' => ['placeholder' => $model->getAttributeLabel('country_id'),'id'=>'cat-id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
//        if(!empty($model->city_id)){
//            $srv[$model->city_id]=\lowbase\user\models\City::find($model->city_id)->one()->city;
//        }else{
//            $srv=[];
//        }
//        // Child # 1
//        echo $form->field($model, 'country_id')->widget(DepDrop::classname(), [
//            'options'=>['id'=>'subcat-id'],
//            'data'=>$srv,
//            'type'=>DepDrop::TYPE_SELECT2,
//            'pluginOptions'=>[
//                'depends'=>['cat-id'],
//                'initialize' => true,
//                'placeholder'=>'Выбрать...',
//                'url'=> Url::to(['user/subcat'])
//            ]
//        ]);
        ?>



<!---->
<!--        --><?//= $form->field($model, 'city_id')->widget(Select2::classname(), [
//            'initValueText' => ($model->city_id && $model->city) ? $model->city->city .
//                ' (' . $model->city->state.", ".$model->city->region . ")": '',
//            'options' => ['placeholder' => $model->getAttributeLabel('city_id')],
//            'pluginOptions' => [
//                'allowClear' => true,
//                'minimumInputLength' => 3,
//                'ajax' => [
//                    'url' => Url::to(['city/find']),
//                    'dataType' => 'json',
//                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
//                ],
//                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
//                'templateResult' => new JsExpression('function(city) { return city.text; }'),
//                'templateSelection' => new JsExpression('function (city) { return city.text; }'),
//            ],
//        ]); ?>

<!--        --><?//= $form->field($model, 'address')->textInput([
//            'maxlength' => true,
//            'placeholder' => $model->getAttributeLabel('address')
//        ]) ?>

        <span style="float: left;margin-right: 10px">С кем я работаю: </span>
        <?= $form->field($model, 'work')->radioList(User::getWorkArray(),array('template' => "<td>{input}</td><td>{label}</td>")) ?>

        <span style="float: left;margin-right: 10px">Пол: </span>
        <?= $form->field($model, 'sex')->radioList(User::getSexArray()) ?>

    </div>

    <div class="col-md-4">
        <div class="lb-user-module-profile-image">
            <?php
            if ($model->image) {
                $ar = explode("/",$model->image);
                $ar_t = array_pop($ar);
                echo "<img src='".Yii::$app->homeUrl."img/users/".$ar_t."' class='thumbnail'>";
                echo "<p>" . Html::a(Yii::t('user', 'Удалить фото'), ['remove']) . "</p>";
            } else {
                if ($model->sex === User::SEX_FEMALE) {
                    echo "<img src='".$assets->baseUrl ."/image/female.png' class='thumbnail'>";
                } else {
                    echo "<img src='".$assets->baseUrl ."/image/male.png' class='thumbnail'>";
                }
            }
            ?>
            <?= $form->field($model, 'photo')->fileInput([
                'maxlength' => true,
                'placeholder' => $model->getAttributeLabel('photo')
            ]) ?>

        </div>

        <div class="lb-user-module-profile-password">

            <?= $form->field($model, 'password')->passwordInput([
                'maxlength' => true,
                'placeholder' => $model->getAttributeLabel('password'),
                'class' => 'form-control password'
            ]) ?>

            <a href="javascript:void(0)" class="change_password lnk"><?= Yii::t('user', 'Изменить пароль')?></a>
        <br><br>
        </div>
    </div>

</div>

<div class="profile row">
    <div class="col-md-6">
        <div class="form-group">
            <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i> '.Yii::t('user', 'Сохранить'), [
                'class' => 'btn btn-lg btn-success',
                'name' => 'signup-button']) ?>
<!--            --><?//= Html::a('<i class="glyphicon glyphicon-log-out"></i> '.Yii::t('user', 'Выход'), ['logout'], [
//                'class' => 'btn btn-lg btn-default',
//                'name' => 'signup-button']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end();

$this->registerJs('
    $(document).ready(function(){
        $(".change_password").click(function(){
            $(".password").toggle();
            var display = $(".password").css("display");
            if (display=="none")
            {
                $(".password").val("");
                $(".change_password").text("'.Yii::t('user', 'Изменить пароль').'");
            }
            else
                $(".change_password").text("'.Yii::t('user', 'Отмена').'");
        });
    });
    ');

?>
