<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" lang="<?php echo Yii::app()->language; ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset; ?>">
            <meta name="google-site-verification" content="hg9AUxRqyk32CF675HLq6Wo0Mmb0rHOGCNSvXNUV6G4" />
            <title><?php echo ( count($this->pageTitle) ) ? implode(' - ', array_reverse($this->pageTitle)) : $this->pageTitle; ?></title>

            <?php Yii::app()->clientScript->registerCssFile(Yii::app()->themeManager->baseUrl . '/style/style.css', 'screen'); ?>

            <?php
            if (Yii::app()->locale->getOrientation() == 'rtl') {
                Yii::app()->clientScript->registerCssFile(Yii::app()->themeManager->baseUrl . '/style/rtl.css', 'screen');
            }
            ?>

            <!--[if lt IE 7]>
            <style type="text/css">@import "<?php echo Yii::app()->themeManager->baseUrl; ?>/style/ie.css";</style>
            <script src="<?php echo Yii::app()->themeManager->baseUrl; ?>/script/DD_belatedPNG.js" type="text/javascript"></script>
            <script type="text/javascript">
                    DD_belatedPNG.fix('#logo span, #intro, #menuslide li, #texttestimonial, .icon1, .icon2, .icon3, .icon4, .icon5, .icon6, .icon7, .icon8, .icon9, .icon10, .icon11, .icon12, .icon13, .icon14, .icon15, .icon16, .icon17, .icon18, .icon19, #placepriceslide li, .ribbon1, .ribbon2, .ribbon3, #placemainmenu, .iconmini1, .iconmini2, #menupopup li div, #placemainmenu ul li ul li, #menupopup li div a.linkpopupdownload, #menupopup li div a.linkpopuprelease, #contentbottom, #placetwitter, img');
            </script>
            <![endif]-->
            <!--[if IE 7]><style type="text/css">@import "<?php echo Yii::app()->themeManager->baseUrl; ?>/style/ie7.css";</style>
            <script src="<?php echo Yii::app()->themeManager->baseUrl; ?>/script/DD_belatedPNG.js" type="text/javascript"></script>
            <script type="text/javascript">
                    DD_belatedPNG.fix('#menupopup li div');
            </script>
            <![endif]-->

            <?php
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile(Yii::app()->themeManager->baseUrl . '/script/tiptip/jquery.tipTip.minified.js', CClientScript::POS_END);
            Yii::app()->clientScript->registerCssFile(Yii::app()->themeManager->baseUrl . '/script/tiptip/tipTip.css', 'screen');
            Yii::app()->clientScript->registerScriptFile(Yii::app()->themeManager->baseUrl . '/script/global.js', CClientScript::POS_END);
            ?>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    </head>
    <body>

        <div id="login-box" class="login">
            <p class="login_title"> Đăng nhập</p>
            <a href="#" class="close"><img src="close.png" class="img-close" title="Close Window" alt="Close" /></a>
            <form method="post" class="login-content" action="#">
                <label class="username">
                    <span>Tên hoặc email</span>
                    <input id="username" name="username" value="" type="text" autocomplete="on" placeholder="Username">
                </label>
                <label class="password">
                    <span>Mật khẩu</span>
                    <input id="password" name="password" value="" type="password" placeholder="Password">
                </label>
                <button class="button submit-button" type="button">Đăng nhập</button>
                <p>
                    <a class="forgot" href="#">Quên mật khẩu?</a>
                </p>        
            </form>
        </div>

        <div id="wrapper">
            <div id="header">
                <a href="<?php echo $this->createUrl('index/index'); ?>" class="replace" id="logo"><span></span>logo</a>
                <ul id="menutop">
                    <li><a href="<?php echo $this->createUrl('index/index', array('lang' => 'vi')); ?>"><?php echo Yii::t('global', 'Vietnamese'); ?></a></li>
                    <li class="last"><a href="<?php echo $this->createUrl('index/index', array('lang' => 'en')); ?>"><?php echo Yii::t('global', 'English');
            ?></a></li>
                    <li class="last"><a href="<?php echo $this->createUrl('index/index', array('lang' => 'ca')); ?>"><?php echo Yii::t('global', 'China');
            ?></a></li>
                    
                </ul>
            </div>
            <?php if (Yii::app()->getController()->id == 'index'): ?>
                <?php // $this->widget('widgets.menuslide');  ?>
            <?php endif; ?>
            <?php $this->widget('widgets.postsidebar'); ?>
            <div id="contenttop"></div>
            <div id="content">
                <?php if (count($this->breadcrumbs)): ?>
                    <div id="newsinfo">
                        <?php
                        $this->widget('zii.widgets.CBreadcrumbs', array(
                            'homeLink' => CHtml::link(Yii::t('global', 'Home'), array('index/index')),
                            'links' => $this->breadcrumbs
                        ));
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Start Notifications -->
                <?php if (Yii::app()->user->hasFlash('error')): ?>
                    <div class="notification errorshow png_bg">
                        <a href="#" class="close"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/cross_grey_small.png" title="<?php echo Yii::t('global', 'Close this notification'); ?>" alt="close" /></a>
                        <div><?php echo Yii::app()->user->getFlash('error'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if (Yii::app()->user->hasFlash('attention')): ?>
                    <div class="notification attention png_bg">
                        <a href="#" class="close"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/cross_grey_small.png" title="<?php echo Yii::t('global', 'Close this notification'); ?>" alt="close" /></a>
                        <div><?php echo Yii::app()->user->getFlash('attention'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if (Yii::app()->user->hasFlash('information')): ?>
                    <div class="notification information png_bg">
                        <a href="#" class="close"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/cross_grey_small.png" title="<?php echo Yii::t('global', 'Close this notification'); ?>" alt="close" /></a>
                        <div><?php echo Yii::app()->user->getFlash('information'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="notification success png_bg">
                        <a href="#" class="close"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/cross_grey_small.png" title="<?php echo Yii::t('global', 'Close this notification'); ?>" alt="close" /></a>
                        <div><?php echo Yii::app()->user->getFlash('success'); ?></div>
                    </div>
                <?php endif; ?>	
                <!-- End Notifications -->
                <!--                online: <?php // Yii::app()->counter->refresh(); echo Yii::app()->counter->getOnline();       ?>
                                today: <?php // echo Yii::app()->counter->getToday();       ?><br />
                                yesterday: <?php // echo Yii::app()->counter->getYesterday();       ?><br />
                                total: <?php // echo Yii::app()->counter->getTotal();       ?><br />-->

                <?php echo $content; ?>

            </div>

            <?php if (Yii::app()->getController()->id == 'index'): ?>

                <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->themeManager->baseUrl . '/script/twitter.js', CClientScript::POS_END); ?>
                <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->themeManager->baseUrl . '/script/gettwitter.js', CClientScript::POS_END); ?>

            <?php endif; ?>

            <div id='bottomnew'>&nbsp;</div>


        </div>
        <!-- Feedback button -->
        <div class='feedbackbutton'>
            <a href='<?php echo $this->createUrl('contactus/index'); ?>'>
                <img src='<?php echo Yii::app()->themeManager->baseUrl; ?>/images/feedbackbutton<?php echo Yii::app()->language; ?>.png' alt='' />
            </a>
        </div>
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <script type="text/javascript">
            try {
                var pageTracker = _gat._getTracker("UA-15161565-1");
                pageTracker._trackPageview();
            } catch (err) {
            }

            $(document).ready(function() {
                $('a.login-window').click(function() {

                    //lấy giá trị thuộc tính href - chính là phần tử "#login-box"
                    var loginBox = $(this).attr('href');

                    //cho hiện hộp đăng nhập trong 300ms
                    $(loginBox).fadeIn("slow");

                    // thêm phần tử id="over" vào sau body
                    $('body').append('<div id="over"></div>');
                    $('#over').fadeIn(300);

                    return false;
                });

                // khi click đóng hộp thoại
                $(document).on('click', "a.close, #over", function() {
                    $('#over, .login').fadeOut(300, function() {
                        $('#over').remove();
                    });
                    return false;
                });

            });
        </script>
    </body>
</html>