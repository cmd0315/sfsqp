<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::route('dashboard') }}">St. Francis of Assisi and Sta. Quiteria Parish</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        @if($currentUser)
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $currentUser->username}} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ URL::route('accounts.edit', $currentUser->id) }}"> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ URL::route('sessions.signout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
    <!-- /.navbar-collapse -->
</nav>
