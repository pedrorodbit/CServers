<html>
  <head>
    <meta charset="utf-8">
    <title>{$page.name} - CS:GO Server Manager</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    {block name=head}{/block}
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">CServers</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="my-lg-0">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
                  <img src="/data/avatar/{$userData.steam_id}.jpg" class="rounded-circle" width="30px"> {$userData.steam_name}
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="/logout.php">Logout</a>
                </div>
              </li>
            </ul>
            </div>
          </div>

      </div>
    </nav>

    {block name=body}{/block}
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " charset="utf-8"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.3/bootstrap-notify.min.js" charset="utf-8"></script>
    <script src="/assets/js/main.js" charset="utf-8"></script>

    {if isset($success)}
      {foreach $success as $message}
        <script type="text/javascript">
          sendNotify(true, '{$message}');
        </script>
      {/foreach}
    {elseif isset($error)}
      {foreach $error as $reason}
        <script type="text/javascript">
          sendNotify(false, '{$reason}');
        </script>
      {/foreach}
    {/if}

    {if $page.id == 'server'}
    <script type="text/javascript">
    $(document).ready(function(){
      $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
      });
      var activeTab = localStorage.getItem('activeTab');
      if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      }
    });
    </script>
    {/if}
  </body>
</html>
