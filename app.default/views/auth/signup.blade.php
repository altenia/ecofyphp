@section('content')
    <div class="container">
      <!-- title row -->
      <div class="col-md-12" style="text-align: center">
        <h3>Register</h3>
      </div>

      <!-- Row of columns -->
      <div class="col-md-12 " >
{{ HTML::ul($errors->all()) }}
@if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

        {{ Form::open(array('url' => 'auth/signup', 'class' => 'form-horizontal form-signin')) }}
          <div class="form-group">
            <label for="first_name" class="col-sm-2 control-label">{{ Lang::get('user.name') }}</label>
            <div class="col-sm-5">
              {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'placeholder'=>Lang::get('user.first_name') )) }}
            </div>
            <div class="col-sm-5">
              {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'placeholder'=>Lang::get('user.last_name') )) }}
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">{{ Lang::get('site.email') }}</label>
            <div class="col-sm-10">
              {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder'=>Lang::get('user.email') )) }}
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">{{ Lang::get('site.password') }}</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" id="password" placeholder="{{ Lang::get('site.password') }}">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> {{ Lang::get('site.rememberme') }}
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-info">{{ Lang::get('site.signup') }}</button>
            </div>
          </div>
        </form>
      {{ Form::close() }}

    </div> <!-- /container -->
@show