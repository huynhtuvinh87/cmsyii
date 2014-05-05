<?php

/**
 * Admin module class
 */
class ContactModule extends MasterModule
{

    /**
     * Default admin theme
     */
    public $tableContact = '{{contactus}}';

    /**
     * Module constructor - Builds the initial module data
     *
     * @author vadim
     */
    public function init()
    {
        $this->setImport(array(
            'contact.models.*',
            'contact.components.*',
        ));



        // Set theme url
        Yii::app()->themeManager->setBaseUrl(Yii::app()->theme->baseUrl);
        Yii::app()->themeManager->setBasePath(Yii::app()->theme->basePath);

        // Set error handler
        Yii::app()->errorHandler->errorAction = 'site/error/error';

        /* Make sure we run the master module init function */
        parent::init();
    }

}