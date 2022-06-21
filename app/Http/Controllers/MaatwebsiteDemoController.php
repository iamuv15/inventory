<?php

namespace App\Http\Controllers;
use App\DSR;
use Excel;

use Illuminate\Http\Request;

class MaatwebsiteDemoController extends Controller
{
  public function downloadExcel($filename, $type)
	{
		$data = DSR::get()->toArray();
		return Excel::create($filename, function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
}
