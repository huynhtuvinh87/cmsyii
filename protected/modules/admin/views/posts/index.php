<div class='floatright'>
    <?php echo CHtml::link(Yii::t('lable', 'Add Category'), array('posts/addcategory'), array('class' => 'button')); ?>
    <?php echo CHtml::link(Yii::t('lable', 'Add News'), array('posts/addnews'), array('class' => 'button')); ?>
</div>

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3><?php echo 'Categories'; ?></h3>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content">
        <?php echo CHtml::form(); ?>
        <table>
            <thead>
                <tr>
                    <th style='width: 5%;'><?php echo 'Position'; ?></th>
                    <th style='width: 20%;'><?php echo 'Title'; ?></th>
                    <th style='width: 10%;'><?php echo 'Alias'; ?></th>
                    <th style='width: 25%;'><?php echo 'Description'; ?></th>
                    <th style='width: 10%;'><?php echo 'Language'; ?></th>
                    <th style='width: 5%;'><?php echo 'Read'; ?></th>
                    <th style='width: 10%;'><?php echo 'Posts'; ?></th>
                    <th style='width: 15%;'><?php echo 'Options'; ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="8">	
                        <div class="bulk-actions align-left">
                            <?php echo CHtml::submitButton('Sắp xếp', array('name' => 'submit', 'class' => 'button')); ?>
                        </div>
                        <div class="clear"></div>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php if (count(PostsCats::model()->getRootCats())): ?>

                    <?php foreach (PostsCats::model()->getRootCats() as $row): ?>
                        <tr>
                            <td><?php echo CHtml::textField('pos[' . $row->id . ']', $row->position, array('size' => 1)); ?></td>
                            <td><a href="<?php echo $this->createUrl('posts/viewcategory', array('id' => $row->id)); ?>" title="" class='tooltip'><?php echo CHtml::encode($row->title); ?></a></td>
                            <td><?php echo CHtml::encode($row->alias); ?></td>
                            <td><?php echo CHtml::encode($row->description); ?></td>
                            <td><?php echo Message::model()->getLanguageNames($row->language); ?></td>
                            <td><?php echo Yii::app()->func->adminYesNoImage($row->readonly, array('news/catreadonly', 'id' => $row->id)); ?></td>
                            <td><?php echo Yii::app()->format->number($row->count); ?></td>
                            <td>
                                <!-- Icons -->
                                <a href="<?php echo Yii::app()->urlManager->createUrl('news/category/' . $row->alias, array('lang' => false)); ?>" title="" class='tooltip'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/preview.png" alt="View" /></a>
                                <a href="<?php echo $this->createUrl('posts/addposts', array('catid' => $row->id)); ?>" title="" class='tooltip'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/add.png" alt="Add" /></a>
                                <a href="<?php echo $this->createUrl('posts/addcategory', array('parentid' => $row->id)); ?>" title="" class='tooltip'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/addsub.png" alt="Add" /></a>
                                <a href="<?php echo $this->createUrl('posts/editcategory', array('id' => $row->id)); ?>" title="" class='tooltip'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/pencil.png" alt="Edit" /></a>
                                <a href="<?php echo $this->createUrl('posts/deletecategory', array('id' => $row->id)); ?>" title=" "class='tooltip deletelink'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/cross.png" alt="Delete" /></a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                <?php else: ?>	
                    <tr>
                        <td colspan='8' style='text-align:center;'><?php echo 'Không có dữ liệu'; ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php echo CHtml::endForm(); ?>
    </div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->
