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
class Files extends \yii\db\ActiveRecord
{
    /**
     * Наименование таблицы
     * @return string
     */
    public static function tableName()
    {
        return 'lb_files';
    }

    /**
     * Правила валидации
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'user_id'], 'required'], // Обязательные для заполнения
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
            'name' => Yii::t('user', 'Имя'),
            'user_id' => Yii::t('user', 'Пользователь'),
        ];
    }
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $directory = Yii::getAlias('@webroot').'/img/users/work/thum/'.$this->name;
            if (is_file($directory)) {
                unlink($directory);
            }
            $directory_big = Yii::getAlias('@webroot').'/img/users/work/big/'. $this->name;
            if (is_file($directory_big)) {
                unlink($directory_big);
            }
            return true;
        } else {
            return false;
        }
    }
}
