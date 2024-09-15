<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Hire Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include '../navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Fetch Hire Details</h2>

    
        <form id="hireForm">
            <div class="form-group row">
                <label for="hireId" class="col-sm-2 col-form-label">Hire ID:</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="hireId" placeholder="Enter Hire ID" required>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Fetch Details</button>
                </div>
            </div>
        </form>

    
        <div id="hireDetails" class="mt-4" style="display: none;">
            <h4>Hire Details</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Hire ID</th>
                    <td id="displayHireId"></td>
                </tr>
                <tr>
                    <th>Start Location (Lat, Lon)</th>
                    <td id="displayStartLocation"></td>
                </tr>
                <tr>
                    <th>End Location (Lat, Lon)</th>
                    <td id="displayEndLocation"></td>
                </tr>
                <tr>
                    <th>Distance (Km)</th>
                    <td id="displayDistance"></td>
                </tr>
                <tr>
                    <th>Hire Amount</th>
                    <td id="displayHireAmount"></td>
                </tr>
                <tr>
                    <th>Customer Phone</th>
                    <td id="displayCustomerPhone"></td>
                </tr>
            </table>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    <script>
        $(document).ready(function() {
            $('#hireForm').on('submit', function(event) {
                event.preventDefault();
                
                var hireId = $('#hireId').val();
                

                $.ajax({
                    url: './get_hire.php', 
                    type: 'POST',
                    data: { hire_id: hireId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#displayHireId').text(response.data.hire_id);
                            $('#displayStartLocation').text(response.data.start_lat + ', ' + response.data.start_lon);
                            $('#displayEndLocation').text(response.data.end_lat + ', ' + response.data.end_lon);
                            $('#displayDistance').text(response.data.distance);
                            $('#displayHireAmount').text(response.data.hire_amount);
                            $('#displayCustomerPhone').text(response.data.customer_phone);
                            $('#hireDetails').show();
                        } else {
                            alert('No hire details found for the given Hire ID.');
                            $('#hireDetails').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Failed to fetch hire details: ' + error);
                    }
                });
            });
        });
    </script>
</body>
</html>
