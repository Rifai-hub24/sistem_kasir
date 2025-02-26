<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    :root {
      --white: #fff;
      --black: #c48704;
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #fce45e, #fce45e);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .wrapper {
      position: relative;
      width: 750px;
      height: 450px;
      background: var(--white);
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    /* Bagian kiri: Info */
    .info-text {
      width: 50%;
      background: var(--black);
      color: var(--white);
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
    }

    .info-text h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .info-text p {
      font-size: 14px;
      line-height: 1.5;
    }

    /* Bagian kanan: Form */
    .form-box {
      width: 50%;
      background: var(--white);
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .form-box h2 {
      font-size: 22px;
      margin-bottom: 20px;
      text-align: center;
      color: #000000; /* Menambahkan warna hitam pada teks */
    }

    form {
      display: flex;
      flex-direction: column;
      width: 100%;
      gap: 15px;
    }

    form input {
      width: 100%;
      padding: 10px;
      border: 1px solid var(--black);
      border-radius: 5px;
      font-size: 14px;
    }

    form button {
      width: 107%;
      padding: 10px;
      background: var(--black);
      color: var(--white);
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      font-weight: bold;
    }

    form p {
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
    }

    form p a {
      color: var(--black);
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body class="bg-dark text-light">
  <div class="wrapper">
    <!-- Left Section (Info) -->
    <div class="info-text">
      <h1>Selamat Datang di Halaman Login</h1>
      <p>Silakan login untuk mengakses dashboard Anda.</p>
    </div>
    <!-- Right Section (Form) -->
    <div class="form-box">
      <h2>LOGIN</h2>
      <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div class="form-group">
          <input type="text" class="form-control" name="id_user" placeholder="ID User" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-dark btn-block">Masuk</button>
      </form>

      @if(session('error'))
        <p class="text-danger text-center mt-3">{{ session('error') }}</p>
      @endif
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
