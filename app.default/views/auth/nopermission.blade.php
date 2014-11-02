@section('content')
    <div class="container">
      <!-- title row -->
      <div class="col-md-12" style="text-align: center">
        <h3>{{ Lang::get('site.nopermission') }}</h3>

        {{ HTML::image('images/icons/lock.png', 'Lock', array('width'=>'175px')) }}

        <br />
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

      </div>


    </div> <!-- /container -->
@show
