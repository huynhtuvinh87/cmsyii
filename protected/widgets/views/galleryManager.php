<?php echo CHtml::openTag('div', $this->htmlOptions); ?>
<!-- Gallery Toolbar -->
<div class="btn-toolbar gform">
    <span class="btn btn-success fileinput-button">
        <i class="icon-plus icon-white"></i>
        <?php echo 'Add…'; ?>
        <input type="file" name="image" class="afile" accept="image/*" multiple="multiple"/>
    </span>

    <div class="btn-group">
        <label class="btn">
            <input type="checkbox" style="margin: 0;" class="select_all"/>
            <?php echo 'Select all'; ?>
        </label>
        <span class="btn disabled edit_selected"><i class="icon-pencil"></i> <?php echo 'Edit'; ?></span>
        <span class="btn disabled remove_selected"><i class="icon-remove"></i> <?php echo 'Remove'; ?></span>
    </div>
</div>
<hr/>
<!-- Gallery Photos -->
<div class="sorter">
    <div class="images"></div>
    <br style="clear: both;"/>
</div>

<!-- Modal window to edit photo information -->
<div class="modal hide editor-modal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>

        <h3><?php echo 'Edit information' ?></h3>
    </div>
    <div class="modal-body">
        <div class="form"></div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary save-changes">
            <?php echo 'Save changes' ?>
        </a>
        <a href="#" class="btn" data-dismiss="modal"><?php echo 'Close' ?></a>
    </div>
</div>
<div class="overlay">
    <div class="overlay-bg">&nbsp;</div>
    <div class="drop-hint">
        <span class="drop-hint-info"><?php echo 'Drop Files Here…' ?></span>
    </div>
</div>
<div class="progress-overlay">
    <div class="overlay-bg">&nbsp;</div>
    <!-- Upload Progress Modal-->
    <div class="modal progress-modal">
        <div class="modal-header">
            <h3><?php echo 'Uploading images…' ?></h3>
        </div>
        <div class="modal-body">
            <div class="progress progress-striped active">
                <div class="bar upload-progress"></div>
            </div>
        </div>
    </div>
</div>
<?php echo CHtml::closeTag('div'); ?>
