<body class="four-zero-content">

<?php   $this->widget("Landingnavbar",array("links_enabled"=>true)); ?>

        <div class="four-zero">
            <h2>404!</h2>
            <small>Page not found</small>
            <p><?php echo $error; ?></p>
            
            <footer>
                <a href="<?php echo Yii::app()->request->urlReferrer;?>"><i class="md md-arrow-back"></i></a>
                <a href="<?php echo Helpers::base_url(); ?>"><i class="md md-home"></i></a>
            </footer>
        </div>

        
    </body>