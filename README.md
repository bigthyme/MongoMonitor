# MongoMonitor

A simple tool that helps unconver half-convered/slow mongo queries during development.

This text you see here is *actually* written in Markdown! To get a feel for Markdown's syntax, type some text into the left window and watch the results in the right.

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