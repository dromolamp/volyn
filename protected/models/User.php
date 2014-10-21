<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property string $reg_date
 * @property string $role
 * @property integer $status
 * @property string $statusName
 * @property string $balance
 * @property string $bonuses
 * @property string $last_activity
 */
class User extends CActiveRecord
{
    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const STATUS_ONLINE = 1;
    const STATUS_OFFLINE = 2;

    public $repeat_password;
    public $verifyCode;
    public $activation;
    public $oldPassword;
    public $role;
    public $oldRole;

    public $rules;
    public $is_get_news;
    public $filter_online;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('username, email', 'required', 'on'=>'user_edit'),
            array('repeat_password', 'compare', 'compareAttribute'=>'password', 'on'=>'user_edit'),
			array('username,verifyCode', 'required', 'on'=>'registration'),
			array('role', 'required', 'on'=>'admin'),
            array('status, is_get_news', 'numerical', 'integerOnly'=>true),
            array('last_activity, username, name, password, email', 'length', 'max'=>255),
            array('balance, bonuses', 'length', 'max'=>10),
            array('last_visit, block,type_id,rules,', 'safe'),
            // Registration
			array('repeat_password,rules', 'required', 'on'=>'activation'),
			array('repeat_password, password', 'required', 'on'=>'registration_step_two'),
			array('repeat_password', 'required', 'on'=>'step_1'),
            array('rules','boolean', 'falseValue' => 'true','on'=>'activation'),
            array('repeat_password', 'compare', 'compareAttribute'=>'password', 'on'=>'activation'),
            array('repeat_password', 'compare', 'compareAttribute'=>'password', 'on'=>'step_1'),
            array('repeat_password', 'compare', 'compareAttribute'=>'password', 'on'=>'registration_step_two'),
			// Activation
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'registration'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('filter_online, id, username,rules, password, reg_date, type_id, status', 'safe', 'on'=>'search'),

            //registration
            array('email, rules', 'required', 'on'=>'registration_step_one'),
            array('rules', 'checkAcceptRules', 'on'=>'registration_step_one'),
            array('email', 'email'),
            array('email', 'unique', 'allowEmpty'=>false, 'className'=>'User', 'attributeName'=>'email', 'on'=>'registration_step_one'),

		);
	}

    public function checkAcceptRules()
    {
        if (!$this->rules)
            $this->addError('rules', Yii::t('avimi', 'Need to accept the terms of use'));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'profile' => array(self::HAS_ONE, 'Profile', 'user_id'),
        );
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            if ($this->id==1)
                return false;
            return true;
        } else
            return false;
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate())
        {
            return true;
        } else
            return false;
    }

    public function beforeSave()
    {
        if (parent::beforeSave())
        {
            if ($this->isNewRecord) {
                $this->salt = self::generateRandomString(10);
                $this->password = $this->hashPassword($this->password);
            } else {
                if (!empty($this->password) && $this->password!=$this->oldPassword)
                    $this->password = $this->hashPassword($this->password);
                else
                    $this->password = $this->oldPassword;
            }

            return true;
        } else
            return false;
    }

    public function afterSave()
    {
        parent::afterSave();
        if ($this->id!=1) {
            $authManager = Yii::app()->authManager;
            $authManager->revoke($this->oldRole, $this->id);
            $authManager->assign($this->role, $this->id);
        }
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->oldPassword = $this->password;

        $roles = Yii::app()->authManager->getRoles($this->id);
        reset($roles);
        $this->oldRole = $this->role = key($roles);
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'balance' => Yii::t('core/user','Баланс'),
			'bonuses' => Yii::t('core/user','Балы'),
			'username' => Yii::t('core/user','Username'),
			'password' => Yii::t('core/user','Password'),
			'repeat_password' => Yii::t('core/user','Confirm password'),
			'reg_date' => Yii::t('core/user','Registration date'),
			'status' => Yii::t('core/user','Status'),
			'statusName' => Yii::t('core/user','Status'),
			'role' => Yii::t('core/user','Role'),
            'verifyCode' => Yii::t('core/user','Captcha'),
            'filter_online' => Yii::t('core/user','Состояние'),
            'rules' => Yii::t('avimi', 'I accept the terms')." ".CHtml::link(Yii::t('avimi', 'of Service agreement')),
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('reg_date',$this->reg_date,true);
        if ($this->filter_online) {
            if ($this->filter_online == self::STATUS_OFFLINE)
                $criteria->addCondition('NOW() - last_activity > 5*60 OR last_activity IS NULL');
            else
                $criteria->addCondition('NOW() - last_activity <= 5*60');
        }
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function validatePassword($password)
    {
        return $this->hashPassword($password)===$this->password;
    }

    public function hashPassword($password)
    {
        return sha1($this->salt.$password);
    }

    public static function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public function getStatusName()
    {
        switch($this->status) {
            case self::STATUS_ACTIVE:
                return Yii::t('core/admin', 'Active');
                break;
            case self::STATUS_NOACTIVE:
                return Yii::t('core/admin', 'No active');
                break;
            default:
                return "";
        }
    }

    public function getIsOnline()
    {
        if (empty($this->last_activity))
            return false;
        $time = time();
        $timeLastActivity = strtotime(Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', $this->last_activity));
        if ($time - $timeLastActivity <= 5*60)
            return true;
        return false;
    }

    public static function addBalls($user_id, $count_balls)
    {
        $model = self::model()->findByPk($user_id);
        if ($model !== null) {
            $model->bonuses += $count_balls;
            $model->save(false);
        }
    }

}