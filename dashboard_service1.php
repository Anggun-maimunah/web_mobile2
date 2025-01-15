<!-- Admin Dashboard for Services -->
<div class="container py-5">
    <h2 class="text-center">Admin Dashboard</h2>
    <!-- Form to Add New Service -->
    <div class="mb-4">
        <h3>Add New Service</h3>
        <form action="add_service.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Service Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="read_more_link" class="form-label">Read More Link</label>
                <input type="url" class="form-control" id="read_more_link" name="read_more_link" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Service</button>
        </form>
    </div>

    <!-- List of Existing Services with Delete Option -->
    <h3>Existing Services</h3>
    <div class="list-group">
        <?php
        // Fetch all services from database
        include('db_connect.php'); // Database connection
        $query = "SELECT * FROM services";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="list-group-item d-flex justify-content-between align-items-center">';
                echo '<h5>' . $row['name'] . '</h5>';
                echo '<a href="delete_service.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>';
                echo '</div>';
            }
        } else {
            echo '<p>No services available</p>';
        }
        ?>
    </div>
</div>
