<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => array(

		
		'oracle' => array(
		    
		    'driver'   => 'oracle',
		    'host'     => '116.90.227.177',
		    'port'     => '1521',
		    'database' => 'xe',
		    'username' => 'wsnlive',
		    'password' => 'wsn',
		    'charset'  => 'AL32UTF8',
		    'prefix'   => '',
		)

	),

);
