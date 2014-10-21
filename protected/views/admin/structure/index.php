<?php
$this->widget('application.extensions.yii-jstree.widgets.JsTreeWidget',
    array('modelClassName' => 'Route',
        'jstree_container_ID' => 'Route-wrapper',//jstree will be rendered in this div.id of your choice.
        'themes' => array('theme' => 'default', 'dots' => true, 'icons' => true),
        'plugins' => array('themes', 'html_data', 'crrm', 'dnd', 'cookies', 'ui', 'types'),
        'types'=>array(
            'types'=>array(
                'can_have_child'=>array(
                    'valid_children'=>array('can_have_child', 'cannot_have_child')
                ),
                'cannot_have_child'=>array(
                    'valid_children'=>'none'
                ),
                'cannot_move'=>array(
                    'valid_children'=>'none',
                    "select_node"=>false,
                    'move_node'=>false
                )
            ),
        )
    ));
?>