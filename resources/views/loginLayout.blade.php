<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
</head>
<body>

    <nav class="navbar navbar-light navbar-expand-lg mb-5 header-login">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                    
               
                
            </div>
        </div>
      </nav>
      <div class="container mt-5">

@yield('content')

</div>

</body>
</html>
