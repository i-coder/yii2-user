<?php
/**
 * @package   yii2-user
 * @author    Yuri Shekhovtsov <shekhovtsovy@yandex.ru>
 * @copyright Copyright &copy; Yuri Shekhovtsov, lowbase.ru, 2015 - 2016
 * @version   1.0.0
 */

namespace lowbase\user\models;

use Yii;

/**
 * Города
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $city
 * @property string $state
 * @property string $region
 * @property integer $biggest_city
 */
class Privilegii extends \yii\db\ActiveRecord
{
    /**
     * Наименование таблицы
     * @return string
     */
    public static function tableName()
    {
        return 'lb_privilegii';
    }

    /**
     * Правила валидации
     * @return array
     */
    public function rules()
    {
        return [
            [['type','magic','summ','status'], 'required'], // Обязательные для заполнения
            [['user_id', 'type','magic','summ'], 'integer'],    // Целочисленные значения
        ];
    }

    /**
     * Наименования полей аттрибутов
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'user_id' => Yii::t('user', 'ПОльзователь'),
            'type' => Yii::t('user', 'Услуга'),
            'magic' => Yii::t('user', 'Что дает'),
            'summ' => Yii::t('user', 'Сумма'),
            'status' => Yii::t('user', 'Статус'),
        ];
    }

}
