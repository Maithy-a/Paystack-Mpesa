<!-- Navbar -->
<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
  <div class="container-xl">
    <!-- Navbar Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
      aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Right Navbar Elements -->
    <div class="navbar-nav ms-auto flex-row align-items-center">
      <!-- Theme Toggle Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icon-tabler-sun">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
        <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
      </svg>

      <!-- Notifications -->
      <div class="nav-item dropdown d-none d-md-flex me-3">

        <a href="#" class="nav-link px-3" data-bs-toggle="dropdown" aria-expanded="false"
          aria-label="Show notifications">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icon-tabler-bell-ringing">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
            <path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" />
            <path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" />
          </svg>
          <span class="badge bg-red"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow dropdown-menu-card">
          <div class="card" style="width: 20rem;">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h6 class="card-title mb-0">Notifications</h6>
              <a href="#" class="text-muted small">Mark all as read</a>
            </div>

            <div class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between align-items-center">
                  <span>New message from John</span>
                  <small class="text-muted">2 min ago</small>
                </div>
              </a>
            </div>
            <div class="card-footer text-center">
              <a href="#" class="text-muted small">View all notifications</a>
            </div>
          </div>
        </div>
        
      </div>

      <!-- User Profile -->
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          <span class="avatar avatar-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-tabler icon-tabler-user-circle">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
              <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
              <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
            </svg>
          </span>
          <div class="d-none d-xl-block ps-2">
            <div><?php echo htmlspecialchars($_SESSION['username']) ?></div>
            <div class="mt-1 small text-secondary"><?php echo htmlspecialchars($_SESSION['lastname']) ?></div>
          </div>
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
  </div>
</header>