<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$data['title']}}</title>
    <style>
        div{
            width: 300px;
            margin: auto
        }
        p {
            font-size: 20px;
            text-align: center;
        }
        span{
            color: rgb(61, 61, 255);
        }
    </style>
</head>
<body>
    <div>
        <p style="color: rgb(255, 153, 0)">{{$data['body']}}</p>
        <p>copy this code : <span>{{$data['code']}}</span></p>
        <p>Thank You</p>
    </div>
</body>
</html>
