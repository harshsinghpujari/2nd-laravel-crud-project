<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  @auth
   
    <p>congrats you are logged in </p>
    <form action="/logout" method="POST">
      @csrf
      <button>logout</button>
    </form>
      
  @else
    


  <form action="/register" method="POST">

    @csrf
    <input name="name" type="text" placeholder="name">
    <input name="email" type="text" placeholder="email">
    <input name="password" type="password" placeholder="password">
    <button>Register</button>
  </form>
</body>
</html>