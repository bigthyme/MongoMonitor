<?php

include_once __DIR__ . '/' .  '../src/MongoMonitor.php';

// get monitor class
$MongoMonitor = new MongoMonitor();
// start the db profiling
$MongoMonitor->setLogLevel();
