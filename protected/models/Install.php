<?php
/**
 * Created by JetBrains PhpStorm.
 * User: weblogic
 * Date: 6/8/12
 * Time: 12:16 PM
 * To change this template use File | Settings | File Templates.
 */
class Install extends CFormModel
{
    public $name;
    public $db_host = 'localhost';
    public $db_dbname;
    public $db_username;
    public $db_password;
    public $db_tablePrefix = 'tbl_';

    public $admin_email;
    public $admin_username;
    public $admin_pass;
    public $language;


    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('name, db_host, db_dbname, db_username, db_password, db_tablePrefix, admin_email, admin_username, admin_pass, language', 'required'),
            // Check connection to DB
            array('db_host', 'checkConnect'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'name'=> Yii::t('core/admin', 'Site title'),
            'language'=>Yii::t('core/admin', 'Site language'),
            'db_host'=> Yii::t('core/admin', 'Database host'),
            'db_dbname'=> Yii::t('core/admin', 'Database name'),
            'db_username'=>Yii::t('core/admin', 'Database user'),
            'db_password'=>Yii::t('core/admin', 'Database password'),
            'db_tablePrefix'=>Yii::t('core/admin','The default prefix for table names'),
            'admin_email'=>Yii::t('core/admin','Admin email'),
            'admin_username'=>Yii::t('core/admin','Admin username'),
            'admin_pass'=>Yii::t('core/admin','Admin password'),
        );
    }

    /**
     * Check connection to DB
     */
    public function checkConnect($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $connection = @mysql_connect($this->db_host, $this->db_username, $this->db_password);
            if ($connection)
                $connection = @mysql_select_db($this->db_dbname, $connection);

            if(!$connection)
                $this->addError('db_host',Yii::t('core/admin', 'Cannot connect to the database.'));
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function setup()
    {
        if ($this->validate())
        {
            $configFile = Yii::app()->basePath.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."main.php";
            $configString = Yii::app()->controller->renderPartial('configFile',array('model'=>$this), true);


            $config = fopen($configFile, 'w+');
            if ($config)
            {
                fwrite($config, $configString);

                fclose($config);

                @chmod($configFile, 0666);
            }

            $paramsFile = Yii::app()->basePath.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."params.php";
            $paramsString = Yii::app()->controller->renderPartial('paramsFile',array('model'=>$this), true);
            $params = fopen($paramsFile, 'w+');
            if ($params)
            {
                fwrite($params, $paramsString);

                fclose($params);

                @chmod($paramsFile, 0666);
            }

            $connectionString = "mysql:host=".$this->db_host.";dbname=".$this->db_dbname;
            $connection=new CDbConnection($connectionString,$this->db_username,$this->db_password);
            $connection->tablePrefix = $this->db_tablePrefix;
            $connection->active=true;
            Yii::app()->setComponent('db', $connection);


            // Install core admin
            $runner=new CConsoleCommandRunner();
            $runner->commands=array(
                'migrate' => array(
                    'class' => 'system.cli.commands.MigrateCommand',
                    'migrationTable' => '{{migration_core}}',
                    'interactive' => false,
                ),
            );

            ob_start();
            $runner->run(array(
                'yiic',
                'migrate',
            ));
            ob_get_clean();

            // Create admin user
            $admin = new User();
            $admin->username = $this->admin_username;
            $admin->email = $this->admin_email;
            $admin->password = $this->admin_pass;
            $admin->name = 'Administrator';
            $admin->role = 'admin';
            $admin->status = User::STATUS_ACTIVE;
            $admin->save(false);

            $systemLanguage = new Language();
            $systemLanguage->name = 'en';
            $systemLanguage->title = 'English';
            $systemLanguage->status = Language::STATUS_SYSTEM;
            $systemLanguage->save(false);

            // save modules config file
            Module::saveModulesConfig();
            return true;
        } else
            return false;

    }
}
