<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "USER".
 *
 * @property int $ID
 * @property string $USERNAME
 * @property string $NAME
 * @property string $SURNAME
 * @property string $PASSWORD
 * @property string $EMAIL
 * @property string $REG_DATE
 */
class USER extends \yii\db\ActiveRecord
{
    public $PASSWORD2;
    public $email;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'USER';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USERNAME', 'NAME', 'SURNAME', 'EMAIL','PASSWORD', 'REG_DATE'], 'required', 'message' => '{attribute} nedrīkst būt tukšs'],
            [['REG_DATE'], 'safe'],
            [['EMAIL', 'USERNAME'], 'unique', 'message' => '{attribute} ir jau aizņemts, lūdzu mēģiniet citu'],
            [['USERNAME', 'NAME', 'SURNAME'], 'string', 'max' => 40],
            [['PASSWORD','PASSWORD2'], 'string', 'min' => 8, 'tooShort' => '{attribute} parole nedrīkst būt īsāka par 8 simboliem'],
            [['EMAIL'], 'string', 'max' => 50],
            //['PASSWORD2', 'compare', 'compareAttribute' => 'PASSWORD', 'message' => 'parolēm jābūt vienādām'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USERNAME' => 'Lietotājvārds',
            'NAME' => 'Vārds',
            'SURNAME' => 'Uzvārds',
            'PASSWORD' => 'Parole',
            'EMAIL' => 'Epasts',
            'REG_DATE' => 'Reģistrācijas datums',
            //'PASSWORD2' => 'Atkārtota parole',
        ];
    }

    /**
     * {@inheritdoc}
     * @return USERQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new USERQuery(get_called_class());
    }

    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }
}