<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['logout'])) {
    include("../backend/logout.php");
  }
}

include("../backend/fetchUserAccounts.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/3ee2c2cc76.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- Header navigation -->
  <nav class="navbar navbar-expand-md bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- User dropdown menu -->
        <div class="d-flex ms-auto">
          <div class="dropdown">
            <button class="btn dropdown-toggle d-flex align-items-center gap-3 text-white border"
              type="button"
              data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="../img/default_profile.png"
                alt="Default Profile"
                class="img-fluid rounded-circle"
                style="width: 45px; height: 45px; object-fit: cover;">

              <div class="text-start">
                <div class="fw-semibold mb-0"><?php echo $_SESSION['user']; ?></div>
                <small class="mb-0">Role</small>
              </div>

            </button>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profile.php"> <i class="fa-solid fa-user"></i> Profile</a></li>
              <li>
                <form method="POST">
                  <button class="dropdown-item btn" type="submit" name="logout"> <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out</button>
              </li>

              </form>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="container mt-2">
    <h1><?php
        echo "Welcome, " . $_SESSION['user'] . "!";
        ?></h1>
  </div>

  <!-- Main content area -->
  <div class="container mt-3 d-flex justify-content-between">

    <h3>Manage Users</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUserModal"> <i class="fa-solid fa-plus"></i> Add User</button>
  </div>
  <!-- User table -->
  <div class="table-responsive-lg container mt-3">
    <table class="table table-light table-striped table-hover table-bordered">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Full Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
              <?php
              if ($row['role'] == "admin") {
                echo '<span class="badge bg-primary">Admin</span>';
              } else if ($row['role'] == "staff") {
                echo '<span class="badge bg-warning text-dark">Staff</span>';
              } else {
                echo '<span class="badge bg-secondary">User</span>';
              }
              ?></td>
            <td>
              <?php
              if ($row['status'] == "Active") {
                echo '<span class="badge bg-success">Active</span>';
              } else {
                echo '<span class="badge bg-secondary">Inactive</span>';
              }
              ?>
            </td>
            <td>
              <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">Edit</button>
              <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>">Delete</button>
            </td>
          </tr>

          <!-- Edit Modal -->
          <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="editModalLabel">Edit User</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="../backend/editUser.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="fullname" class="form-label text-secondary">Full Name</label>
                    <input class="form-control mb-3" type="text" name="fullname" value="<?php echo $row['fullname']; ?>" required>
                    <label for="email" class="form-label text-secondary">Email</label>
                    <input class="form-control mb-3" type="email" name="email" value="<?php echo $row['email']; ?>">
                    <label for="password" class="form-label text-secondary">Password</label>
                    <input class="form-control mb-3" type="password" name="password">
                      <label for="role" class="form-label text-secondary">Role</label>
                    <select name="role" class="form-control mb-3">
                      <option value="admin" <?php if ($row['role'] == "admin") { echo "selected"; } ?>>Admin</option>
                      <option value="staff" <?php if ($row['role'] == "staff") { echo "selected"; } ?>>Staff</option>
                      <option value="user" <?php if ($row['role'] == "user") { echo "selected"; } ?>>User</option>
                    </select>
                    <label for="status" class="form-label text-secondary">Status</label>
                    <select name="status" class="form-control mb-3">
                      <option value="Active" <?php if ($row['status'] == "Active") { echo "selected"; } ?>>Active</option>
                      <option value="Inactive" <?php if ($row['status'] == "Inactive") { echo "selected"; } ?>>Inactive</option>

                    </select>
                    <button type="submit" class="btn btn-warning text-black w-100" name="editUser">Update</button>
                    </form>
                </div>
                
              </div>
            </div>
          </div>

          <!-- Delete Modal -->
          <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="deleteModalLabel">Delete User</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="../backend/deleteUser.php">
                    <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                    Are you sure you want to delete this user
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger" name="deleteUser" >Confirm Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Modals for add, edit, and delete -->
  <!-- Add New User Modal -->
  <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="newUserModalLabel">Add new user</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../backend/addUser.php">
            <input class="form-control mb-3" name="fullName" type="text" placeholder="Full Name" required>
            <input class="form-control mb-3" name="email" type="email" placeholder="Email" required>
            <select name="role" class="form-control mb-3">
              <option value="admin" selected>Admin</option>
              <option value="staff">Staff</option>
              <option value="user">User</option>
            </select>

            <button type="submit" name="addUser" class="btn btn-primary text-white w-100">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <div class="toast" role="alert" data-bs-delay="3000" aria-live="assertive" aria-atomic="true" id="liveToast" style="position: absolute; top: 20px; right: 20px;">

    <div class="d-flex align-items-center w-100">

      <div class="toast-body text-danger mb-0">
        <?php
        if (isset($_SESSION['success'])) {
            echo '<p class="mb-0 text-success"><i class="fa-solid fa-circle-check"></i> ' . $_SESSION['success'] . '</p> ';
        }
        else if(isset($_SESSION['error'])){
            echo '<p class="mb-0 text-danger"><i class="fa-solid fa-triangle-exclamation"></i> ' . $_SESSION['error'] . '</p>';
        }
        ?>
      </div>

      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close">
      </button>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])) : ?>
        var toastEl = document.getElementById('liveToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
      <?php endif; ?>
    });
  </script>
  <?php
  unset($_SESSION['success'], $_SESSION['error']);
  ?>
</body>

</html>