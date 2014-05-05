<?php
/**
 * User comments model
 */
class UserComments extends CActiveRecord
{		
	/**
	 * @return object
	 */
	    public static function model($classname=__CLASS__) {
        return parent::model($classname);
    }
	
	/**
	 * @return string Table name
	 */
	public function tableName()
	{
		return '{{usercomments}}';
	}
	
	/**
	 * Relations
	 */
	public function relations()
	{
		return array(
		    'user' => array(self::BELONGS_TO, 'Members', 'userid'),
			'author' => array(self::BELONGS_TO, 'Members', 'authorid'),
		);
	}
	
	/**
	 * Attribute values
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'comment' => Yii::t('users', 'Comment'),
		);
	}
	
	/**
	 * Before save operations
	 */
	public function beforeSave()
	{
		if( $this->isNewRecord )
		{
			$this->postdate = time();
			$this->authorid = Yii::app()->user->id;
		}
		
		return parent::beforeSave();
	}
	
	/**
	 * Scopes
	 */
	public function scopes()
	{
		return array(
					'orderDate'=>array(
		                'order'=>'postdate DESC',
		            ),
		        );
	}
	
	/**
	 * table data rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('comment', 'required' ),
		);
	}
}