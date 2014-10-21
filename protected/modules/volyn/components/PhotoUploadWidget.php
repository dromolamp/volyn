<?php
/**
 * Created by JetBrains PhpStorm.
 * User: weblogic
 * Date: 1/31/13
 * Time: 2:45 PM
 * To change this template use File | Settings | File Templates.
 */

class PhotoUploadWidget extends CWidget {

    public $model;

    public function init()
    {

        $criteria = new CDbCriteria();
        $criteria->compare('gallery_id', $this->model->id);

        $dataProvider = new CActiveDataProvider('Photo', array(
            'criteria'=>$criteria,
        ));

        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'photo-grid-slide',
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                array(
                    'name'=>'url',
                    'type'=>'image',
                    'value'=>'$data->getImage(250, 150)'
                ),
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{delete}',
                    'deleteButtonUrl'=>'Yii::app()->controller->createUrl("/euroregionbug/admin/photo/delete",array("id"=>$data->primaryKey))',
                ),
            ),
        ));

        $photoModel = new Photo();
        $this->widget('application.modules.euroregionbug.extensions.xupload.XUpload', array(
            'url' => Yii::app()->createUrl("/euroregionbug/admin/photo/upload"),
            'model' => $photoModel,
            'attribute' => 'image',
            'multiple' => true,
            'options' => array(
                'formData'=>array(
                    'Photo[gallery_id]'=>$this->model->id,
                )
            ),
            'htmlOptions'=>array(
                'id'=> get_class($photoModel)."-form",
            )
        ));
    }
}