<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use Excel;

class SaleExcel extends Controller
{
  public function downloadExcel($filename, $type)
	{
		$data = Sale::get()->toArray();
		return Excel::create($filename, function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
}
