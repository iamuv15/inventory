<ul class="sidebar navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="{{ asset('/inc') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <!-- <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Pages</span>
    </a> -->
    <div class="menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">Employees:</h6>
      <a class="dropdown-item" href="{{ asset('/employee') }}">Employee</a>
      <a class="dropdown-item" href="{{ asset('add/employee') }}">Add Employee</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">DSR:</h6>
      <a class="dropdown-item" href="{{ asset('add/dsr') }}">Add DSR</a>
      <a class="dropdown-item" href="{{ asset('search/dsr') }}">Search DSR</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Inventory</h6>
      <a class="dropdown-item" href="{{ asset('inventory') }}">Inventory</a>
      <a class="dropdown-item" href="{{ asset('inventory/sale') }}">Sales</a>
      <a class="dropdown-item" href="{{ asset('inventory/purchase') }}">Company Purchases</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Quotation:</h6>
      <a class="dropdown-item" href="{{ asset('quotation') }}">Quotation</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Invoice:</h6>
      <a class="dropdown-item" href="{{ asset('invoice') }}">Invoice</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">DN Form:</h6>
      <a class="dropdown-item" href="{{ asset('dn-form') }}">DN Form</a>
      <a class="dropdown-item" href="{{ asset('dn-form/add') }}">New Entry</a>
    </div>
  </li>
</ul>
