<ul class="sidebar-menu">
    <li class="header">Navegacion</li>
    <!-- Optionally, you can add icons to the links -->
    <li {{ request()->is('admin') ? 'class=active' : '' }}>
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Inicio</span></a>
    </li>
    <li class="treeview {{ request()->is('admin/posts*') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-bars"></i> <span>Blog</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li {{ request()->is('admin/posts') ? 'class=active' : '' }}><a href="{{ route('admin.posts.index') }}"><i
                        class="fa fa-eye"></i> Ver todos los posts</a></li>
            <li>
                @if (request()->is('admin/posts/*'))
                    <a href="{{ route('admin.posts.index', '#create') }}"><i class="fa fa-pencil"></i> Crear un post</a>
            </li>
        @else
            <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil"></i> Crear un
                post</a>
    </li>
    @endif
</ul>
</li>
<li class="treeview {{ request()->is('admin/users*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li {{ request()->is('admin/users') ? 'class=active' : '' }}>
          <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver todos los usuarios</a>
        </li>
        <li>
            <a href="{{ route('admin.users.create', '#create') }}"><i class="fa fa-pencil"></i> Crear un usuario</a>
        </li>
    </ul>
</li>
</ul>
