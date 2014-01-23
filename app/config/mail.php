<?php

return array(

	'driver' => 'smtp',   'host' => 'whub32.webhostinghub.com',     'port' => 25,
'from' => array('address' => 'projectmanager@healmydisease.com', 'name' => 'Support'),
'encryption' => 'tls',     'username' => 'projectmanager@healmydisease.com',
'password' => 'laravel',     'sendmail' => '/usr/sbin/sendmail -bs',       'pretend' => false,

);