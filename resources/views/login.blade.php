<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Sans:wght@300;400;700&family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

<div class="dark-overlay"></div>

<div class="container content-wrapper">

    <div class="row align-items-center">
        
        <div class="col-md-6 text-white">

            <div class="d-flex align-items-center" style="gap: 12px;">
                <div class="logo-container">
                    <img src="/img/logo-wbi.png" width="100" alt="">
                </div>

                <div class="logo-container">
                    <img src="/img/logo-kampus-merdeka.png" width="100" alt="">
                </div>
            </div>

            <div class="text-group mt-3">
                <h2 class="left-title">Portal Mahasiswa</h2>

                <h1 class="wbi-title text-white">Politeknik WBI</h1>
                <div class="divider-half"></div>

                <p>Silahkan Login Dengan Akun Anda</p>
            </div>

        </div>
        

        <div class="col-md-5">
            <div class="login-box shadow">
                <h2 class="wbi-title text-center mb-2">Sign In</h2>
                <p class="text-center mb-4">Masuk Ke Portal Mahasiswa</p>
                <form method="POST" action="/login">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email/Username</label>
                        <input type="text" name="email" class="form-control" placeholder="EmailKampus@wbi.ac.id">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                    </div>

                    <button type="submit" class="btn btn-login text-white w-100 py-2 mt-3">
                        SIGN IN
                    </button>

                </form>
            </div>
        </div>

    </div>
    
</div>
<p class="footer-bottom">
    2025 Bagian Teknologi Informasi Politeknik Wilmar Bisnis Indonesia
</p>


</body>
</html>
