<div class='floatright'>
    <?php echo CHtml::link('Add Auth Item', array('roles/addauthitem'), array('class' => 'button')); ?>
</div>

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">
        <h3><?php echo 'Auth Items'; ?> (<?php echo $count; ?>)</h3>
    </div> <!-- End .content-box-header -->

    <div class="content-box-content">

        <table>
            <thead>
                <tr>
                    <th><?php echo $sort->link('name', 'Name', array('class' => 'tooltip', 'title' => 'Sort list by name')); ?></th>
                    <th><?php echo $sort->link('description', 'Description', array('class' => 'tooltip', 'title' => 'Sort list by description')); ?></th>
                    <th><?php echo $sort->link('type', 'Type', array('class' => 'tooltip', 'title' => 'Sort list by type')); ?></th>
                    <th><?php echo 'Children'; ?></th>
                    <th><?php echo 'Options'; ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="6">													
                        <?php $this->widget('widgets.admin.pager', array('pages' => $pages)); ?>
                        <div class="clear"></div>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php if (count($rows)): ?>

                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><a href="<?php echo $this->createUrl('roles/viewauthitem', array('parent' => $row->name)); ?>" title="<?php echo 'View Auth Item'; ?>" class='tooltip'><?php echo CHtml::encode($row->name); ?></a></td>
                            <td><?php echo CHtml::encode($row->description); ?></td>
                            <td><?php echo AuthItem::model()->types[$row->type]; ?></td>
                            <td class='tooltip' title='<?php echo 'Item Children'; ?>'><?php echo count(Yii::app()->authManager->getItemChildren($row->name)); ?></td>
                            <td>
                                <!-- Icons -->
                                <a href="<?php echo $this->createUrl('roles/addauthitemchild', array('parent' => $row->name)); ?>" title="<?php echo 'Add auth child item'; ?>" class='tooltip'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/add.png" alt="add" /></a>
                                <a href="<?php echo $this->createUrl('roles/editauthitem', array('id' => $row->name)); ?>" title="<?php echo 'Edit this auth item'; ?>" class='tooltip'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/pencil.png" alt="Edit" /></a>
                                <a href="<?php echo $this->createUrl('roles/deleteauthitem', array('id' => $row->name)); ?>" title="<?php echo 'Delete this auth item!'; ?> "class='tooltip deletelink'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/cross.png" alt="Delete" /></a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                <?php else: ?>	
                    <tr>
                        <td colspan='5' style='text-align:center;'><?php echo 'No items found.'; ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->
