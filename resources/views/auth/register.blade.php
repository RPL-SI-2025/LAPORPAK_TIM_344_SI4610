<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: linear-gradient(to bottom right, rgba(30,30,30,0.8), rgba(44,62,80,0.8));
            z-index: 0;
        }
        .container {
            position: relative;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            display: flex;
            width: 900px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            z-index: 1;
        }
        .form-section {
            flex: 1;
            padding: 40px;
            color: white;
            backdrop-filter: blur(10px);
        }
        .form-section h1 {
            margin-bottom: 10px;
            font-size: 32px;
        }
        .form-section p {
            margin-bottom: 30px;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #555;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            color: white;
            font-size: 14px;
            outline: none;
        }
        .form-group .eye-toggle {
            position: absolute;
            top: 36px;
            right: 15px;
            cursor: pointer;
            color: white;
        }
        .error {
            color: #ff4d4d;
            font-size: 12px;
            margin-top: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            opacity: 0.9;
        }
        .image-section {
            flex: 1;
            background: url('{{ asset('assets/img/daftar1.png') }}') no-repeat center center/cover;
            position: relative;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
            }
            .image-section {
                height: 200px;
            }
        }
    </style>
</head>

<body style="background: url('{{ asset('assets/img/bgl.png') }}') no-repeat center center; background-size: auto;">



<div class="container">
    <div class="form-section">
        <h1>Daftar</h1>
        <p>Sudah punya akun ? <a href="{{ route('login') }}" style="color: #feb47b; text-decoration: none;">Masuk</a></p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                <div id="nameError" class="error"></div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                <div id="emailError" class="error"></div>
            </div>

            <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" id="password">
                <span class="eye-toggle" onclick="togglePassword('password')">&#128065;</span>
                <div id="passwordError" class="error"></div>
            </div>

            <div class="form-group">
                <label>Konfirmasi Kata sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                <span class="eye-toggle" onclick="togglePassword('password_confirmation')">&#128065;</span>
                <div id="confirmPasswordError" class="error"></div>
            </div>

            <button type="submit">Daftar</button>
        </form>
    </div>

    <div class="image-section">
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        field.type = field.type === "password" ? "text" : "password";
    }

    document.getElementById('registerForm').addEventListener('submit', function(event) {
        let valid = true;

        // Clear previous errors
        document.getElementById('nameError').innerText = '';
        document.getElementById('emailError').innerText = '';
        document.getElementById('passwordError').innerText = '';
        document.getElementById('confirmPasswordError').innerText = '';

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        // Check if fields are empty
        if (name === '') {
            document.getElementById('nameError').innerText = 'Name is required.';
            valid = false;
        }
        if (email === '') {
            document.getElementById('emailError').innerText = 'Email is required.';
            valid = false;
        }
        if (password === '') {
            document.getElementById('passwordError').innerText = 'Password is required.';
            valid = false;
        }
        if (confirmPassword === '') {
            document.getElementById('confirmPasswordError').innerText = 'Confirm Password is required.';
            valid = false;
        }

        // Check if password and confirm password match
        if (password !== '' && confirmPassword !== '' && password !== confirmPassword) {
            document.getElementById('confirmPasswordError').innerText = 'Passwords do not match.';
            valid = false;
        }

        if (!valid) {
            event.preventDefault(); // Stop form submission
        }
    });
</script>

</body>
</html>
