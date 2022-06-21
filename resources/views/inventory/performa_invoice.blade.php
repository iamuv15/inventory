<?php
  $item = DB::table('inventory')->where('item_code', '=', $items->item_code)->first();
  
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Proforma Invoice</title>
    <style>

      *{
        box-sizing: border-box !important;
      }

      .container{
        width: 100%;
      }

    /*  .b {
        font-weight: 600;
      } */

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
          <u>Proforma Invoice</u>
        </h3>
      </center>
      <table class="top">
        <tbody>
          <tr>
            <td>
              <span class="b">Proforma Invoice: </span><br>
              <span class="b">Dated: {{ date('d-m-Y', strtotime($items->date_sale)) }}</span>
            </td>
            <td>
              <span class="b">I/E Code No: AAEFM4473D</span><br>
              <span class="b">GST No: 19AAEFM4473D1ZA</span>
            </td>
          </tr>

          <tr>
            <td>
              <span class="b">Indenter:<br>
                To,<br><br><br><br><br><br><br><br><br>

              </span>
            </td>
            <td>
              <span class="b">Consignee :<br>
                To,<br><br><br><br><br><br><br><br><br>

              </span>
            </td>
          </tr>

          <tr>
            <td>
              <span class="b">Billing Details<br></span>
              <span>PO Number:<span class="b"></span><br></span>
              <span>PO Date:<span class="b"></span><br></span>
              <span>Bills To: Consignee<br></span>
              <span>Bill In Name: Consignee<br></span>
              <span>Payment Terms: 20% Advance through bank and Balance before delivery.<br></span>
            </td>
            <td>
              <span class="b">Dispatch Details <br></span>
              <span>Delivery To: Consignee<br></span>
              <span>Delivery Period: 60 Days<br></span>
              <span>Road Permit: N/A<br></span>
              <span>Freight Charges: Paid-Door Delivery<br></span>
              <span>Mode of Transport: Road<br></span>
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <table class="bottom">
        <thead>
          <tr>
            <th>SI no.</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Rate (INR)</th>
            <th>Amount (INR)</th>
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

          <tr>
            <td class="b">{{ $items->id }}</td>
            <td class="b"></td>
            <td class="b">{{ $items->quantity }}</td>
            <td>{{ $items->price }}</td>
            <td>{{ $items->quantity * ($items->price + ($items->price * $items->tax/100)) }}</td>
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
            <td class="border">Total Nu./Rs.:   </td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">{{ $items->quantity * ($items->price + ($items->price * $items->tax/100)) }}</td>
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
