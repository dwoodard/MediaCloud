<?php

class DoSomethingIntensive
{

	function fire($job, $data)
	{
		File::append(storage_path() . '/queue.txt', microtime() . '----' . $data['asset_id'] . PHP_EOL);

		$job->delete();
	}
}

 ?>