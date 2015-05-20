<?php

include_once '../src/MongoMonitor.php';

// get monitor class
$MongoMonitor = new MongoMonitor();
// start the db profiling
$MongoMonitor->setLogLevel();
