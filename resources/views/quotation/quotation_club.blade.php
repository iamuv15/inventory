<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Quotation</title>
    <style>

      *{
        box-sizing: border-box /*!important; */
      }

      .container{
        width: 100%;
      }

     /* .b {
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
        /*padding: 2px;*/
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
      
      pre {
        font-size: inherit;
        color: inherit;
        border: initial;
        padding: initial;
        font-family: inherit;
    }

    	.center > center > span{
    		border: 1px solid black;
    	}
    
    	.logo{
    		height: 50px;
    		width: 200px;
    	}
    	
    	.half{
    	    width: 50%;
    	}
    	
    	.descr{
    	    width: 400px;
    	    max-width: 400px !important;
    	    word-wrap:break-word;
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
    	
    	@media print {
          .header {
            position: fixed;
            bottom: 0;
          }
        
          /*.content-block, p {*/
          /*  page-break-inside: avoid;*/
          /*}*/
        
          /*html, body {*/
          /*  width: 210mm;*/
          /*  height: 297mm;*/
          /*}*/
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
            <thead class"header">
                <td style="border-right: 0 !important;">
                  <span class="b">Importer/Exporter code No: AAEFM4473D</span>
                </td>
                <td style="border-left: 0 !important;">
                  <span class="b">GST Number: 19AAEFM4473D1ZA</span>
                </td>
            </thead>
          </tr>
				</tbody>
			</table><br>
			<table class="top">
				<tbody>
          <tr>
    		  <tr>
    		    <th class="half" style="font-weight: 400;" rowspan="3">To, <br> @foreach($items as $item){!! nl2br(e($item->To)) !!}@break @endforeach </th>
    		    <td>Quotation Number: @foreach($items as $item){{ $item->Quotation_Number }}@break @endforeach</td>
    		  </tr>
    		  <tr>
    		    <td>Quote Date: @foreach($items as $item){{ $item->Quotation_Date }}@break @endforeach</td>
    		  </tr>
    			<tr>
    		    <td>Quote valid for: @foreach($items as $item){{ $item->Quote_valid_for }}@break @endforeach</td>
    		  </tr>
          </tr>
        </tbody>
      </table>
      <br>
			<table class="top">
        <tbody>
          <tr>
            <td class=half>
              <span class="b">Ref No: @foreach($items as $item){{ $item->Ref_no }}@break @endforeach</span>
            </td>
            <td class="half">
              <span class="b">Payment Terms: @foreach($items as $item){{ $item->Payment_terms }}@break @endforeach</span>
            </td>
          </tr>
				</tbody>
			</table><br>
      <table class="bottom">
        <thead>
          <tr>
            <th><center>SI no.</center></th>
            <th><center>Description</center></th>
            <th><center>Qty</center></th>
            <th><center>Unit rate in INR</center></th>
            <th><center>Tax</center></th>
            <th><center>Total Price in INR</center></th>
          </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
          <tr>
            <td class="b">{{ $item->Serial_Number }}</td>
            <td class="descr">{!! $item->Description !!}</td>
            <td class="b">{{ $item->Quantity }}</td>
            <td>{{ $item->Unit_Rate }}</td>
            <td>{{ $item->tax }}%</td>
            <td>{{ $item->Quantity * ($item->Unit_Rate + ($item->Unit_Rate * ($item->tax/100))) }}</td>
          </tr>
        @endforeach
          <tr>
            <td></td>
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
            <td></td>
          </tr>

          <tr>
            <td></td>
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
            <td></td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          
          

          <tr>
            <td class="border"></td>
            <td class="border">Total price</td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border"></td>
            <td class="border b">
                <?php $total = 0; ?>
              @foreach($items as $item)
                <?php $total = $total + ($item->Quantity * ($item->Unit_Rate + ($item->Unit_Rate * ($item->tax/100)))) ?>
              @endforeach
              {{ $total }}
              </td>
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
