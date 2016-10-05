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
class PrivilegiiSuccess extends \yii\db\ActiveRecord
{
    /**
     * Наименование таблицы
     * @return string
     */

    const FREE_IMG_EXAMPLE_WORK = 5;
    const FREE_IMG_SERT_EXAMPLE_WORK = 1;
    public static function tableName()
    {
        return 'lb_privilegii_success';
    }

    /**
     * Правила валидации
     * @return array
     */
    public function rules()
    {
        return [
            [['type','id_privilegii','status','user_id'], 'required'], // Обязательные для заполнения
            [['type','id_privilegii','status','user_id'], 'integer'],    // Целочисленные значения
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
            'user_id' => Yii::t('user', 'Пользователь'),
            'type' => Yii::t('user', 'Услуга'),
            'id_privilegii' => Yii::t('user', 'ID Привилегии'),
            'status' => Yii::t('user', 'Статус'),
        ];
    }

    public function getPrivilegii()
    {
        return $this->hasOne(Privilegii::className(), ['id' => 'id_privilegii']);
    }

}
