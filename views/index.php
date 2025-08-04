<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light">
    <div style="height: 100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 my-auto mx-auto">
                <div class="card-header bg-white border-0 py-3">
                    <h1 class="text-center">LOGIN</h1>
                </div>

                <div class="card-body">
                    <form action="../actions/login.php" method="post">
                        <!-- Bold to add emphasis -->
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Username</label>
                            <input type="text" name="username" id="username" class="form-control fw-bold" placeholder="USERNAME" autofocus>
                        </div>

                        <div class="mb-5">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="PASSWORD" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Log in</button>
                    </form>

                    <p class="text-center mt-3 small"><a href="register.php">Create an account</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>