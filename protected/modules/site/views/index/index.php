<div id='indexcontent'>
    <div id="maincontenthome">
        <?php foreach (PostsCats::model()->getCatsForMember(Yii::app()->language) as $key => $value): ?>
            <div id="contentleft">
                <h2><?php echo CHtml::link(CHtml::encode($value->title), array('/'.Yii::app()->language.'/posts/' . $value->alias, 'lang' => false)); ?></h2>

                <ul class="listicon">
                    <?php foreach ($this->getPosts($value->id) as $k => $post): ?>
                        <li class="icon9">
                            <strong><?php echo $post->title; ?></strong><br />
                            <?php echo $post->description; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>	
        <div class="clear"></div>

    </div>

</div>
<div class="clear"></div>

<?php echo $facebook->includeScript(Yii::app()->params['facebookappid']); ?>		