    @section('content')
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <div class="center-form">
          <h2 ><span class="a2e-logo ">{{ \Altenia\Ecofy\Support\SiteContext::$name }}</span>!</h2>
          <p>Making document work for you.</p>
        </div>
        
      </div>
    </div>

    <div class="container" >
      <!-- title row -->
      <div class="row" >
        <div class="col-md-12" style="text-align: center">
          <h2>Create forms, automate flows, genrate reports<h2>
          <h3> {{ HTML::link('auth/signup', 'Try now') }}!</h3>
        </div>
      </div>

      <hr />

      <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Please sign in</h3>
            </div>
              <div class="panel-body">
                <form accept-charset="UTF-8" role="form">
                        <fieldset>
                    <div class="form-group">
                      <input class="form-control" placeholder="E-mail" name="email" type="text">
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                  </div>
                  <div class="checkbox">
                      <label>
                        <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                      </label>
                    </div>
                  <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                </fieldset>
                  </form>
              </div>
          </div>
        </div>
      </div>

    </div> <!-- /container -->
@show