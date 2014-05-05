<div id="formcenter">

    <?php
//    $fp = fopen(Yii::getPathOfAlias('webroot.protected.config') . 'modules.php', 'r');
//    fwrite($fp, '1234');
//    $file = fopen(Yii::getPathOfAlias('webroot.protected.config') . 'modules.php', 'r+');
    $file = Yii::getPathOfAlias('webroot.protected.config') . '/modules.php';
    $text = file_get_contents($file);
    ?>
    <?php echo CHtml::form(); ?>
    <textarea name="editor" style="width: 500px; height: 300px">
        <?php echo $text; ?>
    </textarea>
    <input type="submit" value="Submit">
    <?php echo CHtml::endForm(); ?>
</div>