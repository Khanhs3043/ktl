<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
</head>
<body>
    <style>
        table{
            margin: auto;
            border-collapse: collapse;
        }
        td,th{
            padding: 5px 10px;
        }
        .form{
            display: flex;
            flex-direction: column;
            /* justify-items: center; */
            padding: 20px 20px;
            /* background-color: blue; */
            /* width: 300px; */
        }
        .in{
            width: 200px;
            border-radius: 20px;
            height: 40px;
        }
       button{
        margin-top: 20px;
        width: 100px;
        height: 40px;
        border-radius: 20px;
        border: none;
        background-color: palevioletred;
        color: white;
       }
    </style>
    <form action="{{ action('ShowData@insert') }}" class="form" method="POST">
        <input type="text" class="in" name="name"><br>
        <input type = "text"  class="in" name = "des"><br>
        <button type="submit">Insert</button>
    </form>
@if (count($datas)>0 )
        <table border=1>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
            @foreach($datas as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->description}}</td>
            </tr>
            @endforeach 
            
        </table>
        @else 
            <h3>Không có dữ liệu!</h3>
        @endif
    
</body>
</html>