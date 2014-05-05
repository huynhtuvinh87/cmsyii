<!DOCTYPE html >
<?php
$baseUrl = Yii::app()->request->baseUrl;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo ( count($this->pageTitle) ) ? implode(' - ', array_reverse($this->pageTitle)) : $this->pageTitle; ?></title>
    </head>
    <body>
        Layout home
        <?php echo $content; ?>
    </body>
</html>