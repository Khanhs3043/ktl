<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelloWordLaravel</title>
</head>
<body>
    <h1 class="s">Hello Word</h1>
    <h1 class="t"><?php echo $name ?></h1>
    <h1>{{$name}}</h1>
    <style>
        .t{
            color:red;
            text-align: center;
            font-size: 50px;
        }
        .s{
            color:green;
            text-align: center;
            font-size: 90px;
        }
    </style>
</body>
</html>