<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Member Login</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", sans-serif;
      background: linear-gradient(135deg, #7b42f6, #b01eff);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background-color: white;
      width: 90%;
      max-width: 800px;
      display: flex;
      border-radius: 10px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }

    .login-image {
      flex: 1;
      background: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }

    .login-image .icon {
      font-size: 80px;
      color: #7b42f6;
    }

    .login-form {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-form h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .login-form .input-group {
      margin-bottom: 20px;
      position: relative;
    }

    .login-form input {
      width: 80%;
      padding: 12px 15px 12px 40px;
      border-radius: 30px;
      border: 1px solid #ddd;
      font-size: 14px;
      outline: none;
    }

    .login-form .input-group::before {
      content: '';
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      width: 20px;
      height: 20px;
      background-size: contain;
      background-repeat: no-repeat;
    }

    .login-form .input-group.email::before {
      background-image: url('https://img.icons8.com/ios-glyphs/30/000000/email.png');
    }

    .login-form .input-group.password::before {
      background-image: url('https://img.icons8.com/ios-glyphs/30/000000/lock--v1.png');
    }

    .login-form button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 30px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .login-form button:hover {
      background-color: #45a049;
    }

    .login-form .links {
      text-align: center;
      margin-top: 15px;
      font-size: 13px;
    }

    .login-form .links a {
      color: #555;
      text-decoration: none;
      margin: 0 5px;
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
      }

      .login-image {
        display: none;
      }

      .login-form {
        padding: 30px;
      }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="login-image">
      <div class="icon">🧑‍💻</div> <!-- You can change to 👤 or 🧑‍💻 or any emoji/icon -->
    </div>
    <form class="login-form" action="database.php" method="POST">
      <h2>Member Login</h2>

      <div class="input-group email">
        <input type="email" name="email" placeholder="Email" required />
      </div>

      <div class="input-group password">
        <input type="password" name="password" placeholder="Password" required />
      </div>

      <button type="submit" name="send">LOGIN </button>

      <div class="links">
        <!-- <a href="#">Forgot Username / Password?</a><br> -->
        <a href="register.php">Create your Account →</a>
      </div>    
    </form>
  </div>

</body>
</html>
