@section('content')
    <div class="container">
      <!-- title row -->
      <div class="col-md-12" style="text-align: center">
        <h3>{{ Lang::get('site.signup') }}</h3>
      </div>

      <!-- Row of columns -->
      <div class="col-md-12 " >
{{ HTML::ul($errors->all()) }}
@if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

        {{ Form::open(array('url' => 'auth/signup', 'class' => 'form-horizontal form-signin')) }}
          <input type="hidden" name="person_sid" />
          <div class="form-group">
            <label for="name_nl" class="col-sm-2 control-label">{{ Lang::get('person.name_nl') }}</label>
            <div class="col-sm-5"  id="remote">
              {{ Form::text('name_nl', Input::old('name_nl'), array('class' => 'form-control typeahead required', 'placeholder' => Lang::get('person.name_nl') )) }}
            </div>
            <div class="col-sm-5">
              {{ Form::text('alternate_name', Input::old('alternate_name'), array('class' => 'form-control', 'placeholder' => Lang::get('person.alternate_name') )) }}
            </div>
          </div>
          <div class="form-group">
            <label for="given_name" class="col-sm-2 control-label">{{ Lang::get('user.name') }}</label>
            <div class="col-sm-5">
              {{ Form::text('given_name', Input::old('given_name'), array('class' => 'form-control', 'placeholder'=>Lang::get('user.given_name') )) }}
            </div>
            <div class="col-sm-5">
              {{ Form::text('family_name', Input::old('family_name'), array('class' => 'form-control', 'placeholder'=>Lang::get('user.family_name') )) }}
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
            <label for="telephone" class="col-sm-2 control-label">{{ Lang::get('person.telephone') }}</label>
            <div class="col-sm-5">
              {{ Form::text('telephone', Input::old('telephone'), array('class' => 'form-control', 'placeholder'=>Lang::get('person.telephone') )) }}
            </div>
            <div class="col-sm-5">
              {{ Form::text('mobile_number', Input::old('mobile_number'), array('class' => 'form-control', 'placeholder'=>Lang::get('person.mobile_number') )) }}
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-sm-2 control-label">{{ Lang::get('person.address') }}</label>
            <div class="col-sm-10">
              {{ Form::textarea('address', null, array('class' => 'form-control', 'size' => '50x2')) }}
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

{{ HTML::style('css/typeahead.css') }}
{{ HTML::script('js/typeahead.bundle.js') }}
<script>
$(document).ready(function() {
  
  //$('#TransactionForm').parsley();
  //$('#TransactionForm').bootstrapValidator({

  var personNameTypeahead = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: '/api/persons?name_nl-like=%QUERY%'
  });
   
  personNameTypeahead.initialize();
   
  $('#remote .typeahead').typeahead(null, {
    name: 'name_nl',
    displayKey: 'name_nl',
    source: personNameTypeahead.ttAdapter()
  });

  $('#remote .typeahead').bind('typeahead:selected', function(obj, datum, name) {      
        $('input[name="given_name"]').val(datum.given_name);
        $('input[name="family_name"]').val(datum.family_name);
        $('input[name="alternate_name"]').val(datum.alternate_name);
        $('input[name="person_sid"]').val(datum.sid);
        $('input[name="password"]').val('');
        $('textarea[name="address"]').val(datum.address);
  });

});
</script>
@show