<?php

use \MongoClient;

/**
 * Helper class used for profiling queries that scan
 * more documents than they return
 *
 * @package test
 * @subpackage helpers
 */
class MongoMonitor
{
    /**
     * db connection
     * @var object
     */
    protected $db;

    /**
     * system profile collection
     * @var object
     */
    protected $collection;

    /**
     * Path to write slow queries to
     * @var string
     */
    protected $filePath;

    /**
     * system profile collection name
     * @var string
     */
    const SYSTEM = 'system.profile';

    /**
     * test databsae name
     * @var string
     */
    const DB = 'test';

    /**
     * Initilize the db, collection, and filepath variables
     */
    private function init()
    {
        $conn = new MongoClient();

        $this->db = $conn->selectDB(self::DB);

        $this->collection = $this->db->selectCollection(self::SYSTEM);
        $this->filePath = 'results/slow_queries_' . time() . '.json';

        error_log("Connected to mongo " . self::DB . ":" . self::SYSTEM);
    }

    /**
     * Set the mongo profiling level to 2
     */
    public function setLogLevel()
    {
        $this->init();
        // set db to active profiling
        $this->db->setProfilingLevel(2);
        error_log("Database profiling is now set to `2`");
    }

    /**
     * Walk the system collection and find all queries where nscanned < nreturned
     * then write out all slow queries to a file
     */
    public function scanSystemProfile()
    {
        $this->init();
        $results = [];
        // return slowest queries first
        $cursor = $this->collection->find([])->sort(['millis' => 1]);
        $counter = 0;

        while ($cursor->hasNext()) {
            ++$counter;
            $record = $cursor->getNext();

            $docsReturned = isset($record['ntoreturn']) ? $record['ntoreturn'] : 0;
            $docsScanned = isset($record['nscanned'])  ? $record['nscanned'] : 0;
            $millis = isset($record['millis']) ? $record['millis'] : 0;

            /*
             * if there were more items scanned than returned, we may have an issue...
             * only track queries that have exceeded 0 ms
             * http://docs.mongodb.org/manual/reference/database-profiler/
            */
            if ($docsReturned < $docsScanned & $millis) {
                $results[] = [
                    'query' => $record['query'],
                    'duration' => $millis . 'ms',
                    'collection' => $record['ns']
                ];
            }

            if ($counter % 2 === 0) {
                error_log("${counter} number of queries scanned");
                sleep(1);
            }
        }

        // write results to file if there are results otherwise output a happy message
        if (count($results)) {
            file_put_contents($this->filePath, json_encode($results, JSON_PRETTY_PRINT));
            echo 'There are slow ' .  count($results) . ' queries to check on in ' . $this->filePath . PHP_EOL;
        } else {
            echo 'All clear, merry coding! ' . PHP_EOL;
        }
    }

    /**
     * Set the mongo profile leveling to 0 and clear out all profiling data
     */
    public function cleanOldProfilingData()
    {
        $this->init();
        // reset the profile level
        $this->db->setProfilingLevel(0);
        // clear the system.profile capped collection
        $this->collection->drop();
        error_log("Cleared historic data in " . self::DB . ":" . self::SYSTEM);
    }
}
