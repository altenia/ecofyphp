<!-- 
http://bootsnipp.com/snippets/featured/navbar-search-add-on-bs-3
-->

    <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand site-logo" href="{{ $siteContext->context_path }}"  style="color:#356AA0; width:200px; text-align:center">[{{ $siteContext->name }}]</a>
               
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <a href="{{ $siteContext->alt_url }}"><img src="{{ $siteContext->context_path }}{{ $siteContext->logo_url }}" height="45" /></a>
               
               <ul class="nav navbar-nav navbar-right">
@if (Auth::check())
                  <!-- AUTHENTICATED { -->
                  <li class="dropdown">
                    <a href="#settings" title="Settings" >{{Auth::user()->getFullName()}} <span class="glyphicon glyphicon-cog"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ URL::to('users/' . Auth::user()->sid) }}">{{ Lang::get('site.myaccount') }}</a></li>
                      <li><a href="{{ URL::to('auth/signout') }}">{{ Lang::get('site.logout') }}</a></li>
                    </ul>
                  </li>
                  <!-- } AUTHENTICATED -->
@else
                  <!-- NON-AUTHENTICATED { -->
                  <li><a href="{{ URL::to('auth/signup') }}">{{ Lang::get('site.signup') }}</a></li>
                  <li><a href="{{ URL::to('personauth/signin') }}">{{ Lang::get('site.signin') }}</a></li>
                  <!-- } NON-AUTHENTICATED -->
@endif
               </ul>
               &nbsp;
            </div>
          </div>
