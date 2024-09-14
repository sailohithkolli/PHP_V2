<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Cache;

class TestComputeJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $tries = 1;
	public $timeout = 120;

	protected $input;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($input)
	{
		$this->input = $input;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{	
		$result = self::bcln($this->input);
		Cache::put('result', $result);
	}

	/* 
	 * Computes ln(x).
	 */ 
	public static function bcln($n, $scale=10) 
	{
		$iscale = $scale+3;
		$result = '0.0';
		$i = 0;

		do {
			$pow = (1 + (2 * $i++));
			$mul = bcdiv('1', $pow, $iscale);
			$fraction = bcmul($mul, bcpow(bcsub($n, '1', $iscale) / bcadd($n, '1.0', $iscale), $pow, $iscale), $iscale);
			$lastResult = $result;
			$result = bcadd($fraction, $result, $iscale);
		} while($result !== $lastResult);

		return bcmul('2', $result, $scale);
	}

}
