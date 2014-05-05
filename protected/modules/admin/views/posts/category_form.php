<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3><?php echo $label; ?></h3>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content">

        <?php echo CHtml::form(); ?>

        <?php echo CHtml::activeLabel($model, 'title'); ?>
        <?php echo CHtml::activeTextField($model, 'title', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'title', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'description'); ?>
        <?php echo CHtml::activeTextArea($model, 'description', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'description', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'alias'); ?>
        <?php echo CHtml::activeTextField($model, 'alias', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'alias', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'parentid'); ?>
        <?php echo CHtml::activeDropDownList($model, 'parentid', $parents, array('prompt' => '-- Root --', 'class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'parentid', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'language'); ?>
        <?php echo CHtml::activeDropDownList($model, 'language', Yii::app()->params['languages'], array('prompt' => '-- ALL --', 'class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'language', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'metadesc'); ?>
        <?php echo CHtml::activeTextArea($model, 'metadesc', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'metadesc', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'metakeys'); ?>
        <?php echo CHtml::activeTextArea($model, 'metakeys', array('class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'metakeys', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'readonly'); ?>
        <?php echo CHtml::activeCheckBox($model, 'readonly'); ?>
        <?php echo CHtml::error($model, 'readonly', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'viewperms'); ?>
        <?php echo CHtml::activeListBox($model, 'viewperms', $roles, array('size' => 20, 'multiple' => 'multiple', 'class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'viewperms', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'addpostperms'); ?>
        <?php echo CHtml::activeListBox($model, 'addpostperms', $roles, array('size' => 20, 'multiple' => 'multiple', 'class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'addpostperms', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'addcommentsperms'); ?>
        <?php echo CHtml::activeListBox($model, 'addcommentsperms', $roles, array('size' => 20, 'multiple' => 'multiple', 'class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'addcommentsperms', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'addfilesperms'); ?>
        <?php echo CHtml::activeListBox($model, 'addfilesperms', $roles, array('size' => 20, 'multiple' => 'multiple', 'class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'addfilesperms', array('class' => 'input-notification errorshow png_bg')); ?>

        <?php echo CHtml::activeLabel($model, 'autoaddperms'); ?>
        <?php echo CHtml::activeListBox($model, 'autoaddperms', $roles, array('size' => 20, 'multiple' => 'multiple', 'class' => 'text-input medium-input')); ?>
        <?php echo CHtml::error($model, 'autoaddperms', array('class' => 'input-notification errorshow png_bg')); ?>

        <br />

        <p>
            <?php echo CHtml::submitButton(Yii::t('adminglobal', 'Submit'), array('class' => 'button', 'name' => 'submit')); ?>
        </p>

        <?php echo CHtml::endForm(); ?>

    </div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->
<script>
    $(function() {
        $('#PostsCats_title').keyup(function() {
            title = $('#PostsCats_title').val();
            $('#PostsCats_alias').val(convertToSlug(title));
        });
    });
</script>