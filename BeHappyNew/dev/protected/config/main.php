<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Circle Shouts',

	// preloading 'log' component
	'preload'=>array('preload','log'),

    
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'extensions'.DIRECTORY_SEPARATOR.'bootstrap'), // change this if necessary
    ),
    
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		
		
           
	),

	'modules' => array(
        'gii' => array(
            'generatorPaths' => array('bootstrap.gii'),
            'class'=>'system.gii.GiiModule',
            'password'=>'yii',

        ),



'comment'=>array(
            'class'=>'ext.comment-module.CommentModule',
            'commentableModels'=>array(
                // define commentable Models here (key is an alias that must be lower case, value is the model class name)
                'post'=>'videos',
                'post_id'=>'battles'
            ),
            // set this to the class name of the model that represents your users
            'userModelClass'=>'users',
            // set this to the username attribute of User model class
            'userNameAttribute'=>'id',
            // set this to the email attribute of User model class
            'userEmailAttribute'=>'email',
            // you can set controller filters that will be added to the comment controller {@see CController::filters()}
//          'controllerFilters'=>array(),
            // you can set accessRules that will be added to the comment controller {@see CController::accessRules()}
//          'controllerAccessRules'=>array(),
            // you can extend comment class and use your extended one, set path alias here
//          'commentModelClass'=>'comment.models.Comment',
        ),





    ),
    
	'defaultController'=>'site',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,

		),

		'cache'=>array(
		   'class'=>'system.caching.CDbCache',
		    'connectionID'=>'db',
      		'cacheTableName'=>'search_cache',
		 ),
		'authManager'=>array(
            'class'=>'CPhpAuthManager',
         // 'authFile' => '/config/'                  // only if necessary
        ),
        
      'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',   
        ),
		'file'=>array(
            'class'=>'application.extensions.file.CFile',
        ),
      
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=behappy_dev',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '6%hHByeMdSC=A=3E',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		
		
			
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
				'urlFormat'=>'path',
				'showScriptName'=>false,
				'rules'=>array(
					
				"Post/<id:.+>"=> "posts/post",
				"post/<id:.+>"=> "posts/post",
				"Circle/<id:.+>"=> "circles/circle",
				"circle/<id:.+>"=> "circles/circle",
				"User/<id:.+>"=> "users/profile",
				"user/<id:.+>"=> "users/profile",
				"/<id:\d+>"=>"Contentids/get_controller",
				

			)),


		'easyImage' => array(
        'class' => 'application.extensions.easyimage.EasyImage',
        //'driver' => 'GD',
        //'quality' => 100,
        //'cachePath' => '/assets/easyimage/',
        //'cacheTime' => 2592000,
        //'retinaSupport' => false,
),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*-
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			
			),
		),
		's3'=>array(
        'class'=>'ext.s3.ES3',
        'aKey'=>'AKIAITGKHSCL2FBRUUKA', 
        'sKey'=>'s6GnlgDI91NL4d5rEIEQt7uRZIVUlEbQaS7qker3',
  	  ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).DIRECTORY_SEPARATOR.'params.php'),

);
