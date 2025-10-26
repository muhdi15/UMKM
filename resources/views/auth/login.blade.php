<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    
    <form method="POST" action="{{route('login.post')}}">
     @csrf
     <label for="email" name="email">email</label>
     <input type="text" name="email">
     <br>
     <label for="password" name="password">Password</label>
     <input type="text" name="email">   
    </form>

</body>
</html>