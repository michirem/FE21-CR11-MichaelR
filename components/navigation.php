<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
  <a class="navbar-brand" href="home.php">Meme Pets</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <?php
      if (isset($_SESSION['adm'])) {
          echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="profile.php">My Profile</a>
          </li>
          <li class="nav-item d-lg-none">
            <a class="btn btn-primary" aria-current="page" href="actions/logout.php?logout">Logout</a>
          </li>
          </ul>';
      }
      if (isset($_SESSION['user'])) {
          echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="senior.php">Senior Pets</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="booking.php">My Reservations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="contactus.php">Contact us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="profile.php">My Profile</a>
          </li>
          <li class="nav-item d-lg-none">
            <a class="btn btn-primary" aria-current="page" href="actions/logout.php?logout">Logout</a>
          </li>
          </ul>';
        }
      ?>
  </div>
  <div class="ml-auto d-none d-lg-inline-block"><a class="btn btn-primary" aria-current="page" href="actions/logout.php?logout">Logout</a></div>
</div>
</nav>