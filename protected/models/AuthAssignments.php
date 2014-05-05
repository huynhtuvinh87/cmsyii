<?php

/**
 * auth item child model
 */
class AuthAssignments extends CActiveRecord {

    /**
     * @return object
     */
    public static function model($classname = __CLASS__) {
        return parent::model($classname);
    }

    /**
     * @return string Table name
     */
    public function tableName() {
        return '{{authassignment}}';
    }

}