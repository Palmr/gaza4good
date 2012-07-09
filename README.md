Gaza4Good
=========
This is the project developed at dev4good London July 2012 that aims to solve the problems with resource management/sharing that charity [Hope&Play](http://www.hopeandplay.org/ "") wanted to solve.

This is just the first check in of the **very rough code** we hacked together over the two day event. It definitely needs work before being put on a public facing server, especially if people were to rely on it or expect it to be feature complete. See the ROADMAP file included in this project for where we envisioned the project going if we have more time.

Installation
------------
You probably shouldn't in its current state. But if you really want to you just need PHP/MySQL with most of the usual PHP/Apache config options.
We had an issue with fsockopen to twitter for sign in due to IPv6, but we worked around it by hard coding IPv4 addresses in the code. Other than that, the public html folder contains everything you need web wise, and there is a gaza4good-create.sql script which should create the databse structure.

### Versions used for dev/demo were
- PHP = 5.4.4
- MySQL = 5.5.25
- Apache = 2.2.22
- Linux = Arch 3.4.4-2 (gcc 4.7.1)
- CakePHP = 2.2.0-0-g4b3a8ea
- Twitter Bootstrap = 2.0.4

Authors
-------
- Adam Roberts *@strawsnake*
- Ben Basson *@ben_basson*
- Matt Eason *@matteason*
- Nick Palmer *@palmer*

Thanks to everyone who helped / inspired during the weekend at dev4good (@devfourgood)

