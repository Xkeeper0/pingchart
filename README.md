ping chart
=====================

![a sample image](graph.png?raw=true)

this is a command-line tool to generate png charts of the ping times to a given host.

it runs in perpetuity and updates the graph every second for vaguely real-time monitoring.

it requires [fping](https://fping.org/) to be installed.



usage
-----

`php ping.php <ip address> [filename]`. graphs will be generated under
`pings/filename-2019-12-31.png`. if `filename` isn't specified, it defaults to
the ip address.

you can also run it with `./start.sh <ip address> [filename]`, which will
use `nohup` to fork it off into the background so you can do something else.


note
----
please only ping things you should, though at a rate of one per second it's
not like you're going to ruin anything. probably.

`pings/index.php` is a page that will list some of the charts (if available).
it's not particularly good since i made it in a rush, but if you zoom in
it has css to make the images not turn into mud. small favors.


contributing
------------

sure
