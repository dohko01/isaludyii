<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'iSalud',
	'theme'=>'abound',
	'language'=>'es',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'passisalud',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=> array('ext.gii.generators'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
            'caseSensitive'=>true,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			'tablePrefix'=>'',
			'connectionString' => 'pgsql:host=localhost;port=5432;dbname=isalud',
			'username'=>'usrisalud',
			'password'=>'passisalud',
			'charset'=>'UTF8',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

        'request'=>array(
            'enableCsrfValidation'=>true,
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        // Ruta al directorio donde se suben los archivos de las fuentes de datos
        'pathUploads'=>'application.data.uploads',
        // Prefijo para las tablas de los indicadores
        'prefixTblIndicador'=>'ind_',
        // Prefijo para las tablas de las variables
        'prefixTblVariable'=>'var_',
        // Orden de aparicion de los campos que contienen lugares
        'orderedColumLugar'=>array(
            'id_estado',
            'id_institucion',
            'id_jurisdiccion',
            'id_municipio',
            'clues',
        ),
        // Orden de aparicion de los campos que contienen tiempo
        'orderedColumTiempo'=>array(
            'anio',
            'semestre',
            'cuatrimestre',
            'trimestre',
            'bimestre',
            'mes',
            'quincena',
            'semana',
        ),
        // Numero de filas a mostrar por pagina en el CGridView
        'filasPorPagina'=>25,
	),
);