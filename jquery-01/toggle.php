<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="jquery.min.js"></script>
</head>

<body>
    <p id="para">Where is the spinner?
        <img id="spinner" src="spinner.gif" height="25" style="vertical-align: middle; display: none;">
    </p>
    <a href="#" onclick="$('#spinner').toggle(); return false;">Toogle</a>
    <a href="#" onclick="$('#para').css('background-color', 'red'); return false;">Red</a>
    <a href="#" onclick="$('#para').css('background-color', 'green'); return false;">Green</a>
</body>

</html>