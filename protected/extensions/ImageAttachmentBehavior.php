<?php

/**
 * Behavior for adding gallery to any model.
 *
 * @author Bogdan Savluk <savluk.bogdan@gmail.com>
 */
class GalleryBehavior extends CActiveRecordBehavior {

    public function behaviors() {
        return array(
            'preview' => array(
                'class' => 'ext.imageAttachment.ImageAttachmentBehavior',
                // size for image preview in widget
                'previewHeight' => 200,
                'previewWidth' => 300,
                // extension for image saving, can be also tiff, png or gif
                'extension' => 'jpg',
                // folder to store images
                'directory' => Yii::getPathOfAlias('webroot') . '/images/productTheme/preview',
                // url for images folder
                'url' => Yii::app()->request->baseUrl . '/images/productTheme/preview',
                // image versions
                'versions' => array(
                    'small' => array(
                        'resize' => array(200, null),
                    ),
                    'medium' => array(
                        'resize' => array(800, null),
                    )
                )
            )
        );
    }

}