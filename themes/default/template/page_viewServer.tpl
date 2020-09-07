{extends file="layout.tpl"}

{block name=body}
<div class="container">

  <div class="col-md-12">
    <br>
    <div class="card">
      <div class="card-header">
        {$serverData.name}
      </div>
      <div class="card-body">

        {if isset($serverInfo.HostName)}
          <nav>
            <div class="nav nav-tabs">
              <a class="nav-item nav-link active" data-toggle="tab" href="#nav-info">Server info</a>
              <a class="nav-item nav-link" data-toggle="tab" href="#nav-players">Players</a>
              <a class="nav-item nav-link" data-toggle="tab" href="#nav-map">Map</a>
              <a class="nav-item nav-link" data-toggle="tab" href="#nav-commands">Commands</a>
              <a class="nav-item nav-link" data-toggle="tab" href="#nav-console">Console</a>
              <a class="nav-item nav-link" data-toggle="tab" href="#nav-mods">Mods</a>
              <a class="nav-item nav-link" data-toggle="tab" href="#nav-delete">Delete</a>
            </div>
          </nav>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="nav-info">
              <br>
              <table class="table">
                <tbody>
                  <tr>
                    <td><b>IP:Port</b></td>
                    <td>{$serverData.ip}:{$serverData.port}</td>
                  </tr>
                  <tr>
                    <td><b>ServerName</b></td>
                    <td>{$serverInfo.HostName}</td>
                  </tr>
                  <tr>
                    <td><b>Map</b></td>
                    <td>{$serverInfo.Map}</td>
                  </tr>
                  <tr>
                    <td><b>Players</b></td>
                    <td>{$serverInfo.Players}/{$serverInfo.MaxPlayers}</td>
                  </tr>
                  <tr>
                    <td><b>Password</b></td>
                    <td>{$serverInfo.Password}</td>
                  </tr>
                  <tr>
                    <td><b>Secure (VAC)</b></td>
                    <td>
                      {if isset($serverInfo.Secure)}
                        {if $serverInfo.Secure}
                          <p style="color: green;">Yes!</p>
                        {else}
                          <p style="color: red;">No!</p>
                        {/if}
                      {/if}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="nav-players">
              <br>
              <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Time</th>
                  </tr>
                </thead>
                <tbody>
                  {foreach $players as $row}
                    <tr>
                      <td>{$row.Name}</td>
                      <td>{$row.Frags}</td>
                      <td>{$row.TimeF}</td>
                    </tr>
                  {/foreach}
                </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="nav-console">
              <br>
              <form method="post">
                <div class="form-group">
                  <label for="console">Console</label>
                  <textarea class="form-control" name="console" id="console" rows="5"></textarea>
                </div>
                <hr>
                <button type="submit" class="btn btn-success btn-block">Submit</button>
              </form>
            </div>

            <div class="tab-pane fade" id="nav-map">
              <br>
              <form method="post">
                <select class="custom-select" name="changeMode" required>
                  <option value="" selected>Choose gamemode...</option>
                  <option value="competitive">Competitive</option>
                  <option value="wingman">Wingman</option>
                  <option value="deathmatch">Deathmatch</option>
                  <option value="arms_race">Arms Race</option>
                </select>
                <br>
                <br>

                <select class="custom-select" name="changeMap" required>
                  <option value="" selected>Choose map...</option>
                  <option value="de_mirage">Mirage</option>
                  <option value="de_inferno">Inferno</option>
                  <option value="de_overpass">Overpass</option>
                  <option value="de_vertigo">Vertigo</option>
                  <option value="de_nuke">Nuke</option>
                  <option value="de_train">Train</option>
                  <option value="de_dust2">Dust 2</option>
                  <option value="de_cache">Cache</option>
                  <option value="de_cbble">Cobblestone</option>
                  <option value="cs_office">Office</option>
                  <option value="cs_agency">Agency</option>
                  <option value="de_anubis">Anubis</option>
                  <option value="de_chlorine">Chlorine</option>
                  <option value="de_shortdust">Short Dust</option>
                  <option value="de_shortnuke">Short Nuke</option>
                  <option value="de_lake">Lake</option>
                  <option value="gd_rialto">Rialto</option>
                </select>
                <hr>
                <button type="submit" class="btn btn-success btn-block">Set gamemode & map</button>
              </form>
            </div>

            <div class="tab-pane fade" id="nav-commands">
              <br>
              <table class="table">
                <tbody>
                  <tr>
                    <td><b>Pause</b></td>
                    <td>
                      <form method="post">
                        <button type="submit" class="btn btn-success" name="pause_enable">Enable</button>
                        <button type="submit" class="btn btn-danger" name="pause_disable">Disable</button>
                      </form>
                    </td>
                  </tr>

                  <tr>
                    <td><b>Warm Up</b></td>
                    <td>
                      <form method="post">
                        <button type="submit" class="btn btn-success" name="warmup_start">Start</button>
                        <button type="submit" class="btn btn-danger" name="warmup_end">End</button>
                      </form>
                    </td>
                  </tr>

                  <tr>
                    <td><b>Bots</b></td>
                    <td>
                      <form method="post">
                        <button type="submit" class="btn btn-success" name="bot_add">Add</button>
                        <button type="submit" class="btn btn-danger" name="bot_kick">Kick</button>
                      </form>
                    </td>
                  </tr>

                  <tr>
                    <td><b>Cheats</b></td>
                    <td>
                      <form method="post">
                        <button type="submit" class="btn btn-success" name="cheats_enable">Enable</button>
                        <button type="submit" class="btn btn-danger" name="cheats_disable">Disable</button>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="nav-console">
              <br>
              <form method="post">
                <div class="form-group">
                  <label for="console">Console</label>
                  <textarea class="form-control" name="console" id="console" rows="5"></textarea>
                </div>
                <hr>
                <button type="submit" class="btn btn-success btn-block">Submit</button>
              </form>
            </div>

            <div class="tab-pane fade" id="nav-mods">
              <br>
              <table class="table">
                <tbody>
                  <tr>
                    <td><b>Retakes (splewis)</b></td>
                    <td>
                      <form method="post">
                        <button type="submit" class="btn btn-success" name="retakes_enable">Enable</button>
                        <button type="submit" class="btn btn-danger" name="retakes_disable">Disable</button>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="nav-delete">
              <br>
              <code>This action is irreversible, are you sure?</code>
              <form method="post">
                <input type="hidden" name="csrfToken" value="{nocache}{$csrfToken}{/nocache}">
                <hr>
                <button type="submit" class="btn btn-danger btn-block">!!! DELETE SERVER !!!</button>
              </form>
            </div>
          </div>
        {else}
          <code>
            <i class="fas fa-exclamation-triangle"></i> We were unable to connect to your server.
          </code>
          <br>
          <br>

          <a href="" class="btn btn-primary"><i class="fas fa-redo-alt"></i> Try again</a>
        {/if}
      </div>
    </div>
  </div>

</div>
{/block}
