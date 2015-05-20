<?php

include_once __DIR__ . '/' .  '../src/MongoMonitor.php';

// get monitor class
$MongoMonitor = new MongoMonitor();
// scan the profiling results
$MongoMonitor->scanSystemProfile();
