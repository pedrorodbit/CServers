{extends file="layout.tpl"}

{block name=body}
<div class="container">

  <div class="row">

    <div class="col-md-12">
      <br>
      <div class="card">
        <div class="card-header">
          My Servers
          <span class="float-right">
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#newServer">
              <i class="fas fa-plus"></i> Add server
            </button>
          </span>

          <div class="modal fade" id="newServer">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">New server</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post">
                    <input type="hidden" name="csrfToken" value="{nocache}{$csrfToken}{/nocache}">
                    <div class="form-group">
                      <label>Server name</label>
                      <input type="text" class="form-control" name="server_name" placeholder="My CS:GO Server" required>
                    </div>
                    <div class="form-group">
                      <label>Server IP + port</label>
                      <input type="text" class="form-control" name="ip_port" placeholder="127.0.0.1:27015" required>
                    </div>
                    <div class="form-group">
                      <label>Server rcon password</label>
                      <input type="text" class="form-control" name="rcon_pass" placeholder="rcon password" required>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-sm btn-block" name="addServer">Add server</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="card-body">

          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>IP:Port</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              {foreach $userServers as $row}
                <tr>
                  <td>{$row.name}</td>
                  <td>{$row.ip}:{$row.port}</td>
                  <td><a href="/server/{$row.id}" class="btn btn-primary btn-sm">View server</a></td>
                </tr>
              {/foreach}
            </tbody>
          </table>

        </div>
      </div>
    </div>

  </div>

</div>
{/block}
