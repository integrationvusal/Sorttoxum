<?php 

	error_reporting(0);
	define('app_root', realpath('.'));
	define('ds', DIRECTORY_SEPARATOR);
	define('core_path', app_root . ds . 'core');
	
	$__db = Array(
        'prefix' => 'vl1',
		'default' => Array(
            'user' => 'u1051',
            'password' => 'r4qfDfQBqw86hEJc',
            'name' => 'db1051',
            //'port' => '3306',
            'host' => '10.8.1.10',
		),
	);
	
    $appUrl = 'http://sorttoxumagro.gov.az';
    $_adminName = 'admin';

	$__app = Array(
            'url' => $appUrl,
            'debug' => false,
			'dev' => true,
			'url_converter_enabled' => false,
			'use_session' => true,
            'controllers_folder' => app_root . ds . 'controllers',
            'controllers_ext' => '.controller.php',
            'middleware_folder' => app_root . ds . 'middleware',
            'middleware_ext' => '.middleware.php',
            'models_folder' => app_root . ds . 'models',
            'templates_folder' => app_root . ds . 'views',
            'static_url' => $appUrl . '/static',
			'static_files_ext' => Array('css', 'js'),
			'image_extensions' => Array('jpg', 'png', 'bmp'),
			'static_files' => Array(
				'jquery.js',
				'json.js',
				'template.js',
				'actions.js',
			),
			'static_folder' => app_root . ds . 'static',
            'libs_folder' => app_root . ds . 'libs',
            'middleware_list' => Array(
                Array('Middleware','initializeApp'),
				Array('Middleware','forSmarty'),
				Array('Middleware','getLangsUrl'),
				Array('Middleware','getMenu'),
            ),/*
			'smtp' => Array(
				'host' => 'server.bayramov.com',
				'user' => 'noreply@e-kurs.az',
				'password' => 'Prizma2005',
				'port' => '465',
				'security' => 'ssl'
			),*/
			'smtp' => Array(
			    'host' => 'smtp.mail.gov.az',
			    'user' => 'mail@sorttoxumagro.gov.az',
			    'password' => '</SORT+toxum+2016>',
			    'port' => '587',
			    'security' => 'tls'
			),
			'mail' => [
				'to' => 'mail@sorttoxumagro.gov.az'
			],
			'lpw' => Array(
				'from' => 'mail@sorttoxumagro.gov.az',
				'fromName' => 'wwww.sorttoxumagro.gov.az',
			),
            'public_folder' => app_root . ds . 'public',
			'public_url' => $appUrl . '/public',
            'languages' => Array(
				'az' => 'Azərbaycan',
				'ru' => 'Русский',
				'en' => 'English',
            ),
            'language_file_folder' => app_root . ds . 'messages',
            'page_count' => 10,
            'default_language' => 'az',
			'autoload_folders' => Array(
				
				// models
				Array(app_root . ds . 'models','model'),
				Array(app_root . ds . 'models' . ds . 'content','model'),
				Array(app_root . ds . 'models' . ds . 'menu','model'),
				Array(app_root . ds . 'models' . ds . 'filemanager','model'),
				Array(app_root . ds . 'models' . ds . 'admin-users','model'),
				Array(app_root . ds . 'models' . ds . 'menu','model'),
				Array(app_root . ds . 'models' . ds . 'news','model'),
				Array(app_root . ds . 'models' . ds . 'search','model'),
				Array(app_root . ds . 'models' . ds . 'get-link','model'),
				Array(app_root . ds . 'models' . ds . 'labels','model'),
				Array(app_root . ds . 'models' . ds . 'slider','model'),
				Array(app_root . ds . 'models' . ds . 'contact','model'),
				Array(app_root . ds . 'models' . ds . 'photo','model'),
				Array(app_root . ds . 'models' . ds . 'video','model'),

				// controllers
				Array(app_root . ds . 'controllers','controller'),
				Array(app_root . ds . 'modules' . ds . $_adminName . ds . 'controllers', 'controller'),
				Array(app_root . ds . 'controllers' . ds . 'utils', 'controller'),
				Array(app_root . ds . 'controllers' . ds . 'app', 'controller'),
				Array(app_root . ds . 'controllers' . ds . 'content', 'controller'),
				Array(app_root . ds . 'controllers' . ds . 'auth', 'controller'),
				Array(app_root . ds . 'controllers' . ds . 'search', 'controller'),
				Array(app_root . ds . 'controllers' . ds . 'contact', 'controller'),
				Array(app_root . ds . 'controllers' . ds . 'gallery', 'controller'),

				// middleware
				Array(app_root . ds . 'middleware','middleware'),
				
				// forms
				Array(app_root . ds . 'forms','form'),
				Array(app_root . ds . 'modules' . ds . $_adminName . ds . 'forms','form'),
			),
			'image_extensions' => Array('jpg', 'jpeg', 'png', 'gif', 'bmp'),
			'allowed_extensions' => Array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'txt', 'doc', 'docx', 'xls', 'xlsx', 'pdf'),
	);
        
		$_developFolder = 'developer';
        
        $__modules = Array(
            'admin' => Array(
				'version' => '8.0',
                'folder' => app_root . ds . 'modules' . ds . $_adminName,
                'static_url' => $appUrl . '/modules/' . $_adminName . '/static',
				'static_folder' => app_root . ds . 'modules' . ds . $_adminName . ds . 'static',
				'messages_folder' => app_root . ds . 'modules' . ds . $_adminName . ds . 'messages',
				'static_files' => Array(
					'jquery.js',
					'lang.az.js',
					'date-controller.js',
					'json.js',
					'template.js',
					'taskbar.js',
					'tab-controller.js',
					'checkbox-controller.js',
					'select-controller.js',
					'scrollbar-controller.js',
					'scrollbar-dragger.js',
					'desktop.js',
					'dragger.js',
					'resizer.js',
					'tree-dragger.js',
					'window.js',
					'tree.js',
					'filemanager.js',
					'utils.js',
					'main.js',
				),
                'name' => $_adminName,
                'middleware_list' => Array(
					Array('AdminMiddleware','initializeAdmin'),
					Array('AdminMiddleware','checkLoggedIn'),
					Array('AdminMiddleware','authorized'),
                ),
                'middleware_folder' => app_root . ds . 'modules' . ds . $_adminName . ds . 'middleware',
                'controllers_folder' => app_root . ds . 'modules' . ds . $_adminName . ds . 'controllers',
                'models' => Array(
					'ContactModel',
					'FileManager',
					'AdminUsersModel',
					'AdminUsersGroupModel',
					'NewsModel',
					'LabelsModel',
					'SliderModel',
					'GetPageAddressModel',
					'PhotoModel',
					'VideoModel',
					'MenuRelationsModel',
                ),
				'tree_models' => Array(
					0 => Array(
						'MenuRelationsModel',
						'MenuModel',
						'10'
					),
				),
            )
        );

	$__template = Array(
            'debug' => $__app['debug'],
	);
	
	require core_path . ds . 'main.php';

?>