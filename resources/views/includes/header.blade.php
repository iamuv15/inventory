<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Navbar content -->
  <a class="navbar-brand" href="{{ route('dashboard') }}">MED</a>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Employees
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ asset('/employee') }}">Employee</a>
          <a class="dropdown-item" href="{{ asset('add/employee') }}">Add Employee</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          DSR
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ asset('add/dsr') }}">Add DSR</a>
          <a class="dropdown-item" href="{{ asset('search/dsr') }}">Search DSR</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventory
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ asset('inventory') }}">Inventory</a>
          <a class="dropdown-item" href="{{ asset('inventory/sale') }}">Sales</a>
          <a class="dropdown-item" href="{{ asset('inventory/purchase') }}">Company Purchases</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Quotation
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ asset('quotation') }}">Quotation</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Invoice
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ asset('invoice') }}">Invoice</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          DN Form
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ asset('dn-form') }}">DN Form</a>
          <a class="dropdown-item" href="{{ asset('dn-form/add') }}">New Entry</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="post">
      <input type="hidden" name="_token" value="{{ Session::token() }}">
      <input type="submit" name="logout" class="btn btn-outline-success my-2 my-sm-0" value="Logout">
    </form>
  </div>

</nav>
