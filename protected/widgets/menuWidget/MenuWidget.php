<?php

class MenuWidget extends CmsWidget
{
    public function init()
    {
        $this->widget('zii.widgets.CMenu',array(
            'htmlOptions' => array('class' => 'sf-menu clearfix'),
            'activeCssClass'=>'current',
            'items'=>Menu::getItems($this->widget->options['menu'],'current'),
        ));
    }
}