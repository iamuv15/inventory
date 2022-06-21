<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use Excel;

class PurchaseExcel extends Controller
{
  public function downloadExcel($filename, $type)
	{
		$data = Purchase::get()->toArray();
		return Excel::create($filename, function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
}
