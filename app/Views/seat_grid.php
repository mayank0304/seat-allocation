<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Allocation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Seat Allocation</h1>

        <!-- Flash Message -->
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-info">
                <?php echo session()->getFlashdata('message'); ?>
            </div>
        <?php endif; ?>

        <!-- Seat Allocation Form -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <form action="/allocate-seat" method="post" class="d-flex">
                    <div class="input-group">
                        <span class="input-group-text" id="roll_number_label">Roll Number</span>
                        <input type="text" class="form-control" id="roll_number" name="roll_number" required>
                        <button type="submit" class="btn btn-primary">Allocate Seat</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Clear All Seats Button -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-6 text-center">
                <form action="/clear-all-seats" method="post">
                    <button type="submit" class="btn btn-danger">Clear All Seats</button>
                </form>
            </div>
        </div>

        <!-- Classroom Seat Grid -->
        <h2 class="text-center mb-4">Classroom Seat Grid</h2>
        <div class="row row-cols-6 g-3 justify-content-center">
            <?php foreach ($seats as $seat): ?>
                <div class="col-auto">
                    <div class="seat text-center <?php echo $seat['is_assigned'] == 1 ? 'bg-danger text-white' : 'bg-success text-white'; ?> p-3 rounded-3">
                        <?php echo $seat['is_assigned'] == 1 ? "Roll: " . $seat['roll_number'] : "Seat " . $seat['seat_number']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
