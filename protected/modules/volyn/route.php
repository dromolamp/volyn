<?php
return array(
    'order'=>'1',
    'rules'=>array(
        "volyn/<controller>/<action>"=>"volyn/<controller>/<action>",
        '/article/<seo_link:\w+>'=>'/volyn/article/view',
        '/production/<seo_link:\w+>'=>'/volyn/production/view',
        "/<controller>/<action>"=>"volyn/<controller>/<action>",
        '/about'=>'/volyn/about/index',
    )
);