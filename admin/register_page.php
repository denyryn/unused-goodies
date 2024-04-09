<?php
    session_start();
    include("./php/register.php");
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ref/css/styles.css">
    <link rel="stylesheet" href="../ref/css/tailwind.min.css">
    <link rel="stylesheet" href="../ref/css/extended.css">
    <title>Signup</title>
</head>
<body class=" bg-purple-50">
    
    <div class="min-h-screen hero bg-base-200">
        <div class="flex-col hero-content lg:flex-row-reverse">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Signup as Admin now!</h1>
                <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
            </div>
            <div class="w-full max-w-sm shadow-2xl card shrink-0 bg-base-100">
                <form class="card-body" action="./php/register.php" method="post">
                    <div class="form-control">
                        <label for="username" class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input name="username" type="text" placeholder="username" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label for="password" class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input name="password" type="password" placeholder="password" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label for="confirm_password" class="label">
                            <span class="label-text">Confirm Password</span>
                        </label>
                        <input name="confirm_password" type="password" placeholder="password" class="input input-bordered" required />
                    </div>
                    <p class="p-1 text-xs">Already have an account?<a class="m-1 hover:underline" href="../dist/login_page.php">Login here</a>.</p>
                    <div class="mt-6 form-control">
                        <button class="bg-black border-black btn btn-primary hover:bg-white hover:text-black hover:border-black">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <script src="../ref/js/sweetalert.js"></script>

</body>
</html>