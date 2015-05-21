# MongoMonitor

A simple tool that helps uncover half-convered/slow mongo queries during development.

### Installation

```sh
$ git clone [git@github.com:bigthyme/MongoMonitor.git](MongoManager)
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

### Development

Want to contribute? Great...

License
----

MIT
