<ul class="nav nav-pills flex-column">
  <li class="nav-item">
    <a class="nav-link {{ Request::is('posts') ? 'active' : ''}}" href="#">Posts</a>
  </li>
  <li class="nav-item">
    <a class="nav-link mt-2 {{ Request::is('categories') ? 'active' : ''}}" href="#">Categories</a>
  </li>
  <li class="nav-item">
    <a class="nav-link mt-2 {{ Request::is('tags') ? 'active' : ''}}" href="#">Tags</a>
  </li>
  <li class="nav-item">
    <a class="nav-link mt-2 {{ Request::is('users') ? 'active' : ''}}" href="#">Users</a>
  </li>
</ul>
