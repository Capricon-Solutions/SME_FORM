<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    @yield('datatables-css')
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #3a57e8;
            --primary-dark: #2a41b8;
            --secondary: #5899ff;
            --accent: #6e5deb;
            --light: #f5f9ff;
            --dark: #1e2746;
            --success: #1aa053;
            --warning: #ffc107;
            --danger: #c03221;
            --gray-100: #f8f9fa;
            --gray-200: #eeeeee;
            --gray-300: #e4e4e4;
            --gray-400: #d2d2d2;
            --gray-500: #abafb3;
            --gray-600: #878a99;
            --gray-700: #444b6b;
            --gray-800: #363c50;
            --gray-900: #232532;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(-45deg, #ff3d77, #3a57e8, #12d8fa, #a139fd);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            padding-top: 20px;
            padding-bottom: 20px;
            color: var(--gray-800);
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }
        
        .bg-shapes {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            overflow: hidden;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            animation: float 8s ease-in-out infinite;
        }
        
        .shape-1 {
            background: linear-gradient(45deg, rgba(247, 77, 136, 0.7), rgba(255, 121, 85, 0.7));
            width: 500px;
            height: 500px;
            top: -200px;
            right: -100px;
            animation-delay: 0s;
            animation-name: float-rotate;
        }
        
        .shape-2 {
            background: linear-gradient(45deg, rgba(58, 87, 232, 0.7), rgba(84, 171, 255, 0.7));
            width: 600px;
            height: 600px;
            bottom: -200px;
            left: -200px;
            animation-delay: 2s;
            animation-name: float-rotate-reverse;
        }
        
        .shape-3 {
            background: linear-gradient(45deg, rgba(101, 219, 255, 0.6), rgba(39, 232, 191, 0.6));
            width: 300px;
            height: 300px;
            top: 40%;
            right: 20%;
            animation-delay: 4s;
            animation-name: pulse;
            animation-duration: 10s;
        }
        
        .shape-4 {
            background: linear-gradient(45deg, rgba(255, 188, 87, 0.6), rgba(255, 124, 64, 0.6));
            width: 250px;
            height: 250px;
            top: 20%;
            left: 10%;
            animation-delay: 3s;
            animation-duration: 10s;
            animation-name: float-scale;
        }
        
        .shape-5 {
            background: linear-gradient(45deg, rgba(126, 87, 255, 0.6), rgba(202, 89, 255, 0.6));
            width: 350px;
            height: 350px;
            bottom: 15%;
            right: 5%;
            animation-delay: 1s;
            animation-duration: 12s;
            animation-name: pulse-scale;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-20px) scale(1.05);
            }
            100% {
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes float-rotate {
            0% {
                transform: translateY(0) scale(1) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) scale(1.05) rotate(15deg);
            }
            100% {
                transform: translateY(0) scale(1) rotate(0deg);
            }
        }
        
        @keyframes float-rotate-reverse {
            0% {
                transform: translateY(0) scale(1) rotate(0deg);
            }
            50% {
                transform: translateY(20px) scale(1.05) rotate(-15deg);
            }
            100% {
                transform: translateY(0) scale(1) rotate(0deg);
            }
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 0.6;
            }
        }
        
        @keyframes float-scale {
            0% {
                transform: translateY(0) scale(1);
            }
            33% {
                transform: translateY(-15px) scale(1.1);
            }
            66% {
                transform: translateY(10px) scale(0.95);
            }
            100% {
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes pulse-scale {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }
            33% {
                transform: scale(1.1);
                opacity: 0.8;
            }
            66% {
                transform: scale(0.95);
                opacity: 0.7;
            }
            100% {
                transform: scale(1);
                opacity: 0.6;
            }
        }
        
        .container {
            position: relative;
            z-index: 10;
        }
        
        .form-container {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 16px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
            padding: 30px;
            margin-top: 10px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }
        
        .form-header {
            margin-bottom: 30px;
            text-align: left;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .form-header h2 {
            color: var(--dark);
            font-weight: 600;
        }
        
        .form-header p {
            color: var(--gray-600);
        }
        
        .form-header img {
            max-width: 90px;
            height: auto;
        }
        
        .logo-container {
            background-color: #fff;
            border-radius: 12px;
            padding: 10px;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .logo-container img {
            max-width: 80px;
            height: auto;
            display: block;
        }
        
        .form-check-label {
            cursor: pointer;
        }
        
        .required:after {
            content: " *";
            color: var(--danger);
        }
        
        .form-control {
            padding: 0.65rem 0.85rem;
            border-color: var(--gray-300);
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(58, 87, 232, 0.15);
        }
        
        .form-check {
            padding-left: 1.8rem;
        }
        
        .form-check-input {
            margin-left: -1.8rem;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--gray-700);
        }
        
        .service-option {
            padding: 10px 10px 10px 40px;
            background-color: var(--gray-100);
            border-radius: 8px;
            margin-bottom: 10px !important;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .service-option:hover {
            background-color: rgba(58, 87, 232, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        
        .service-option .form-check-input {
            margin-left: -28px;
            margin-top: 0.3rem;
        }
        
        .service-option .form-check-label {
            font-weight: 500;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(58, 87, 232, 0.3);
        }
        
        .btn-lg {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
        }
        
        .alert-success {
            background-color: rgba(26, 160, 83, 0.15);
            border-color: rgba(26, 160, 83, 0.2);
            color: var(--success);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        @media (max-width: 768px) {
            body {
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            .form-container {
                padding: 20px 15px;
                margin-top: 5px;
                margin-bottom: 15px;
                border-radius: 10px;
            }
            .form-header {
                text-align: center;
                margin-bottom: 20px;
                padding-bottom: 15px;
            }
            .form-header img {
                max-width: 75px;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 15px;
                display: block;
            }
            .logo-container {
                margin: 0 auto;
                padding: 8px;
                border-radius: 10px;
                display: inline-block;
            }
            .form-header h2 {
                font-size: 1.5rem;
                margin-top: 5px;
            }
            .form-header p {
                font-size: 0.9rem;
            }
            .btn-lg {
                padding: 0.5rem 1rem;
                font-size: 1rem;
            }
            .form-label {
                font-size: 0.95rem;
                margin-bottom: 0.25rem;
            }
            .form-control {
                padding: 0.5rem 0.75rem;
                font-size: 0.95rem;
            }
            .form-check-label {
                font-size: 0.95rem;
            }
            .mb-3 {
                margin-bottom: 0.75rem !important;
            }
        }
        @media (max-width: 576px) {
            .form-container {
                padding: 15px 12px;
            }
            .form-header h2 {
                font-size: 1.3rem;
            }
            .form-header p {
                font-size: 0.85rem;
            }
            .form-header img {
                max-width: 65px;
                margin-bottom: 10px;
            }
            .logo-container {
                padding: 6px;
            }
        }
        @media (max-width: 375px) {
            .form-header h2 {
                font-size: 1.2rem;
            }
            .form-header p {
                font-size: 0.8rem;
            }
            .form-header img {
                max-width: 55px;
                margin-bottom: 8px;
            }
            .logo-container {
                padding: 5px;
            }
            .form-container {
                padding: 12px 10px;
            }
            .form-check-label {
                font-size: 0.9rem;
            }
        }
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>
<body>
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>
    <div id="app">
        <main class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    @yield('datatables-js')

    @yield('scripts')
</body>
</html> 