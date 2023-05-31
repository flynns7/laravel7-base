  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-none">
              <a href="../../index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-none">
              <a href="#" class="nav-link">Contact</a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
                  <div class="image mr-3">
                      <img src="/img/user2-160x160.jpg" class="img-circle" width="32" height="32" alt="User Image">
                  </div>
                  <span class="mr-3 font-weight-bold" style="color:#1F384C; font-size:12px;">{{ auth()->user()->name }}</span>
                  <i class="fa fa-angle-down"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a class="dropdown-item" href="/auth/logout" role="button">
                      <i class="fas fa-sign-out-alt"></i>
                      Profile
                  </a>
                  <a class="dropdown-item" href="/auth/logout" role="button">
                      <i class="fas fa-sign-out-alt"></i>
                      Signout
                  </a>
              </div>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
