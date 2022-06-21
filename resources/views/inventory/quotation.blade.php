<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ $items->item_name }} | Quotation</title>
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
					    <th style="font-weight: 400;" rowspan="3">To, <br>New Ramkrishna IVF Centre
Pakurtala More, Hakimpara
Siliguri-734001</th>
					    <td>Quotation Number: MED/006/2018-2019</td>
					  </tr>
					  <tr>
					    <td>Quote Date: 18-05-2018</td>
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
              <span class="b">Ref No: </span>
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
            <td class="b">1</td>
            <td class="b">{{ $items->item_name }}</td>
            <td class="b">{{ $items->quantity }}</td>
            <td>{{ $items->price }}</td>
            <td>{{ $items->price * $items->quantity }}</td>
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
            <td class="border b">{{ $items->price * $items->quantity }}</td>
          </tr>

          <tr>
            <td class="border"></td>
            <td class="border">GST @ 12%</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">{{ ($items->price * $items->quantity) * 0.12 }}</td>
          </tr>

          <tr>
            <td class="border"></td>
            <td class="border">Total price</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">{{ ($items->price * $items->quantity) + (($items->price * $items->quantity) * 0.12) }}</td>
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
