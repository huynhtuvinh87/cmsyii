<?php

class Message extends CActiveRecord {

    /**
     * @return Message
     */
    public static function model($classname = __CLASS__) {
        return parent::model($classname);
    }

    /**
     * @return string Table name
     */
    public function tableName() {
        return '{{message}}';
    }

    /**
     * Grab language names by their keys
     */
    public function getLanguageNames($lang) {
        if (!$lang) {
            return Yii::t('global', 'All');
        }

        $names = array();

        foreach (explode(',', $lang) as $language) {
            $names[] = Yii::app()->params['languages'][$language];
        }

        return implode(', ', $names);
    }

}