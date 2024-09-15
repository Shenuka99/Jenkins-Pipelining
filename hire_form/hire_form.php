<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Hire Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-group label {
            font-size: 14px;
        }
        .form-control {
            font-size: 14px;
        }
    </style>
</head>
<body>
<?php include '../navbar.php'; ?>

<div class="container">
    <div class="form-container">
        <h4 class="text-center">Taxi Hire Form</h4>
        <form id="hireForm">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start_lat">Start Location Latitude</label>
                    <input type="text" class="form-control" id="start_lat" name="start_lat" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="start_lon">Start Location Longitude</label>
                    <input type="text" class="form-control" id="start_lon" name="start_lon" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="end_lat">End Location Latitude</label>
                    <input type="text" class="form-control" id="end_lat" name="end_lat" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="end_lon">End Location Longitude</label>
                    <input type="text" class="form-control" id="end_lon" name="end_lon" required>
                </div>
            </div>
            <div class="form-group">
                <label for="distance">Distance (Km)</label>
                <input type="number" class="form-control" id="distance" name="distance" required>
            </div>
            <div class="form-group">
                <label for="hire_amount">Hire Amount</label>
                <input type="number" class="form-control" id="hire_amount" name="hire_amount" required>
            </div>
            <div class="form-group">
                <label for="customer_phone">Customer Phone</label>
                <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
            <div id="notification" class="alert alert-success mt-3" style="display:none;">
                Hire information submitted successfully!
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#hireForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'process_hire.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#notification').show();
                    $('#hireForm')[0].reset();
                }
            });
        });
    });
</script>

</body>
</html>
