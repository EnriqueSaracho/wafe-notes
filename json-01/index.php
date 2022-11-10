<!-- <!DOCTYPE html> -->
<html>

<head>
    <!-- meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">< -->
    <title>Document</title>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(data) {
            $.getJSON('json.php', function(data) {
                $("#back").html(data.first);
                window.console && console.log(data);
            })
        })
    </script>
</head>

<body>
    <p>Howdy - Lets get some JSON</p>
    <p id="back">Before</p>
    <p>
        <a href="syntax.php" target="_new">JSON Syntax</a> | 
        <a href="json.php" target="_new">json.php</a>
    </p>
</body>

</html>