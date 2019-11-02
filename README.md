php-advent-of-code
============

PHP solutions to **Advent of Code**: http://adventofcode.com/ tasks.  

Introduction
============
All tasks are **Advent of Code** ownership. This repository represents my solutions to **Advent of Code** algorithmic tasks.

Directory structure example
============
<pre>
src/[YEAR]/Day [DAY] - Task name  # Folder for certain day
    Part1.php           # Part1 solution
    Part2.php           # Part2 solution
</pre>

Contribution
============
Feel free to fork this repository and solve something in better, i.e. more optimal way.

**php-advent-of-code** is dockerized for everyone who prefers to debug in the browser instead of in the console.

If you have docker installed:

1. Pull php-advent-of-code project
2. Open console and change directory to project root
3. Run the following command:
```sh
docker-compose up -d
```
4. Now you can open any task in your favorite browser, e.g.
```
http://localhost/src/2017/Day%201%20-%20Inverse%20Captcha/Part1.php
```
5. If you need to enter a running container:
```sh
docker exec -it php-advent-of-code_app_1 /bin/bash
```

Copyright and License
============

Copyright (c) 2018 - 2019 Pave Aljinović  
Licensed under the [MIT License](https://github.com/paljinov/php-advent-of-code/blob/master/LICENSE.md)
