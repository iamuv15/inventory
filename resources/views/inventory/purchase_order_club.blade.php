<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@foreach($items as $item) {{ $item->company }} @break @endforeach | Purchase Order</title>
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
            <td>
              <span class="b">I/E code: </span>
            </td>
            <td>
              <span class="b">GST Number: </span>
            </td>
          </tr>
          <tr>
            <td>
              <span class="b">Purchase order number: </span>
            </td>
            <td>
              <span class="b">Date: @foreach($items as $item) {{ date('d-m-Y', strtotime($item->date_purchase)) }} @break @endforeach</span>
            </td>
          </tr>

          <tr>
            <td>
              <span><br>
                <br><br><br><br><br><br><br><br>
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
            <td>
              <center>
                <u>
                  <b>Department of Pediatric</b>
                </u>
              </center>
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          @foreach($items as $item)
            <tr>
              <td class="b">1</td>
              <td class="b">{{ $item->item_name }}</td>
              <td class="b">{{ $item->quantity }}</td>
              <td>{{ $item->price }}</td>
              <td>{{ $item->price * $item->quantity }}</td>
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
            <td class="border">Sub total</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">
              <?php $total = 0; ?>
              @foreach($items as $item)
                <?php $total = $total + ($item->price * $item->quantity) ?>
              @endforeach
              {{ $total }}
            </td>
          </tr>

          <tr>
            <td class="border"></td>
            <td class="border">GST @ 12%</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">
              <?php $gst = 0; ?>
              @foreach($items as $item)
                <?php $gst = $gst + (($item->price * $item->quantity) * 0.12); ?>
              @endforeach
              {{ $gst }}
            </td>
          </tr>

          <tr>
            <td class="border"></td>
            <td class="border">Total price</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">{{ $total + $gst }}</td>
          </tr>
        </tbody>
      </table>
      <div class="footer">
        Please supply the following goods immediately at the following address-<br>
        Medical Equipment & Devices, "Surama Abason", Flat-SA-8, 22, Surat Bose Road, Hakimpura, Sillguri-734001 WB, India.<br>
        <b>Terms & Conditions</b><br>
        <b>Please arrange to deliver the metarials within 7 days</b><br>
        <b>Enclosed 100% Advance through Cheque No.        Dt. @foreach($items as $item) {{ date('d-m-Y', strtotime($item->date_purchase)) }} @break @endforeach Rs. {{ $total + $gst }} on </b><br>
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
