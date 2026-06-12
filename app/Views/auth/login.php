<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Minimarket</title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<main class="auth-page">
    <section class="panel auth-card">
        <div class="auth-brand">
            <div class="brand-mark">MM</div>
            <div>
                <h1>Login</h1>
                <p class="subtitle">Sistem Penjualan Madura Mart</p>
            </div>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <p class="alert"><?= esc(session()->getFlashdata('error')); ?></p>
        <?php endif; ?>

        <form class="form-grid" action="/login/process" method="post">
            <div class="form-field">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" autocomplete="username" required>
            </div>

            <div class="form-field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" autocomplete="current-password" required>
            </div>

            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </section>
</main>
</body>
</html>
