<?php

include_once __DIR__ . '/' .  '../src/MongoMonitor.php';

// get monitor class
$MongoMonitor = new MongoMonitor();
// stop the db profiling and clean up old profiler data
$MongoMonitor->cleanOldProfilingData();
