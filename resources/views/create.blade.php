<!-- resources/views/employees/create.blade.php -->
<!DOCTYPE html>
<html>
   <head>
      <title>Create Employee</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container mt-5">
      <div class="row justify-content-center mb-4">
      <div class="col-md-10">
         <h4>Create New Employee</h4>
         <div id="successMessage" class="mt-3 alert alert-success" style="display:none;">
            Employee created successfully!
         </div>
         <form id="employeeForm" enctype="multipart/form-data">
            <div class="row">
               <div class="form-group col-md-6">
                  <label for="employee_code">Employee Code:</label>
                  <input type="text" name="employee_code" id="employee_code" class="form-control" value="" readonly>
               </div>
               <div class="form-group col-md-6">
                  <label for="first_name">First Name:</label>
                  <input type="text" name="first_name" class="form-control">
                  <span class="text-danger" id="firstError"></span>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-6">
                  <label for="last_name">Last Name:</label>
                  <input type="text" name="last_name" class="form-control" required>
                  <span class="text-danger" id="lastError"></span>
               </div>
               <div class="form-group col-md-6">
                  <label for="joining_date">Joining Date:</label>
                  <input type="date" name="joining_date" id="joining_date" class="form-control">
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-6">
                  <label for="profile_image">Profile Image (Max 2MB):</label>
                  <input type="file" name="profile_image" class="form-control">
                  @if($errors->has('profile_image'))
                  <span class="text-danger">{{ $errors->first('profile_image') }}</span> @endif
               </div>
            </div>
            <button type="submit" class="btn btn-primary">Create Employee</button>
         </form>
</div>
</div>
      </div>
      <script>
         $(document).ready(function() {
             generateCode();
             setDefaultDate();
             $('#employeeForm').submit(function(e) {
                 e.preventDefault();
                 var formData = new FormData(this);

                 $.ajax({
                     url: "{{ route('employees.store') }}",
                     method: 'POST',
                     data: formData,
                     contentType: false,
                     processData: false,
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     success: function(response) {
                         $('#successMessage').show();
                         $('#employeeForm')[0].reset();
                         generateCode();
                         window.location.href = "{{ route('employees.table') }}";
                     },
                     error: function(response) {
                        let errors = response.responseJSON.errors;
                        $('#firstError').text(errors.first_name ? errors.first_name[0] : '');
                     }
                 });
             });
         });
         function generateCode() {
             $.ajax({
                     url: "{{ route('employees.generateCode') }}",
                     method: 'GET',
                     success: function(response) {
                         $('#employee_code').val(response.employee_code);
                     },
                     error: function(response) {
                         alert('An error occurred while generating the employee code.');
                     }
                 });
         }
         function setDefaultDate() {
             var today = new Date();
             var day = ("0" + today.getDate()).slice(-2);
             var month = ("0" + (today.getMonth() + 1)).slice(-2);
             var year = today.getFullYear();
         
             var formattedDate = year + "-" + month + "-" + day;
         
             $('#joining_date').val(formattedDate);
         }
      </script>
   </body>
</html>