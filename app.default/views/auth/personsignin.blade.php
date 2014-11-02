@section('content')
    <div class="container">
      <!-- title row -->
      <div class="col-md-6 col-md-offset-3" style="text-align: center">
        <h3>{{ Lang::get('person.register_and_signin') }}</h3>
        <div  class="alert alert-info">
          <p>Once registered, you will be able to <a href="{{ URL::to('auth/signin') }}">sign-in</a> with your email and the data you used to confirm your identity (phone or zipcode) as your password.
          <p><b>If you have previously registered, you can sign-in <a href="{{ URL::to('auth/signin') }}">here</a></b></p>
        </div>
        <br />
      </div>


      <!-- if there are creation errors, they will show here -->
      <!-- Row of columns -->
      <div class="col-md-12 " >
@if (Session::has('message'))
			<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@if ($errors)
          <div class="col-md-6 col-md-offset-3">
  {{ HTML::ul($errors->all(), array('class'=>'alert alert-warning')) }}
          </div>
@endif

      	{{ Form::open(array('url' => 'personauth/signin', 'class' => 'form-horizontal form-signin')) }}
          <div class="form-group">
            {{ Form::label('loginId', Lang::get('person.name'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'required' => '', 'placeholder' => Lang::get('person.name') )) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('email', Lang::get('person.email'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            	{{ Form::text('email', Input::old('email'), array('class' => 'form-control ', 'required' => '', 'placeholder'=> Lang::get('person.email') )) }}
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12 text-center">
              Confirm you identity <br /> (this value should match the value in the database)
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('verifier', Lang::get('person.verifier'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('verifier', Input::old('verifier'), array('class' => 'form-control', 'required' => '', 'placeholder'=> Lang::get('person.verifier') )) }}
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            	{{ Form::submit(Lang::get('site.signin'), array('class' => 'btn btn-primary')) }}
            </div>
          </div>
        {{ Form::close() }}
      </div>

    </div> <!-- /container -->
@show
