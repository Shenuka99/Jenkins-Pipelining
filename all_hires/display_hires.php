<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Hire Records</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 30px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .modal-body {
            padding: 20px;
        }
    </style>
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container mt-5">
    <div class="table-container">
        <h2 class="text-center">Taxi Hire Records 2</h2>


        <div class="mb-3 text-center">
            <button id="filterButton" class="btn btn-primary">Show Hires Greater Than 5 Km</button>
            <button id="showAllButton" class="btn btn-secondary ml-2">Show All Hires</button>
        </div>

        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Hire ID</th>
                    <th>Start Location (Lat, Lon)</th>
                    <th>End Location (Lat, Lon)</th>
                    <th>Distance (Km)</th>
                    <th>Hire Amount</th>
                    <th>Customer Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="hiresTable">
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Customer Phone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updatePhoneForm">
                    <input type="hidden" id="updateHireId">
                    <div class="form-group">
                        <label for="newPhone">New Phone Number</label>
                        <input type="text" class="form-control" id="newPhone" placeholder="Enter new phone number" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Phone</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {

        loadHires();


        $('#filterButton').on('click', function() {
            loadHires('filter'); 
        });


        $('#showAllButton').on('click', function() {
            loadHires(); 
        });


        $('#updateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var hireId = button.data('hireid');
            var phone = button.data('phone');

            var modal = $(this);
            modal.find('#updateHireId').val(hireId);
            modal.find('#newPhone').val(phone);
        });

        $('#updatePhoneForm').on('submit', function (event) {
            event.preventDefault();
            var hireId = $('#updateHireId').val();
            var newPhone = $('#newPhone').val();

            $.ajax({
                url: 'update_phone.php',
                type: 'POST',
                data: { hire_id: hireId, customer_phone: newPhone },
                success: function (response) {
                    $('#phone-' + hireId).text(newPhone);
                    $('#updateModal').modal('hide');
                },
                error: function () {
                    alert('Failed to update phone number');
                }
            });
        });

        
        function loadHires(mode = '') {
            var url = mode === 'filter' ? './get_long_hires.php' : './get_all_hires.php';
            
            $.ajax({
                url: url, // Use the appropriate API endpoint
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var rows = '';
                    $.each(response, function(index, hire) {
                        rows += `
                            <tr>
                                <td>${hire.hire_id}</td>
                                <td>${hire.start_lat}, ${hire.start_lon}</td>
                                <td>${hire.end_lat}, ${hire.end_lon}</td>
                                <td>${hire.distance}</td>
                                <td>${hire.hire_amount}</td>
                                <td id="phone-${hire.hire_id}">${hire.customer_phone}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal' data-hireid='${hire.hire_id}' data-phone='${hire.customer_phone}'>Update Phone</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#hiresTable').html(rows);
                },
                error: function(xhr, status, error) {
                    alert('Failed to fetch hires: ' + error);
                }
            });
        }
    });
</script>

</body>
</html>
