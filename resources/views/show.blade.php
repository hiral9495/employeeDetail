<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Employees List</title>
      <!-- Include Bootstrap CSS and DataTables CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
      <!-- Include DatePicker CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
      <!-- Include jQuery and DataTables JS -->
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
      <!-- Include DatePicker JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
   </head>
   <body>
      <div class="container mt-5">
         <div class="row justify-content-center mb-4">
            <div class="col-md-10 text-center">
               <div class="row">
                  <div class="col text-left">
                     <h4>Employees List</h4>
                  </div>
                  <div class="col text-right">
                     <a class="btn btn-primary" href="{{ route('employees.create') }}">Add new Employee</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="row justify-content-center mb-4">
            <div class="col-md-2">
               <input type="text" id="start_date" class="form-control" placeholder="Start Date">
            </div>
            <div class="col-md-2">
               <input type="text" id="end_date" class="form-control" placeholder="End Date">
            </div>
            <div class="col-md-2">
               <button type="button" id="filter" class="btn btn-primary">Filter</button>
               <button type="button" id="clear" class="btn btn-secondary">Clear</button>
            </div>
         </div>
         <div class="row justify-content-center">
            <div class="col-md-10">
               <table class="table table-bordered" id="employeeTable">
                  <thead>
                     <tr>
                        <th>Employee Code</th>
                        <th>Profile Image</th>
                        <th>Full Name</th>
                        <th>Joining Date</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
      <script>
         $(document).ready(function () {
             var table = $('#employeeTable').DataTable({
                 processing: true,
                 serverSide: true,
                 ajax: {
                     url: "{{ route('employees.data') }}",
                     data: function (d) {
                         d.start_date = $('#start_date').val();
                         d.end_date = $('#end_date').val();
                     }
                 },
                 columns: [
                     {data: 'employee_code', name: 'employee_code'},
                     {data: 'profile_image', name: 'profile_image', orderable: false, searchable: false},
                     {data: 'full_name', name: 'full_name'},
                     {data: 'joining_date', name: 'joining_date'}
                 ]
             });
         
             $('#start_date, #end_date').datepicker({
                 format: 'yyyy-mm-dd',
                 autoclose: true,
                 todayHighlight: true
             });
         
             // Filter button click event
             $('#filter').click(function () {
                 table.draw();
             });
         
             // Clear button click event
             $('#clear').click(function () {
                 $('#start_date, #end_date').val("");
                 table.draw();
             });
         });
      </script>
   </body>
</html>
