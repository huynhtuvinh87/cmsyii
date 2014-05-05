<?php

// Side bar menu
$this->widget('zii.widgets.CMenu', array(
    'id' => 'main-nav',
    'items' => array(
        // dashboard
        array(
            'label' => 'Dashboard',
            'url' => array('index/index'),
            'linkOptions' => array('class' => 'nav-top-item no-submenu')
        ),
        // System
        array(
            'label' => 'System',
            'url' => array('system'),
            'visible' => ( Yii::app()->user->checkAccess('op_settings_view_settings') || Yii::app()->user->checkAccess('op_lang_translate') ),
            'linkOptions' => array('class' => 'nav-top-item'),
            'items' => array(
                array(
                    'label' => 'Manage Settings',
                    'visible' => Yii::app()->user->checkAccess('op_settings_view_settings'),
                    'url' => array('settings/index'),
                ),
                array(
                    'label' => 'Manage Languages',
                    'visible' => Yii::app()->user->checkAccess('op_lang_translate'),
                    'url' => array('languages/index'),
                ),
            ),
        ),
        // Management
        array(
            'label' => 'Management',
            'url' => array('management'),
            'visible' => ( Yii::app()->user->checkAccess('op_users_add_users') || Yii::app()->user->checkAccess('op_roles_add_auth') ),
            'linkOptions' => array('class' => 'nav-top-item'),
            'items' => array(
                array(
                    'label' => 'Manage Members',
                    'visible' => Yii::app()->user->checkAccess('op_users_add_users'),
                    'url' => array('members/index'),
                ),
                array(
                    'label' => 'Roles, Tasks & Operations',
                    'visible' => Yii::app()->user->checkAccess('op_roles_add_auth'),
                    'url' => array('roles/index'),
                ),
            ),
        ),
        // Custom Pages		
        array(
            'label' => 'Custom Pages',
            'url' => array('custompages'),
            'visible' => Yii::app()->user->checkAccess('op_custompages_managepages'),
            'linkOptions' => array('class' => 'nav-top-item'),
            'items' => array(
                array(
                    'label' => 'Manage Pages',
                    'url' => array('custompages/index'),
                    'visible' => Yii::app()->user->checkAccess('op_custompages_managepages'),
                ),
            ),
        ),
    ),
));
?>