<div id="formcenter">

	<?php if($model->hasErrors()): ?>
	<div class="errordiv">
		<?php echo CHtml::errorSummary($model); ?>
	</div>
	<?php endif; ?>
	
	<?php echo CHtml::form('', 'post', array('class'=>'frmcontact')); ?>
	
	<div id='loginform'>
		
		<?php echo CHtml::activeLabel($model, 'email'); ?>
		<?php echo CHtml::activeTextField($model, 'email', array( 'class' => 'textboxcontact tiptopfocus', 'title' => Yii::t('login', 'Enter your email address') )); ?>
		<?php echo CHtml::error($model, 'email', array( 'class' => 'errorfield' )); ?>

		<br />
		
		<?php echo CHtml::activeLabel($model, 'password'); ?>
		<?php echo CHtml::activePasswordField($model, 'password', array( 'class' => 'textboxcontact tiptopfocus', 'title' => Yii::t('login', 'Enter your password') )); ?>
		<?php echo CHtml::error($model, 'password', array( 'class' => 'errorfield' )); ?>
		
		<br />

		
		<p>
			<?php echo CHtml::submitButton('Đăng nhập', array('class'=>'submitcomment', 'name'=>'submit')); ?>
		</p>
		
	</div>
	
	<?php echo CHtml::endForm(); ?>
	
</div>

<script>
function showOAuth()
{
	window.open('<?php echo $this->createUrl( 'facebooklogin' ); ?>');
}
function showFaceBookAuth()
{
	window.open('<?php echo $facebookLink; ?>', 'Facebook Login',"status=1,height=600,width=700");
}
</script>
