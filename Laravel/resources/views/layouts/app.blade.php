<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Car Rental Admin</title>
    <!-- Ви можете підключити тут Bootstrap через CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Car Rental</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('car-categories.index') }}">Категорії</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cars.index') }}">Автомобілі</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('clients.index') }}">Клієнти</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('rentals.index') }}">Оренди</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('payments.index') }}">Оплати</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

<!-- Optional: підключити JS для Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
