# php-benchmark
Benchmarking PHP7, PHP8, PHP7-parallel

All Scripts etc. are in this Repo. I probably will update if i need to test anything else, this really does not benchmark for normal server usage more for cli use.

If you have some tips, tricks etc. just open an issue or push some more benchmarks etc.


## Hardware
i7-4790k
16GB DDR3

I did not optimize anything for benchmarking because my usecase would be a normal running system with other tasks running etc.

The php.ini are also in the repo if you want to check, i did not setup anything really just using out of the box inis.

Have a look at bench.php and benchmark.php to see the test cases.

## Results 2021-10-04
```
// Benchmark Settings
$count = 1000000;
$workers = 16;
```
---
```
PHP Version : 7.4.24
OS Platform : WINNT
--------------------------------------
test_Math                 : 1.383 sec.
test_StringManipulation   : 15.978 sec.
test_Loops                : 62.162 sec.
test_IfElse               : 0.089 sec.
--------------------------------------
Total time:               : 79.612 sec.
```
---
```
PHP Version : 7.4.24-parallel
OS Platform : WINNT
--------------------------------------
test_Math                 : 0.359 sec.
test_StringManipulation   : 2.746 sec.
test_Loops                : 2.422 sec.
test_IfElse               : 3.834 sec.
--------------------------------------
Total time:               : 9.361 sec.
```
---
```
PHP Version : 8.0.11
OS Platform : WINNT
--------------------------------------
test_Math                 : 1.430 sec.
test_StringManipulation   : 2.985 sec.
test_Loops                : 64.556 sec.
test_IfElse               : 0.082 sec.
--------------------------------------
Total time:               : 69.053 sec.
```
## Conclusion
PHP8 performs better than PHP7 especially in string manipulation and probably the same in the loop test so overall its performance is still getting better, but the results are also a bit unclear to be truthfully because it is confusing that PHP7 handles the loops test better... (i retested this more than once and it is stable that php8 is always a bit slower with the loops test than php7 but it probably makes no real life difference) 

Also for paralel in the ifelse test the overhead of setting up the process and the benchmark class makes the result clearly worse but im not completly sure why this is only true for the test_IfElse nad not test_Math probably the test is wrong, but to be truthfull
the testcase is not really helpfull anyway.

So for my usecase parallel is the winner it needs more setup but it basicly was the reason i did this testing in the first please to assert if the work would be worth it i will setup some real use benchmarking in the future for my project and then release my findings here as well. I will try reactphp + parallel on php7 which should bring some good results for my usecase where i need to transform a lot of data points in a short amount of time there the extra amount of work to implement everything so it runs nicely with parallel should be worth it,

## Todo
- Add Statistic and Iterations to get median results
- Add Graphics
- Add more benchmarks

## Thanks to
Alessandro Torrisi for his http://www.php-benchmark-script.com which gave me the basic setup what to test and a base for my own benchmark

David Müller for his https://d-mueller.de/blog/parallel-processing-in-php/ which gave me the idea to setup my own benchmark and stop finding one on google (which i could not in the first place)
