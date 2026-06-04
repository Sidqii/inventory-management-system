<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Authentication your data</h1>

    <form action="{{ route('login') }}" method="post">
        @csrf

        <div>
            <label for="email">Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Input your email">

            @error('email')
            {{ $message }}
            @enderror
        </div>

        <br>

        <div>
            <label for="password">Password</label>

            <input type="password" name="password" placeholder="Input your password">

            @error('password')
            {{ $message }}
            @enderror
        </div>

        <br>

        <button type="submit">Login</button>
    </form>
</body>

</html>