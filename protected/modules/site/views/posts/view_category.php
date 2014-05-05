<div id="maincontent">
    <div id="contentbig">
        <div class='floatright'>
            <?php if (isset($model)): ?>
                <a href ="<?php echo Yii::app()->baseUrl . '/' . Yii::app()->language . '/posts-rss/' . $model->id ?>"><?php echo CHtml::image(Yii::app()->themeManager->baseUrl . '/images/rss.png') ?></a>
                <?php // echo CHtml::link(CHtml::image(Yii::app()->themeManager->baseUrl . '/images/rss.png'), array('rss', 'id' => $model->id), array('title' => Yii::t('global', 'RSS Feed'))); ?>

            <?php else: ?>

                <?php echo CHtml::link(CHtml::image(Yii::app()->themeManager->baseUrl . '/images/rss.png'), array('rss'), array('title' => Yii::t('global', 'RSS Feed'))); ?>

            <?php endif; ?>
        </div>
        <div class='floatleft'>&nbsp;</div>

        <div style='clear'></div>

        <br />

        <?php if (count($posts)): ?>
            <ul id="listnews">
                <?php foreach ($posts as $row): ?>
                    <li <?php if ($row->status == 0): ?>style='background-color:#FFCECE;'<?php endif; ?>>
                        <h2><?php echo CHtml::link(CHtml::encode($row->title), array('/posts/view/' . $row->alias, 'lang' => false)); ?></h2>
                        <?php if (Posts::model()->canEditPost($row)): ?>
                            <?php echo CHtml::link(CHtml::image(Yii::app()->themeManager->baseUrl . '/images/icons/pencil.png'), array('posts/editposts', 'id' => $row->id)); ?>
                        <?php endif; ?>	

                        <?php if (Yii::app()->user->checkAccess('op_posts_manage')): ?>

                            <?php if ($row->status): ?>
                                <?php echo CHtml::link(CHtml::image(Yii::app()->themeManager->baseUrl . '/images/icons/cross_circle.png'), array('posts/togglepost', 'id' => $row->id)); ?>
                            <?php else: ?>
                                <?php echo CHtml::link(CHtml::image(Yii::app()->themeManager->baseUrl . '/images/icons/tick_circle.png'), array('posts/togglepost', 'id' => $row->id)); ?>
                            <?php endif; ?>	

                        <?php endif; ?>

                        <a class="linkcomment"><strong><?php echo $row->commentscount; ?></strong> <?php echo Yii::t('tutorials', 'Comments'); ?></a>

                        <p class="postinfo"><?php echo Yii::t('tutorials', 'Posted by <strong>{by}</strong> in {in} on {on}', array('{by}' => $row->author ? $row->author->getProfileLink() : Yii::t('global', 'Guest'), '{on}' => Yii::app()->dateFormatter->formatDateTime($row->postdate, 'short', 'short'), '{in}' => CHtml::link($row->category->title, array('/tutorials/category/' . $row->category->alias, 'lang' => false)))); ?></p>
                        <p><?php echo CHtml::encode($row->description); ?></p>
                        <div class="clear"></div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
        <?php else: ?>
            <div style='text-align:center;'><?php echo Yii::t('tutorials', 'There are no tutorials to display!'); ?></div>
        <?php endif; ?>

    </div>
</div>

<?php // $this->widget('widgets.postsidebar'); ?>
<div class="clear"></div>
