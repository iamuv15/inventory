<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ $items->Quotation_Number }} | Quotation</title>
    <style>

      *{
        box-sizing: border-box !important;
      }

      .container{
        width: 100%;
      }

      .b {
        font-weight: 600;
      }

      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }
    td{
    	    vertical-align: baseline;
    	    line-height: 100%;
    	    padding:5px; 
            border-width:0px; 
            margin:0px;
    	}
    	
    	table p{
    	    margin: 0px !important;
    	}
      .top td, .top th {
        border: 1px solid #000;
        text-align: left;
        padding: 8px;
      }

      .bottom td, .bottom th {
        text-align: left;
        padding: 8px;
      }

      .bottom td{
        border: 0;
        border-right: 1px solid black;
        border-left: 1px solid black;
      }

      .border{
        border: 1px solid black !important;
        border-bottom: 0 !important;
      }

      .bottom th{
        border: 1px solid black !important;
      }

       .borderless{
        border-left: 0 !important;
        border-right: 0 !important;
      }

      .borderless:last-child{
        border-right: 1px solid black !important;
      }

      .borderless:first-child{
        border-left: 1px solid black !important;
      }

      .footer{
        width: 100%;
        border-top: 1px solid black;
      }

			.center > center > span{
				border: 1px solid black;
			}

			.logo{
				height: 50px;
				width: 200px;
			}

    </style>
  </head>
  <body>
    <div class="container">
      <center>
        <h3>
          <u>QUOTATION</u>
        </h3>
      </center>
			<div>
				<img class="logo" src="{{ asset('images/logo.png') }}" alt="">
			</div>
      <table class="top">
        <tbody>
          <tr>
            <td style="border-right: 0 !important;">
              <span class="b">Importer/Exporter code No: AAEFM4473D</span>
            </td>
            <td style="border-left: 0 !important;">
              <span class="b">GST Number: 19AAEFM4473D1ZA</span>
            </td>
          </tr>
				</tbody>
			</table><br>
			<table class="top">
				<tbody>
          <tr>
						<tr>
					    <th style="font-weight: 400;" rowspan="3">To, <br>{{ $items->To }}</th>
					    <td>Quotation Number: {{ $items->Quotation_Number }}</td>
					  </tr>
					  <tr>
					    <td>Quote Date: {{ $items->Quotation_Date }}</td>
					  </tr>
						<tr>
					    <td>Quote valid for: 30 Days</td>
					  </tr>
          </tr>
        </tbody>
      </table>
      <br>
			<table class="top">
        <tbody>
          <tr>
            <td>
              <span class="b">Ref No:
                @if($items->Quotation_Number < 10)
                  <td>MED-00{{ $items->Quotation_Number }}</td>
                @elseif($items->Quotation_Number >= 10 && $item->Quotation_Number < 100)
                  <td>MED-0{{ $items->Quotation_Number }}</td>
                @else
                  <td>MED-{{ $items->Quotation_Number }}</td>
                @endif
              </span>
            </td>
            <td>
              <span class="b">Payment Terms: 100% Advance Payment Required for
Inspection Charge</span>
            </td>
          </tr>
				</tbody>
			</table><br>
      <table class="bottom">
        <thead>
          <tr>
            <th>SI no.</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit rate in INR</th>
            <th>Price in INR</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td class="b">{{ $items->Quotation_Number }}</td>
            <td class="b">{{ $items->Description }}</td>
            <td class="b">{{ $items->Quantity }}</td>
            <td>{{ $items->Unit_Rate }}</td>
            <td>{{ $items->Unit_Rate * $items->Quantity }}</td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td class="border"></td>
            <td class="border">Sub total</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">{{ $items->Unit_Rate * $items->Quantity }}</td>
          </tr>

          <tr>
            <td class="border"></td>
            <td class="border">GST @ {{ $items->tax }}%</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">{{ ($items->Unit_Rate * $items->Quantity) * ($items->tax/100) }}</td>
          </tr>

          <tr>
            <td class="border"></td>
            <td class="border">Total price</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">{{ ($items->Unit_Rate * $items->Quantity) + (($items->Unit_Rate * $items->Quantity) * ($items->tax/100)) }}</td>
          </tr>
        </tbody>
      </table>
      <div class="footer">

        <br><br><br>
        <span style="float: right">For Medical Equipment & Devices</span>
      </div><br>
			<div class="center">
				<center><span style="font-size: 12px">For any further clarification please feel free to call / fax at +91 353 2532344 or e mail at: slg_saktimoy@sancharnet.in</span><br>
				<span style="font-size: 12px">SALES OFFICE: 'SURAMA JYOTI', FLAT NO SA8, 22 SARAT BOSE ROAD, SILIGURI 734 001, INDIA</span></center>
			</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script media="screen">
    $(document).ready(function(){
    	window.print();
    });
    </script>
  </body>
</html>
