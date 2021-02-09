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
<h2>Hi {{ $user->name }}</h2>
<hr>
<p>A new blog "{{ $blog->title }}" has been published <a href="http://backend.demo.test/blogs/{{ $blog->slug
}}">READ</a></p>
</body>
</html>