<?php

/**
 * Source message model
 */
class SourceMessage extends CActiveRecord {

    /**
     * @return SourceMessage
     */
    public static function model($classname = __CLASS__) {
        return parent::model($classname);
    }

    /**
     * @return string Table name
     */
    public function tableName() {
        return '{{sourceMessage}}';
    }

}