
<html>
    <head>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
     @font-face {
        font-family: 'Cairo', sans-serif;
    }
    body {
        font-family: 'Cairo', sans-serif;
        font-style: normal;

      }
      *{
          direction:rtl;
          font-size: 15px;
          font-weight: bold;

      }
        @page
            {
                size: auto;   /* auto is the current printer page size */
                margin: 0mm;  /* this affects the margin in the printer settings */
            }
            table {
        border-collapse: collapse;
    }

    .t1 table, th, td {
        border: 1px dashed black;
    }

    th {
        height: 50px;
    }
      </style>

    </head>
     <body onload="window.print()">
         <center>
    <img src="{{asset('theme/app-assets/images/custom/logo-placeholder.png')}}" style="width:150px" height="150px"/></br>
    </center>
     <table border="1" width="95%">
    <tr>
    <td align = 'center'><b>رقم الإيصال</b></td>
    <td align = 'center'>{{$transactionId->id}}</td>
    </tr>
    <tr>
        <td align = 'center'><b>نوع العملية</b></td>
        @if($transactionId->transaction_type == 1)
        <td align = 'center'>سحب</td>
        @else
        <td align = 'center'>ايداع</td>
        @endif
        </tr>
    <tr>
    <td align = 'center'><b>وقت العملية</b></td>
    <td align = 'center'>{{$transactionId->transaction_datetime}}</td>
    </tr>
    <tr>
    <td align = 'center'><b>التفاصيل</b></td>
    <td align = 'center'>{{$transactionId->transaction_notes}}</td>
    </tr>
    <tr>
    <td align = 'center'><b>المبلغ</b></td>
    <td align = 'center'>{{$transactionId->transaction_amount}} ج.م</td>
    </tr>
     <tr>
    <td align = 'center'><b>قام بالعملية</b></td>
    <td align = 'center'>{{$transactionId->done_user->username}}</td>
    </tr>
    <tr>
    <td align = 'center'><b>صرح بالعملية</b></td>
    <td align = 'center'>{{$transactionId->auth_user->username}}</td>
    </tr>
    </table>


     <p style="font-size: 10px;">تاريخ الطباعة: {{Carbon\Carbon::now()}}</p>

    </body>
    </html>
