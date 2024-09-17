<!DOCTYPE html>
<!--[if lte IE 9]>
<html lang="en" class="oldie">
<![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inmoviva</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sacramento&display=swap">
  <style>
    body {
      padding: 2vw;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #222;
      background-image: repeating-linear-gradient(
        to bottom,
        transparent 7px,
        rgba(0, 0, 0, 0.8) 9px,
        rgba(0, 0, 0, 0.8) 13px,
        transparent 13px
      );
      font-family: 'Nunito';
      color: #fff6a9;
    }

    h1, .top-links a {
      font-size: calc(10px + 6vw); /* Tamaño de fuente responsive para el título */
      line-height: calc(10px + 8vw); /* Line-height responsive para el título */
      text-shadow: 0 0 5px #ffa500, 0 0 15px #ffa500, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
      font-family: "Sacramento", cursive;
      text-align: center;
      animation: blink 12s infinite;
      -webkit-animation: blink 12s infinite;
      margin-top: 0;
      text-decoration: none;
      color: #fff6a9;
    }

    @-webkit-keyframes blink {
      20%, 24%, 55% {
        color: #111;
        text-shadow: none;
      }

      0%, 19%, 21%, 23%, 25%, 54%, 56%, 100% {
        text-shadow: 0 0 5px #ffa500, 0 0 15px #ffa500, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
        color: #fff6a9;
      }
    }

    @keyframes blink {
      20%, 24%, 55% {
        color: #111;
        text-shadow: none;
      }

      0%, 19%, 21%, 23%, 25%, 54%, 56%, 100% {
        text-shadow: 0 0 5px #ffa500, 0 0 15px #ffa500, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
        color: #fff6a9;
      }
    }

    .top-links {
      position: absolute;
      top: 20px;
      right: 20px;
      text-decoration: none;
      color: #fff6a9;
    }

    .top-links a {
      margin-left: 20px;
      font-size: calc(10px + 2vw); /* Tamaño de fuente más grande para los enlaces */
    }

  </style>
</head>
<body class="antialiased">
  <div class="top-links">
    @if (Route::has('login'))
      <div>
        @auth
          <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Dashboard</a>
        @else
          <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Login</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-300 underline">Register</a>
          @endif
        @endauth
      </div>
    @endif
  </div>
  <h1>INMOVIVA</h1>
</body>
</html>
