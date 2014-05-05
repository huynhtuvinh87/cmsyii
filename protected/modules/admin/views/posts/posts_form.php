<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3><?php echo $label; ?></h3>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content">

        <?php echo CHtml::form('', 'post', array('enctype' => 'multipart/form-data')); ?>
        <?php
//    $form = $this->beginWidget('ActiveForm', array(
//        'htmlOptions' => array(
//            'enctype' => 'multipart/form-data',
//            'class' => 'form-horizontal'
//        ),
//    ));
        ?>
        <?php echo CHtml::activeLabel($model, 'title'); ?>
        <?php echo CHtml::activeTextField($model, 'title', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'title', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'description'); ?>
        <?php echo CHtml::activeTextArea($model, 'description', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'description', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'alias'); ?>
        <?php echo CHtml::activeTextField($model, 'alias', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'alias', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'catid'); ?>
        <small><?php echo Yii::t('admintuts', 'Choose a category for this tutorial'); ?></small><br />
        <?php echo CHtml::activeDropDownList($model, 'catid', $parents, array('prompt' => Yii::t('admintuts', '-- Choose --'), 'class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'catid', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'language'); ?>
        <small><?php echo Yii::t('admintuts', 'The language the tutorial can be displayed in.'); ?></small><br />
        <?php echo CHtml::activeDropDownList($model, 'language', Yii::app()->params['languages'], array('prompt' => Yii::t('adminglobal', '-- ALL --'), 'class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'language', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'image'); ?>
        <?php echo CHtml::activeFileField($model, 'image', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'image', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'metadesc'); ?>
        <?php echo CHtml::activeTextArea($model, 'metadesc', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'metadesc', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'metakeys'); ?>
        <?php echo CHtml::activeTextArea($model, 'metakeys', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'metakeys', array('class' => 'input-notification errorshow png_bg')); ?>
        
        <?php echo CHtml::activeLabel($model, 'status'); ?>
        <?php echo CHtml::activeDropDownList($model, 'status', array(0 => Yii::t('admintuts', 'Hidden (Draft)'), 1 => Yii::t('admintuts', 'Open (Published)')), array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'status', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'content'); ?>
        <?php // $this->widget('widgets.markitup.markitup', array( 'model' => $model, 'attribute' => 'content' )); ?>
        <?php $this->widget('application.widgets.ckeditor.CKEditor', array('model' => $model, 'attribute' => 'content')); ?>
        <?php // $this->widget('application.widgets.ckeditor.CKEditor', array('name' => 'content', 'value' => isset($_POST['content']) ? $_POST['content'] : '', 'editorTemplate' => 'full')); ?>
        <?php echo CHtml::error($model, 'content', array('class' => 'input-notification errorshow png_bg')); ?>

        <br />

        <p>
            <?php echo CHtml::submitButton(Yii::t('adminglobal', 'Submit'), array('class' => 'button', 'name' => 'submit')); ?>
        </p>

        <?php echo CHtml::endForm(); ?>

    </div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->
<script>
    $(function() {
        $('#Posts_title').keyup(function() {
            title = $('#Posts_title').val();
            $('#Posts_alias').val(convertToSlug(title));
        });
    });
</script>
