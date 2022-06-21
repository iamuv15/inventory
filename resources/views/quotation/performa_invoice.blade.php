<?php
//   $item = DB::table('inventory')->where('item_code', '=', $items->item_code)->first();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/split.js') }}"></script>
    <meta charset="utf-8">
    <title>Performa Invoice</title>
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
        width: 100% !important;
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
        border: 1px solid black;
      }

      pre {
        font-size: inherit;
        color: inherit;
        border: initial;
        padding: initial;
        /*margin: 0px;*/
        font-family: inherit;
    }

    .half{
        width: 50% !important;
    }

    .descr{
    	    width: 450px !important;
    	    max-width: 450px !important;
    	    word-wrap:break-word !important;
    	    /*page-break-before: always;*/
         /*   page-break-inside: avoid;*/
    	}

    	table p{
    	    margin: 0px !important;
    	}

    	.page-break { page-break-after: always; }

    	.logo{
    	    height: 80px;
    	    width: 200px;
    	}

    	@media print
        {
            thead {
                display: table-header-group;
                margin-top: 100px;
            }
        }

    </style>
  </head>
  <body>
    <div class="container">
        <table>
        <thead><div>
				<img class="logo" src="{{ asset('images/logo.png') }}" alt="">
			</div></thead>
			</table>
			<hr>
      <center>
        <h3>
          <u>Performa Invoice</u>
        </h3>
      </center>
      <table class="top">
        <tbody>
          <tr>
            <td class="half">
              <span class="b">Proforma Invoice: @foreach($items as $item) {{ $item->performa_invoice }} @break @endforeach</span><br>
              <span class="b">Dated: @foreach($items as $item) {{ date('d-m-Y', strtotime($item->dated)) }} @break @endforeach</span>
            </td>
            <td class="half">
              <span class="b">I/E Code No: AAEFM4473D</span><br>
              <span class="b">GST No: 19AAEFM4473D1ZA</span>
            </td>
          </tr>

          <tr>
            <td class="half">
              <span class="b">Indenter:<br>
                @foreach($items as $item) {!! nl2br(e($item->indenter)) !!} @break @endforeach
              </span>
            </td>
            <td class="half">
              <span class="b">Consignee :<br>
                @foreach($items as $item) {!! nl2br(e($item->consignee)) !!} @break @endforeach
              </span>
            </td>
          </tr>

          <tr>
            <td class="half">
              <span class="b">Billing Details<br></span>
              <span>Reference ID: <span class="b">@foreach($items as $item) {{ $item->reference_number }} @break @endforeach</span><br></span>
              <span>Reference Date Date: <span class="b">@foreach($items as $item) {{ $item->reference_date }} @break @endforeach</span><br></span>
              <span>Bills To: @foreach($items as $item) {{ $item->bills_to }} @break @endforeach<br></span>
              <span>Bill In Name: @foreach($items as $item) {{ $item->bill_in_name }} @break @endforeach<br></span>
              <span>Payment Terms: @foreach($items as $item) {{ $item->payment_terms }} @break @endforeach<br></span>
            </td>
            <td class="half">
              <span class="b">Dispatch Details <br></span>
              <span>Delivery To: @foreach($items as $item) {{ $item->delivery_to }} @break @endforeach<br></span>
              <span>Delivery Period: @foreach($items as $item) {{ $item->delivery_period }} @break @endforeach<br></span>
              <span>Road Permit: @foreach($items as $item) {{ $item->road_permit }} @break @endforeach<br></span>
              <span>Freight Charges: @foreach($items as $item) {{ $item->freight_charges }} @break @endforeach<br></span>
              <span>Mode of Transport: @foreach($items as $item) {{ $item->mode_of_transport }} @break @endforeach<br></span>
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <table class="bottom">
        <thead>
          <tr>
            <th><center>SI no.</center></th>
            <th><center>Description</center></th>
            <th><center>Qty</center></th>
            <th><center>Rate (INR)</center></th>
            <th><center>Amount (INR)</center></th>
          </tr>
        </thead>
        <tbody>

          @foreach($items as $item)
               <tr>
              <td class="b">{{ $item->Serial_Number }}</td>
              <td class="descr">{!! ($item->description) !!}</td>
              <td class="b">{{ $item->quantity }}</td>
              <td>{{ $item->unit_rate }}</td>
              <td>{{ $item->quantity * ($item->unit_rate + ($item->unit_rate * $item->tax/100)) }}</td>
               </tr>
          @endforeach

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
            <td class="border">Total Nu./Rs.: @foreach($count as $c) {{ $c }} @endforeach</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">
                <?php $total = 0; ?>
              @foreach($items as $item)
                <?php $total = $total + ($item->quantity * ($item->unit_rate + ($item->unit_rate * ($item->tax/100)))) ?>
              @endforeach
              {{ $total }}
            </td>
          </tr>
        </tbody>
      </table>
      <div class="footer">
        For Medical Equipment & Devices
        <br>
        <br>
        <br>
        Authorized Signatory
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
