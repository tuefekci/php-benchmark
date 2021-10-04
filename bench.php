<?php

	use \parallel\{Runtime, Future, Channel, Events};
	require_once(__DIR__."/benchmark.php");

	// ========================================================================
	// Benchmark Settings
	$count = 1000000;
	$workers = 16; // only used in parallel (i used cpu threads * 2)
	// ========================================================================

	$bench = new Bench();
	$total = 0;
	$benchmarks = get_class_methods($bench);
	unset($benchmarks[0]);
	$line = str_pad("-",38,"-");

	echo $line.PHP_EOL;
	echo str_pad("PHP BENCHMARK SCRIPT",36," ",STR_PAD_BOTH).PHP_EOL;
	echo $line.PHP_EOL;
	echo "Start : ".date("Y-m-d H:i:s").PHP_EOL;
	echo "PHP Version : ".PHP_VERSION.PHP_EOL;
	echo "OS Platform : ".PHP_OS.PHP_EOL;
	echo $line.PHP_EOL;

	if(!extension_loaded("parallel")) {

		foreach ($benchmarks as $benchmark) {
			$time_start = microtime(true);

			for ($i=0; $i < $count; $i++) {
				$bench->$benchmark($i);
			}

			$result = number_format(microtime(true) - $time_start, 3);
			$total += $result;
            echo str_pad($benchmark, 25) . " : " . $result ." sec.".PHP_EOL;
		}


	}elseif(extension_loaded("parallel")) {

		$batchSize = round($count / $workers);

		foreach ($benchmarks as $benchmark) {

			$time_start = microtime(true);

			$producer = function(int $worker, int $startId, int $endId, string $benchmark) {
				require_once(__DIR__."/benchmark.php");
				$bench = new Bench();

				for ($i=$startId; $i < $endId; $i++) {
					$bench->$benchmark($i);
				}
			};

			// Create our workers and have them start working on their task
			for($i = 0; $i < $workers; $i++) {

				$startId = 0 + ($i * $batchSize);
				$endId = $startId + $batchSize;

				if($i == ($workers - 1)) {
					$endId = $count;
				}

				\parallel\run($producer, array(($i+1), $startId, $endId, $benchmark));

			}

			$result = number_format(microtime(true) - $time_start, 3);
			$total += $result;
			echo str_pad($benchmark, 25) . " : " . $result ." sec.".PHP_EOL;

		}

	}

	echo str_pad("-", 38, "-") . "\n" . str_pad("Total time:", 25) . " : " . $total ." sec.";
	


?>