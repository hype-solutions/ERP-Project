<html>

<head>
    <title>فاتورة مرتجع بيع سريع #{{ $sessionId }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');

        @font-face {
            font-family: 'Cairo', sans-serif;
        }

        body {
            font-family: 'Cairo', sans-serif;
            font-style: normal;

        }

        * {
            direction: rtl;
            font-size: 15px;
            font-weight: bold;

        }

        @page {
            size: auto;
            /* auto is the current printer page size */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }

        table {
            border-collapse: collapse;
        }

        .t1 table,
        th,
        td {
            border: 1px dashed black;
        }

        th {
            height: 50px;
        }

    </style>

</head>

<body>
    {{-- <body onload="window.print()"> --}}
    <center>
        <img src="{{ asset($logo) }}" style="width:200px" height="80px" /></br>
    </center>
    <table border="1" width="95%">
        <tr>
            <td align='center'><b>رقم الفاتورة</b></td>
            <td align='center'>{{ $sessionId }}</td>
        </tr>
        <tr>
            <td align='center'><b>وقت الفتح</b></td>
            <td align='center'>{{ $currentSession->created_at }}</td>
        </tr>
        <tr>

            <td align='center'><b>وقت البيع</b></td>
            <td align='center'>{{ $currentSession->sold_when }}</td>
        </tr>
        <tr>

            <td align='center'><b>وقت الإرجاع</b></td>
            <td align='center'>{{ $currentSession->refunded_when }}</td>
        </tr>
        <tr>
            <td align='center'><b>قام باللإرجاع</b></td>
            <td align='center'>{{ $currentSession->refund_user->username }}</td>
        </tr>
    </table>


    <h2 style="text-align: center">
        فاتورة مرتجع
    </h2>
    <table border="1" width="95%">
        <tr>
            <th>الوصف</th>
            <th>السعر</th>
            <th>الكمية</th>
            <th>الإجمالي</th>
        </tr>

        <span style="display: none">{{ $subtotal = 0 }}</span>
        @foreach ($refundedCart as $item)
            <tr>
                <td align='center'>{{ $item->product_name }}</b></td>
                <td align='center'>{{ $item->product_price }} ج.م</td>
                <td align='center'>{{ $item->product_qty }}</td>
                <td align='center'>{{ $item->product_price * $item->product_qty }} ج.م</td>
                <span style="display: none">{{ $subtotal += $item->product_price * $item->product_qty }}</span>
            </tr>

        @endforeach

    </table>
    <br />
    <table border="1" width="95%">
        <tr>
            <th>الوصف</th>
            <th>السعر</th>
            <th>الكمية</th>
            <th>الإجمالي</th>
        </tr>

        <span style="display: none">{{ $subtotal2 = 0 }}</span>
        @foreach ($refundedCart as $item)
            <tr>
                <td align='center'>{{ $item->product_name }}</b></td>
                <td align='center'>{{ $item->product_price }} ج.م</td>
                <td align='center'>{{ $item->product_qty }}</td>
                <td align='center'>{{ $item->product_price * $item->product_qty }} ج.م</td>
                <span style="display: none">{{ $subtotal2 += $item->product_price * $item->product_qty }}</span>
            </tr>
        @endforeach

    </table>





    <br />
    <table border="1" width="95%">
        <tr>
            <th>الوصف</th>
            <th>السعر</th>
            <th>الكمية المشتراه</th>
            <th>إجمالي الكمية المشتراه</th>
            <th>الكمية المرتجعه</th>
            <th>إجمالي الكمية المرتجعه</th>
            <th>الفرق</th>
        </tr>

        <tr>
            <span style="display: none">{{ $subtotal = 0 }}</span>
            @foreach ($currentCart as $item)
                <td align='center'>{{ $item->product_name }}</b></td>
                <td align='center'>{{ $item->product_price }} ج.م</td>
                <td align='center'>{{ $item->product_qty }}</td>
                <td align='center'>{{ $item->product_price * $item->product_qty }} ج.م</td>
                <td align='center'>{{ $item->product_qty }}</td>
                <td align='center'>{{ $item->product_price * $item->product_qty }} ج.م</td>
                <td align='center'>0 ج.م</td>
                <span style="display: none">{{ $subtotal += $item->product_price * $item->product_qty }}</span>
        </tr>
        @endforeach

    </table>
    <table border="1" width="95%">

        <tr>
            <td align='center'><b>قبل الخصم</b></td>
            <td align='center'><b>
                    <font color='red'>{{ $subtotal }}</font>
                </b></td>
            <td align='center'><b>جنية</b></td>
        </tr>
        <tr>
            <td align='center'><b>الخصم</b></td>
            <td align='center'><b>
                    <font color='red'>{{ $currentSession->discount_percentage }}</font>
                </b></td>
            <td align='center'><b>%</b></td>
        </tr>

        <tr>
            <td align='center'>
                <h3>إجمالي الفاتورة</h3>
            </td>
            <td align='center'>
                <h3>
                    <font color='black'>{{ $currentSession->total }}</font>
                </h3>
            </td>
            <td align='center'>
                <h3>جنية</h3>
            </td>
        </tr>

        <tr>
            <td align='center'>
                <h3>إجمالي المرتجع</h3>
            </td>
            <td align='center'>
                <h3>
                    <font color='black'>{{ $currentSession->total }}</font>
                </h3>
            </td>
            <td align='center'>
                <h3>جنية</h3>
            </td>
        </tr>

    </table>
    <br />
    <table border="1" width="95%">

        {{-- <tr>
         <td><b> ملاحظات</b></td>
        <td> </td>
    </tr>
       <tr>
         <td><b> للحجز اتصل على</b></td>
        <td>01000000000</td>
     </tr> --}}

    </table>
    {{-- <p style="font-size: 10px;">تاريخ الطباعة: 10-01-2021 05:36:46 PM</p> --}}
    </font>
</body>

</html>
