<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الاله الحاسبة</title>
    <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>

<link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        body {
  font-family: 'Orbitron', sans-serif;
  background-color: #818181;
}

#calculator {
  height: 410px;
  width: 300px;
  margin-top: 10%;
  margin-left: auto;
  margin-right: auto;
  background-color: #dfd8d0;
  border: 2px solid #908b85;
  border-radius: 20px;
  box-shadow: 7px 10px 34px 1px rgba(0, 0, 0, 0.68), inset -1px -6px 12px 0.1px #89847e;
}

#title {
  padding-top: 10px;
  padding-bottom: 10px;
}

#title h5 {
    font-family: 'Cairo', sans-serif;

}

#entrybox {
  width: 85%;
  height: 65px;
  margin-left: auto;
  margin-right: auto;
  border: 2px solid #b4b39d;
  border-radius: 6px;
  background-color: #c3c2ab;
}

#entry {
  margin-right: 10px;
  font-size: 35px;
}

#buttons {
  font-size: 16px;
  font-weight: bold;
  color: #fff;
  position: absolute;
  display: inline-block;
  width: 280px;
  height: auto;
  margin-top: 15px;
  margin-left: 15px;
}

button {
  border-radius: 8px;
  border: none;
  background-color: #3a3a3a;
  margin: 0 4px 10px 8px;
  height: 40px;
  width: 50px;
  box-shadow: 0px 3px 0px 0px #222121, inset -1px -3px 10px 1px #515151;
}

button:active {
  transform: translate(0px, 3px);
  box-shadow: none;
}

.row {
  margin-top: 20px
}

#topAdjust {
  margin-top: -52px;
}

#equalButton {
  position: absolute;
  margin-left: 12px;
  margin-top: -50px;
  height: 90px;
}

#zeroButton {
  width: 117px;
}

.red {
  font-size: 14px;
  background-color: #a72d45;
  box-shadow: 0px 3px 0px 0px #671c2a;
}

#footer {
  font-family: 'Josefin Sans', sans-serif;
  position: relative;
  font-size: 16px;
  font-weight: normal;
  margin-top: 40px;
  width: 100%;
  height: 40px;
}

button,
button:hover,
button:active,
button:visited {
  text-decoration: none !important;
  outline: none !important;
}

a,
a:hover,
a:active,
a:visited {
  color: #922031;
  text-decoration: none !important;
  outline: none !important;
}

#history {
  /*transform: translate(-13px, -17px);*/
  position: relative;
  height: 10px;
  bottom: 17px;
  margin-right: 14px;
  color: #8b8b7b;
  font-size: 12px;
}
    </style>
</head>
<body>
    <div class='container'>
        <div id='calculator'>

          <!-- TITLE -->

          <div id='title' class='text-center'>
            <h5><b>الاله الحاسبة</b></h5>
          </div>

          <!-- ENTRY BOX -->

          <div id='entrybox' class='text-right'>
            <div id='entry'>
              <p id='answer'>0</p>
            </div>
            <div id='history'>
              <p>0</p>
            </div>
          </div>

          <!-- BUTTONS -->

          <div id='buttons'>

            <button class='red' value='ac'>AC</button>
            <button class='red' value='ce'>CE</button>
            <button value='/'>&divide;</button>
            <button value='*'>x</button>

            <button value='7'>7</button>
            <button value='8'>8</button>
            <button value='9'>9</button>
            <button value='-'>-</button>

            <button value='4'>4</button>
            <button value='5'>5</button>
            <button value='6'>6</button>
            <button value='+'>+</button>


            <button value='1'>1</button>
            <button value='2'>2</button>
            <button value='3'>3</button>
            <button class='invisible'>N</button>

            <button id='zeroButton' value='0'>0</button>
            <button value='.'>.</button>
            <button id='equalButton' value='='>=</button>

          </div>
          <!-- end buttons -->
          <div id='tester'></div>
        </div>
        <!-- end calculator -->
      </div>
      <!-- end container -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
      <script>
          // final draft
$(document).ready(function() {

var entry = '';
var ans = '';
var current = '';
var log = '';
var decimal = true;
var reset = '';

// round function if answer includes a decimal
function round(val) {
  val = val.toString().split('');
  if (val.indexOf('.') !== -1) {
    var valTest = val.slice(val.indexOf('.') + 1, val.length);
    val = val.slice(0, val.indexOf('.') + 1);
    var i = 0;
    while (valTest[i] < 1) {
      i++
    }
    valTest = valTest.join('').slice(0, i + 2);
    if (valTest[valTest.length-1] === '0') {
      valTest = valTest.slice(0, -1);
    }
    return val.join('') + valTest;
  } else {
    return val.join('');
  }
}

$('button').click(function() {

  entry = $(this).attr("value");
  console.log('entry: ' + entry);

  //reset for log after answer to equation.
  if (reset) {
    if (entry === '/' || entry === '*' || entry === '-' || entry === '+') {
      log = ans;
    } else {
      ans = '';
    }
  }
  reset = false;

  // All clear or Clear Entry
  if (entry === 'ac' || entry === 'ce' && current === 'noChange') {
    ans = '';
    current = '';
    entry = '';
    log = '';
    $('#history').html('0');
    $('#answer').html('0');
    decimal = true;
  } else if (entry === 'ce') {
    $('#history').html(log.slice(0, -current.length));
    log = log.slice(0, -current.length);
    ans = ans.slice(0, -current.length);
    current = ans;
    if (log.length === 0 || log === ' ') {
      $('#history').html('0');
    }
    $('#answer').html('0');
    entry = '';
    decimal = true;
  }

  // prevents more than one deciminal in a number
  if (entry === '.' || entry === '0.') {
    if (!decimal) {
      entry = '';
    }
  }

  // prevents improper use of first digit
  if (ans.length === 0 && isNaN(entry) && entry !== '.' || ans.length === 0 && entry === '0') {
    entry = '';
    ans = '';
  }

  // prevents extra operators
  if (current !== 'noChange') {
    if (current === '' && isNaN(entry) && entry !== '.' || isNaN(current) && isNaN(entry) && entry !== '.') {
      entry = '';
    }
  }

  // digit combining
  while (Number(entry) || entry === '0' || current === '.') {

    if (isNaN(current) && entry === '0' && current !== '.') {
      entry = '';
    } else if (isNaN(current) && Number(entry) && current !== '.') {
      current = '';
    }
    if (entry === '.') {
      decimal = false;
    }
    if (current === '0.' && isNaN(entry)) {
      entry = '';
    } else {
      if (current[current.length - 1] === '.') {
        current = current.concat(entry);
      } else {
        current += entry;
      }
      ans += entry;
      $('#answer').html(current);
      log += entry;
      $('#history').html(log);
      entry = '';
    }
  }

  // Operation list

  if (entry === '.') {
    if (current === '' || isNaN(current[current.length - 1])) {
      current = '0.';
      ans += entry;
      $('#answer').html('0.');
      log += current;
      $('#history').html(log);

    } else {
      current = current.concat('.');
      ans = ans.concat('.');
      log = ans;
      $('#history').html(ans);
      $('#answer').html(current);
    }
    entry = '';
    decimal = false;

  } else if (entry === '/') {
    current = '/';
    ans = round(eval(ans)) + current;
    log += current;
    $('#history').html(log);
    $('#answer').html('/');
    entry = '';
    decimal = true;

  } else if (entry === '*') {
    current = '*';
    ans = round(eval(ans)) + current;
    log += 'x';
    $('#history').html(log);
    $('#answer').html('x');
    entry = '';
    decimal = true;

  } else if (entry === '-') {
    current = '-';
    ans = round(eval(ans)) + current;
    log += current;
    $('#history').html(log);
    $('#answer').html('-');
    entry = '';
    decimal = true;

  } else if (entry === '+') {
    current = '+';
    ans = round(eval(ans)) + current;
    log += current;
    $('#history').html(log);
    $('#answer').html('+');
    entry = '';
    decimal = true;

  } else if (entry === '=') {
    if (current[current.length - 1] === '.') {
      entry = '';
    } else {
      current = eval(ans).toString();
      $('#answer').html(round(eval(ans)));
      ans = round(eval(ans));
      log += entry + ans;
      $('#history').html(log);
      log = ans;
      entry = '';
      reset = true;
      decimal = true;
    }
    current = 'noChange';
  }
  entry = '';

  if (reset) {
    log = '';
  }

  // max digits on screen
  if ($('#entry').children().text().length > 8 || $('#history').text().length > 22) {
    $('#answer').html('0');
    $('#history').html('Digit Limit Met');
    current = '';
    ans = '';
    log = '';
    decimal = true;
  }

  console.log('decimal: ' + decimal);
  console.log('current: ' + current);
  console.log('answer: ' + ans);
  console.log($('#history').text().length);
});
}); // end doc ready function
      </script>
</body>
</html>
