# MongoMonitor

A simple tool that helps uncover half-covered/slow mongo queries during local development.

### Installation

```sh
$ git clone git@github.com:bigthyme/MongoMonitor.git
```

### Usage

```sh
$ cd MongoManager
# from root start profiling
$ ./mongo-monitor start
# from stop profiling at your own leisure or keep it running!
$ ./mongo-monitor stop
# collect the slow query findings
$ ./mongo-monitor get
# see the monstrosity
$ cat results/slow_queries_1432169717634.json
```

License
----

MIT
