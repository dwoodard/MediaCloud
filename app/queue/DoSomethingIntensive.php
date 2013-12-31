<?php

class DoSomethingIntensive
{

	function fire($job, $data)
	{
		File::append(app_path() . '/queue.txt', md5(microtime()) . '----' . $data['asset_id'] . PHP_EOL);

		$job->delete();
	}
}

 ?>