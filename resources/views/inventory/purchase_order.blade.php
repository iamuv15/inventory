<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ $items->item_name }} | Purchase Order</title>
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
        border: 1px solid black;
      }
      
      .half{
          width: 50%;
      }
      
      .descr{
    	    word-wrap:break-word;
    	}

    </style>
  </head>
  <body>
    <div class="container">
      <center>
        <h3>
          <u>Purchase Order</u>
        </h3>
      </center>
      <table class="top">
        <tbody>
          <tr>
            <td class="half">
              <span class="b">I/E code: AAEFM4473D</span>
            </td>
            <td class="half">
              <span class="b">GST Number: 19AAEFM4473D1ZA</span>
            </td>
          </tr>
          <tr>
            <td class="half">
              <span class="b">Purchase order number: <span style="font-size: 14px;">{{ $items->purchase_order_number }}</span></span>
            </td>
            <td class="half">
              <span class="b">Date: {{ date('d-m-Y', strtotime($items->date_purchase)) }}</span>
            </td>
          </tr>

          <tr>
            <td class="half">
              <span class="descr"><br>
                {!! $items->company !!}
              </span>
            </td>
            <td>

            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <h3>Sub: Order for Equipment</h3>
      <table class="bottom">
        <thead>
          <tr>
            <th>SI no.</th>
            <th>Description</th>
            <th>Qty</th>
            <th>unit price (Rs.)</th>
            <th>Total price (Rs.)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td class="b">1</td>
            <td class="b">{{ $items->item_name }}</td>
            <td class="b">{{ $items->quantity }}</td>
            <td>{{ $items->price }}</td>
            <td>{{ $items->quantity * $items->price }}</td>
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
            <td class="border">GST @ {{$items->tax}}%</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">{{ $items->quantity * ($items->price + ($items->price * ($items->tax/100))) }}</td>
          </tr>

          <tr>
            <td class="border"></td>
            <td class="border">Total price</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">{{ $items->quantity * ($items->price + ($items->price * ($items->tax/100))) }}</td>
          </tr>
        </tbody>
      </table>
      <div class="footer">
        Please supply the following goods immediately at the following address-<br>
        Medical Equipment & Devices, "Surama Abason", Flat-SA-8, 22, Surat Bose Road, Hakimpura, Sillguri-734001 WB, India.<br>
        <b>Terms & Conditions</b><br>
        <b>Please arrange to deliver the metarials within 7 days</b><br>
        <b>Enclosed 100% Advance through Cheque No.        Dt. {{ date('d-m-Y', strtotime($items->date_purchase)) }} Rs. {{ ($items->price * $items->quantity) + (($items->price * $items->quantity) * 0.12) }} on </b><br>
        Thanking you
        <br><br><br><br><br><br>
        For Medical Equipment and Devices
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
