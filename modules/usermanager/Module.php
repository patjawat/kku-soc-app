<?php

namespace app\modules\usermanager;

/**
 * usermanager module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\usermanager\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->layout = '@app/modules/vehicle/views/layouts/main';
        parent::init();

        // custom initialization code goes here
    }
}
