<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body onload="window.print()">
    @for ($i = 0; $i < $qty; $i++)
<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($code, 'C39',3,33,array(1,1,1), true)}}" alt="barcode"   />';
<br>
@endfor
</body>
</html>

