<?php

/**
 * This is the model class for table "{{social_network_user}}".
 *
 * The followings are the available columns in table '{{social_network_user}}':
 * @property integer $id
 * @property string $network_id
 * @property string $social_network_user_id
 * @property string $username
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class SocialNetworkUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SocialNetworkUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{social_network_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('network_id, social_network_user_id, username, user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('network_id', 'length', 'max'=>45),
			array('social_network_user_id', 'length', 'max'=>100),
			array('username', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, network_id, social_network_user_id, username, user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'network_id' => Yii::t('core/admin', 'Network'),
			'social_network_user_id' => Yii::t('core/admin', 'Social Network User'),
			'username' => Yii::t('core/admin', 'Username'),
			'user_id' => Yii::t('core/admin', 'User'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('network_id',$this->network_id,true);
		$criteria->compare('social_network_user_id',$this->social_network_user_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getSocialLink($network_id, $id)
    {
        $model = SocialNetworkUser::model()->findByAttributes(array("network_id"=>$network_id, "user_id"=>$id));
        $profile_id = Profile::model()->findByAttributes(array("user_id"=>$id));
        $hidden = ProfileFields::model()->findByAttributes(array("field_name"=>$network_id, "profile_id"=>$profile_id->id));
        if ($model != null && $hidden == null) {
            switch ($network_id) {
                case "vkontakte":
                    return "http://vk.com/id".$model->social_network_user_id;
                    break;
                case "facebook":
                    return "https://www.facebook.com/profile.php?id=".$model->social_network_user_id;
                    break;
                case "google_oauth":
                    return "https://plus.google.com/".$model->social_network_user_id;
                    break;
                case "mailru":
                    return $model->social_network_user_id;
                    break;
                case "odnoklassniki":
                    return "http://www.odnoklassniki.ru/profile/".$model->social_network_user_id;
                    break;
                default:
                    return "#";
            }
        } else
            return "#";
    }
}