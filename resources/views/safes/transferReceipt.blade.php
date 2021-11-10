
<html>
    <head>
        <title>
            عملية تحويل رقم #{{$transferId->id}}
        </title>
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
    <td align = 'center'><b>رقم العملية</b></td>
    <td align = 'center'>{{$transferId->id}}</td>
    </tr>
    <tr>
    <td align = 'center'><b>من خزنة</b></td>
    <td align = 'center'>{{$transferId->safeFrom->safe_name}}</td>
    </tr>
    <tr>
    <tr>
    <td align = 'center'><b>الى خزنة</b></td>
    <td align = 'center'>{{$transferId->safeTo->safe_name}}</td>
    </tr>
    <tr>
    <td align = 'center'><b>وقت العملية</b></td>
    <td align = 'center'>{{$transferId->transfer_datetime}}</td>
    </tr>
    <tr>
    <td align = 'center'><b>التفاصيل</b></td>
    <td align = 'center'>{{$transferId->transfer_notes}}</td>
    </tr>
    <tr>
    <td align = 'center'><b>المبلغ</b></td>
    <td align = 'center'>{{$transferId->transfer_amount}} ج.م</td>
    </tr>
     <tr>
    <td align = 'center'><b>قام بالعملية</b></td>
    <td align = 'center'>{{$transferId->transferUser->username}}</td>
    </tr>
    <tr>
    <td align = 'center'><b>صرح بالعملية</b></td>
    @if ($transferId->authUser)
    <td align = 'center'>{{$transferId->authUser->username}}</td>
    @else
    <td align = 'center'><small class="danger">لم يتم التصديق عليها بعد</small></td>
    @endif
    </tr>
    </table>

     <p style="font-size: 10px;">تاريخ الطباعة: {{Carbon\Carbon::now()}}</p>

    </body>
    </html>
