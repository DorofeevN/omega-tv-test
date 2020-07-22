<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <!-- Nav Item - Companies -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('companies') }}">
      <i class="fas fa-fw fa-table"></i>
      <span>Companies</span></a>
  </li>

  <!-- Nav Item - Tarifs -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('tarifs') }}">
      <i class="fas fa-fw fa-table"></i>
      <span>Tarifs</span></a>
  </li>


  <!-- Nav Item - Customers -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('customers') }}">
      <i class="fas fa-fw fa-table"></i>
      <span>Customers</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
