<?php

include_once 'connectApplications.php';

include_once 'MigrationClass.php';
$migration = new MigrationClass($host, $dbName, $user, $pass);
$migration->run();