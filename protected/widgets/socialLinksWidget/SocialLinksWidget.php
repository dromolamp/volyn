<?php
/**
 * Created by PhpStorm.
 * User: peter
 * E-mail: petro.stasuk.990@gmail.com
 * Date: 31.01.14
 * Time: 15:07
 */

class SocialLinksWidget extends CmsWidget
{
    public function init()
    {
        $links = SocialNetworkLink::model()->findAllByAttributes(array(
            'status'=>SocialNetworkLink::STATUS_PUBLISH
        ));
        if (!empty($links))
            $this->render('links', array(
                'links'=>$links
            ));
    }
} 