<?php

/**
 * Index controller Home page
 */
class IndexController extends SiteBaseController {

    /**
     * Controller constructor
     */
    public function init() {
        parent::init();
    }

    /**
     * Index action
     */
    public function actionindex() {
        $sent = false;
   
        // Load facebook
        Yii::import('ext.facebook.facebookLib');
        $facebook = new facebookLib(array('appId' => Yii::app()->params['facebookappid'],
            'secret' => Yii::app()->params['facebookapisecret'], 'cookie' => true, 'disableSSLCheck' => false));
        facebookLib::$CURL_OPTS[CURLOPT_CAINFO] = Yii::getPathOfAlias('ext.facebook') . '/ca-bundle.crt';

        $this->render('index', array( 'facebook' => $facebook, 'sent' => $sent));
    }

    public function getPosts($id) {
              $criteria = new CDbCriteria(array(
            'order' => 'postdate DESC',
        ));
        $criteria->compare('catid', $id);
        $criteria->compare('language', Yii::app()->language);
        $model = Posts::model()->findAll($criteria);
        return $model;
    }

}