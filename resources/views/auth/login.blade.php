<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Bengkel</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        /* Custom white & blue styles for bengkel theme */
        body,
        html {
            height: 100%;
            background: #f0f6ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #0d3b66;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(13, 59, 102, 0.2);
            width: 100%;
            max-width: 420px;
            padding: 2rem 2.5rem;
            border: 2px solid #0d3b66;
        }

        .login-card h2 {
            color: #0d3b66;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-control {
            border-radius: 0.5rem;
            border: 1.5px solid #9bb7d4;
            background-color: #f9fbff;
            color: #0d3b66;
            transition: border-color 0.3s ease;
        }

        .form-control::placeholder {
            color: #8aa1be;
            font-weight: 400;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #1e5abf;
            color: #0a2a66;
            box-shadow: 0 0 8px #1e5abf;
            outline: none;
        }
        .btn-login {
            background: #1e5abf;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: #174699;
        }

        .input-group-text {
            background-color: #1e5abf;
            border: none;
            color: #ffffff;
            border-radius: 0.5rem 0 0 0.5rem;
            font-weight: 700;
        }

        .bengkel-icon {
            display: block;
            margin: 0 auto 1.5rem auto;
            font-size: 4rem;
            color: #1e5abf;
        }

        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #516eae;
            user-select: none;
        }

        @media (max-width: 400px) {
            .login-card {
                padding: 1.2rem 1.5rem;
            }

            .login-card h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card shadow">
            <i class="bi bi-wrench-adjustable bengkel-icon" title="Bengkel Icon"></i>
            <h2>Bengkel Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="inputEmail" placeholder="name@example.com" required autocomplete="email" autofocus />
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="inputPassword" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="inputPassword" placeholder="Your password" required
                            autocomplete="current-password" />
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login w-100 py-2 text-white">LogIn</button>
            </form>
            <p class="footer-text">© 2025 Bengkel. All rights reserved.</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
