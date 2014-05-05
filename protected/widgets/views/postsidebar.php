
<div id="placemainmenu">
    <ul id="mainmenu">
        <li><a href='#'><?php echo Yii::t('global', 'Home'); ?></a></li>
        <?php foreach (PostsCats::model()->getCatsForMember(Yii::app()->language) as $key => $value): ?>
            <li><a href ="<?php echo Yii::app()->baseUrl . '/'.Yii::app()->language . '/posts/' . $value->alias ?>"><?php echo $value->title ?></a>
            </li>
        <?php endforeach; ?>	

    </ul>
</div>