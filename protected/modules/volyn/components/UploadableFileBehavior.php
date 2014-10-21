<?php
/**
 * @property string $savePath путь к директории, в которой сохраняем файлы
 */
class UploadableFileBehavior extends CActiveRecordBehavior{

    /**
     * @var string имя директории, должно совпадать с именем класса
     */
    public $folder='upload';

    /**
     * @var string название атрибута, хранящего в себе имя файла и файл
     */
    public $attributeName='document';
    /**
     * @var string алиас директории, куда будем сохранять файлы
     */
    public $savePathAlias='webroot.upload';
    /**
     * @var array сценарии валидации к которым будут добавлены правила валидации
     * загрузки файлов
     */
    public $scenarios=array('insert','update');
    /**
     * @var string типы файлов, которые можно загружать (нужно для валидации)
     */
    public $fileTypes='doc,docx,xls,xlsx,odt,pdf,jpg,png';

    /**
     * Шорткат для Yii::getPathOfAlias($this->savePathAlias).DIRECTORY_SEPARATOR.
     * Возвращает путь к директории, в которой будут сохраняться файлы.
     * @return string путь к директории, в которой сохраняем файлы
     */
    public function getSavePath(){
        return Yii::getPathOfAlias($this->savePathAlias).DIRECTORY_SEPARATOR;
    }

    public function attach($owner){
        parent::attach($owner);

        if(in_array($owner->scenario,$this->scenarios)){
            // добавляем валидатор файла
            $fileValidator=CValidator::createValidator('file',$owner,$this->attributeName,
                array('types'=>$this->fileTypes,'allowEmpty'=>true));
            $owner->validatorList->add($fileValidator);
        }
    }

    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeSave($event){
        if(in_array($this->owner->scenario,$this->scenarios) &&
            ($file=CUploadedFile::getInstance($this->owner,$this->attributeName))){
            $this->deleteFile(); // старый файл удалим, потому что загружаем новый

            $this->owner->setAttribute($this->attributeName,$file->name);
            $file->saveAs($this->savePath.$file->name);
        }
        return true;
    }

    // имейте ввиду, что методы-обработчики событий в поведениях должны иметь
    // public-доступ начиная с 1.1.13RC
    public function beforeDelete($event){
        $this->deleteFile(); // удалили модель? удаляем и файл, связанный с ней
    }

    public function deleteFile(){
        $filePath=$this->savePath.$this->owner->getAttribute($this->attributeName);
        if(@is_file($filePath))
            @unlink($filePath);
    }

    public function getUploadFile()
    {
        return Yii::app()->request->baseUrl.'/upload/'.$this->folder.'/'.$this->owner->{$this->attributeName};
    }
}