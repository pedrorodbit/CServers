<html>
  <head>
    <meta charset="utf-8">
    <title>CS:GO Server Manager</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="assets/css/cover.css">
  </head>
  <body>
    <div class="text-center">
      <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
          <div class="masthead-brand">
            <img src="/assets/imgs/csgo-icon.png" class="rounded" width="35px">
            <h3>CS:GO Server Manager</h3>
          </div>
        </header>

        <main role="main" class="inner cover">
          <h1 class="cover-heading">Make it simple.</h1>
          <p class="lead">CServers is a manager for CS:GO servers. You can use it to control your CS: GO servers without having to have knowledge of console commands.</p>
          <p class="lead">
            <form action="auth.php" method="post">
              <input type="hidden" name="csrfToken" value="{nocache}{$csrfToken}{/nocache}">
              <button type="submit" class="btn btn-lg btn-secondary"><i class="fab fa-steam"></i> Login with Steam</button>
            </form>
          </p>
        </main>

        <footer class="mastfoot mt-auto">
          <div class="inner">
            <p>Developed by pedrorodbit.</p>
          </div>
        </footer>
      </div>
    </div>
  </body>
</html>
