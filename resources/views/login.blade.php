<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f3f3f3;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .login-form {
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    text-align: center;
  }

  .login-form h2 {
    margin-bottom: 20px;
    color: #333;
  }

  .login-form input[type="email"],
  .login-form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
  }

  .login-form button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .login-form button:hover {
    background-color: #0056b3;
  }

  .login-form .fa {
    margin-right: 5px;
  }
</style>
</head>
<body>

<div class="login-form">
  <h2>Login</h2>
  <form action="#" method="post">
    @csrf
    <input type="email" name="email" placeholder="Your Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
  </form>
</div>

</body>
</html>
