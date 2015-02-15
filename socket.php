<?php

	if(!($socket = socket_create(AF_INET, SOCK_STREAM, 0)))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	     
	    die("Couldn't create socket: [$errorcode] $errormsg <br>");
	}

	echo "Socket created <br>";

	if(!socket_connect($socket , '199.111.151.30' , 51717))
	{
	    $errorcode = socket_last_error();
	    $errormsg = socket_strerror($errorcode);
	     
	    die("Could not connect: [$errorcode] $errormsg <br>");
	}
 
	echo "Connection established <br>";

	// $socket = socket_create(AF_UNIX,  SOCK_STREAM, SOL_TCP);
	// var_dump(socket_strerror($errorcode));
	// var_dump($socket);
	// var_dump(socket_connect($socket , '199.111.151.30' , 51717));
	// $socket = socket_bind($socket, 'test');
	// socket_listen($socket);
	// var_dump(socket_read($socket, 500));

?>