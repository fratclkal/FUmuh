<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@foreach($news as $new)
    Başlık:{{$new->title}} <br>
    İçerik:{{$new->content}} <br>
    Resim:{{$new->img_path}} <br>
@endforeach
</body>
</html>
