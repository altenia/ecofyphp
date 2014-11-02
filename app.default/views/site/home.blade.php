    @section('content')
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <div class="center-form">
          <h2 ><span class="a2e-logo ">{{ $siteContext->name }}</span>!</h2>
          <p>{{ $siteContext->slogan }}</p>
        </div>
        
      </div>
    </div>

    <div class="container" >
      <!-- title row -->
      <div class="row" >
        <div class="col-md-12" style="text-align: center">
          <h2>Welcome, explore {{ HTML::link($siteContext->main_page[1], $siteContext->main_page[0]) }}<h2>
        </div>
      </div>

<!--
@if (!Auth::check())
      <hr />
      <div class="row">
        <div class="col-md-4 col-md-offset-4" style="text-align: center">
          <h3> {{ HTML::link('auth/signup', Lang::get('site.signup') ) }}</h3>
          <br />
          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">{{ Lang::get('site.signin') }}</h3>
            </div>
            <div class="panel-body">
              {{ Form::open(array('url' => 'auth/signin', 'class' => 'form-signin')) }}
                <fieldset>
                  <div class="form-group">
                    {{ Form::text('login_id', Input::old('login_id'), array('class' => 'form-control', 'placeholder' => 'ID or Email' )) }}
                  </div>
                  <div class="form-group">
                    {{ Form::text('password', Input::old('password'), array('class' => 'form-control', 'placeholder'=>Lang::get('user.password') )) }}
                  </div>
                  <div class="checkbox">
                    <label>
                      <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                    </label>
                  </div>
                  <input class="btn btn-primary btn-block" type="submit" value="{{ Lang::get('site.signin') }}">
                </fieldset>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
@endif
-->

    </div> <!-- /container -->
@show