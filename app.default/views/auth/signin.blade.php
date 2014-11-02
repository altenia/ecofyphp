@section('content')
    <div class="container">
      <!-- title row -->
      <div class="col-md-12" style="text-align: center">
        <h3>{{ Lang::get('site.signin') }}</h3>
      </div>

      <!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}
      <!-- Row of columns -->
      <div class="col-md-12 " >
@if (Session::has('message'))
			  <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Sign In</h3>
              </div>
              <div class="panel-body">
            	{{ Form::open(array('url' => 'auth/signin', 'class' => 'form-signin')) }}
                <div class="form-group">
                  {{ Form::label('loginId', 'ID or email', array('class' => 'control-label')) }}
                    {{ Form::text('login_id', Input::old('login_id'), array('class' => 'form-control', 'placeholder' => '' )) }}
                </div>
                <div class="form-group">
                  {{ Form::label('password', Lang::get('user.password'), array('class' => 'control-label')) }}
                  	{{ Form::password('password', array('class' => 'form-control', 'placeholder' => '' )) }}
                </div>
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Remember me
                    </label>
                  </div>
                </div>
                  	{{ Form::submit(Lang::get('site.signin'), array('class' => 'btn btn-primary btn-block')) }}
              {{ Form::close() }}
              </div>
            </div>
          </div>

        </div>
      </div>

    </div> <!-- /container -->
@show
