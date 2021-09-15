<div class="navigation">
    <ul>
        <li>
            <a href="{{route('dashboard')}}">
                <span class="icon material-icons md-light">sports</span>
                <span class="title-bar">
                    <h2>ESPORT</h2>
                </span>
            </a>
        </li>
    </ul>
    @can('dashboards')
    <ul>
        <li class="{{set_active('dashboard')}}">
            <a href="{{route('dashboard')}}">
                <span class="icon material-icons md-light">dashboard</span>
                <span class="title-bar">Dashboard</span>
            </a>
        </li>
    </ul>
    @endcan
    @role('Superadmin')
    <ul>
        <li class="{{set_active('branchs*')}}">
            <a href="{{route('branchs.index')}}">
                <span class="icon material-icons md-light">sports_soccer</span>
                <span class="title-bar">Cabang Olahraga</span>
            </a>
        </li>
    </ul>
    
    <ul>
        <li class="{{set_active('forms*')}}">
            <a href="{{route('forms.index')}}">
                <span class="icon material-icons md-light">list_alt</span>
                <span class="title-bar">Form</span>
            </a>
        </li>
    </ul>
    @endrole

    @can('teams-list')
    <ul>
        <li class="{{set_active('teams*')}}">
            <a href="{{route('teams.index')}}">
                <span class="icon material-icons md-light">groups</span>
                <span class="title-bar">Teams</span>
            </a>
        </li>
    </ul>
    @endcan
    @can('members-list')
    <ul>
        <li class="{{set_active('members*')}}">
            <a href="{{route('members.index')}}">
                <span class="icon material-icons md-light">remember_me</span>
                <span class="title-bar">Members</span>
            </a>
        </li>
    </ul>
    @endcan
    @can('games-list')
    <ul>
        <li class="{{set_active('games*')}}">
            <a href="{{route('games')}}">
                <span class="icon material-icons md-light">sports_esports</span>
                <span class="title-bar">Games</span>
            </a>
        </li>
    </ul>
    @endcan
    @can('organizations-list')
    <ul>
        <li class="{{set_active('organizations*')}}">
            <a href="{{route('organizations.index')}}">
                <span class="icon material-icons md-light">corporate_fare</span>
                <span class="title-bar">Organizations</span>
            </a>
        </li>
    </ul>
    @endcan
    @can('awards-list')
    <ul>
        <li class="{{set_active('awards*')}}">
            <a href="{{route('awards.index')}}">
                <span class="icon material-icons md-light">emoji_events</span>
                <span class="title-bar">Awards</span>
            </a>
        </li>
    </ul>
    @endcan
    @can('events-list')
    <ul>
        <li class="{{set_active('events*')}}">
            <a href="{{route('events.index')}}">
                <span class="icon material-icons md-light">celebration</span>
                <span class="title-bar">Events</span>
            </a>
        </li>
    </ul>
    @endcan
    @can('news-list')
    <ul>
        <li class="{{set_active('news*')}}">
            <a href="{{route('news.index')}}">
                <span class="icon material-icons md-light">article</span>
                <span class="title-bar">News</span>
            </a>
        </li>
    </ul>
    @endcan
    @can('clubs-list')
    <ul>
        <li class="{{set_active('clubs*')}}">
            <a href="{{route('clubs.index')}}">
                <span class="icon material-icons md-light">reduce_capacity</span>
                <span class="title-bar">Clubs</span>
            </a>
        </li>
    </ul>
    @endcan
    @role('Superadmin')
    @can('admins-list')
    <ul>
        <li class="{{set_active('admins*')}}">
            <a href="{{route('admins')}}">
                <span class="icon material-icons md-light">person_outline</span>
                <span class="title-bar">Admins</span>
            </a>
        </li>
    </ul>
    @endcan
    @can('roles-list')
    <ul>
        <li class="{{set_active('roles*')}}">
            <a href="{{route('roles')}}">
                <span class="icon material-icons md-light">add_moderator</span>
                <span class="title-bar">Roles</span>
            </a>
        </li>
    </ul>
    @endcan
    @endrole
    <ul>
        <li class="{{set_active('profile.show*')}}">
            <a href="{{route('profile.show')}}">
                <span class="icon material-icons md-light">contact_mail</span>
                <span class="title-bar">Profile</span>
            </a>
        </li>
    </ul>
    @can('users-list')
    <ul>
        <li class="{{set_active('users*')}}">
            <a href="{{route('users.index')}}">
                <span class="icon material-icons md-light">person_outline</span>
                <span class="title-bar">Users</span>
            </a>
        </li>
    </ul>
    @endcan
    <ul>
        <li>
            <a href="{{route('logout')}}">
                <span class="icon material-icons md-light">logout</span>
                <span class="title-bar">Sign Out</span>
            </a>
        </li>
    </ul>
</div>