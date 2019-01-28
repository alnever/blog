<ul class="nav nav-pills flex-column">
  @if (Auth::user()->hasRole('Author'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('posts*') ? 'active' : ''}}" href="{{ route('posts.index') }}">
        Posts
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link mt-2 {{ Request::is('categories*') ? 'active' : ''}}" href="{{ route('categories.index') }}">
        Categories
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link mt-2 {{ Request::is('tags*') ? 'active' : ''}}" href="{{ route('tags.index') }}">Tags</a>
    </li>
  @endif

  @if (Auth::user()->hasRole('Administrator'))
    <li class="nav-item">
      <a class="nav-link mt-2 {{ Request::is('messages*') ? 'active' : ''}}" href="{{ route('messages.index') }}">Messages</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mt-2 {{ Request::is('users*') ? 'active' : ''}}" href="{{ route('users.index') }}">Users</a>
    </li>
  @endif
</ul>
