<?php

include_once '../src/MongoMonitor.php';

// get monitor class
$MongoMonitor = new MongoMonitor();
// scan the profiling results
$MongoMonitor->scanSystemProfile();
