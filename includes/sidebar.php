<!-- Sidebar -->
<aside class="navbar navbar-vertical navbar-expand-lg">
  <div class="container-fluid">
    <!-- Sidebar Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
      aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Brand -->
    <figure class="text-center">
      <div class="blockquote text-center">
        <h2>CodeSafiCreatives</h2>
      </div>
      <figcaption class="blockquote-footer">
        <cite title="Source Title">Let's craft your web persona. </cite>
      </figcaption>
    </figure>

    <!-- Mobile User Menu -->
    <div class="navbar-nav flex-row d-lg-none">
      <div class="nav-item dropdown">
        <a href="#" class="nav-link lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          <span class="avatar avatar-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
              <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
              <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
            </svg>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="#!" class="dropdown-item">Status</a>
          <a href="#!" class="dropdown-item">Profile</a>
          <div class="dropdown-divider"></div>
          <a href="#!" class="dropdown-item">Settings</a>
          <a href="#!" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="collapse navbar-collapse" id="sidebar-menu">
      <ul class="navbar-nav pt-lg-3">
        <!-- Dashboard -->
        <li class="nav-item <?php echo ($page == 'home') ? 'active' : ''; ?>">
          <a class="nav-link" href="home.php">
            <span class="nav-link-title">Payment page</span>
          </a>
        </li>

        <!-- Pages -->
        <li class="nav-item dropdown <?php echo ($page == 'financial_tools') ? 'active' : ''; ?>">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">
            <span class="nav-link-title">Financial Tools</span>
          </a>
          <div class="dropdown-menu show">
            <a class="dropdown-item <?php echo ($page == 'transactions') ? 'active' : ''; ?>"
              href="transactions.php">Transactions</a>
            <a class="dropdown-item" href="#!">Notifications</a>
            <a class="dropdown-item" href="#!">Receipts</a>
            <a class="dropdown-item" href="#!">Invoices</a>
            <a class="dropdown-item" href="#!">Report</a>
          </div>
        </li>

        <li class="nav-item <?php echo ($page == 'settings') ? 'active' : ''; ?>">
          <a class="nav-link" href="home.php">
            <span class="nav-link-title">Settings</span>
          </a>
        </li>

        <!-- More -->
        <li class="nav-item dropdown <?php echo ($page == 'more') ? 'active' : ''; ?>">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">
            <span class="nav-link-title">More</span>
          </a>
          <div class="dropdown-menu show ">
            <a href="#!" class="dropdown-item">Terms of Service</a>
            <a href="#!" class="dropdown-item">FAQ</a>
            <a href="#!" class="dropdown-item">GitHub</a>
          </div>
        </li>

      </ul>
    </div>
    
  </div>
</aside>