<!DOCTYPE html>
<html lang="tr" class="flex w-full h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giriş</title>
    @vite('resources/css/app.css')
</head>

<body class="flex items-center flex-1 w-full overflow-x-hidden min-h-full bg-gray-100">
    <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">
        <div class="w-full max-w-md">
            <div class="flex items-center justify-center mt-6">
                <a href="#" class="w-1/3 pb-4 font-medium text-center text-gray-500 capitalize border-b light:border-gray-400 light:text-gray-300" id="btnRegister">
                    Kayıt Ol
                </a>

                <a href="#" class="w-1/3 pb-4 font-medium text-center text-gray-800 capitalize border-b-2 border-blue-500 light:border-blue-400 light:text-white" id="btnLogin">
                    Giriş Yap
                </a>
            </div>

            <form method="POST" action="{{ route('login-post') }}" id="formLogin">
                @csrf
                <div class="relative flex items-center mt-8">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 light:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>

                    <input type="email" name="email" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 light:bg-gray-900 light:text-gray-300 light:border-gray-600 focus:border-blue-400 light:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="E-Posta">
                </div>

                <div class="relative flex items-center mt-6">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 light:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>

                    <input type="password" name="password" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 light:bg-gray-900 light:text-gray-300 light:border-gray-600 focus:border-blue-400 light:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Şifre">
                </div>

                @isset($message)
                    <p class="mt-1 text-center text-gray-500 text-red-500 mt-5">{{ $message }}</p>
                @endisset

                <div class="mt-6">
                    <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Giriş Yap
                    </button>
                </div>
            </form>

            <form id="formRegister" style="display: none" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="relative flex items-center mt-8">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 light:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>

                    <input type="text" name="name" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 light:bg-gray-900 light:text-gray-300 light:border-gray-600 focus:border-blue-400 light:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Adınız">
                </div>

                <div class="relative flex items-center mt-6">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 light:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>

                    <input type="email" name="email" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11 light:bg-gray-900 light:text-gray-300 light:border-gray-600 focus:border-blue-400 light:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="E-Posta Adresi">
                </div>

                <div class="relative flex items-center mt-4">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 light:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>

                    <input type="password" name="password" class="block w-full px-10 py-3 text-gray-700 bg-white border rounded-lg light:bg-gray-900 light:text-gray-300 light:border-gray-600 focus:border-blue-400 light:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Şifre">
                </div>

                <div class="mt-6">
                    <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Kayıt Ol
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('btnRegister').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('formLogin').style.display = 'none';
            document.getElementById('formRegister').style.display = 'block';

            const btnRegister = document.getElementById('btnRegister');
            btnRegister.classList.remove('text-gray-500', 'border-b', 'light:border-gray-400', 'light:text-gray-300');
            btnRegister.classList.add('text-gray-800', 'border-b-2', 'border-blue-500', 'light:border-blue-400', 'light:text-white');

            const btnLogin = document.getElementById('btnLogin');
            btnLogin.classList.remove('text-gray-800', 'border-b-2', 'border-blue-500', 'light:border-blue-400', 'light:text-white');
            btnLogin.classList.add('text-gray-500', 'border-b', 'light:border-gray-400', 'light:text-gray-300');
        });

        document.getElementById('btnLogin').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('formLogin').style.display = 'block';
            document.getElementById('formRegister').style.display = 'none';

            const btnRegister = document.getElementById('btnRegister');
            btnRegister.classList.remove('text-gray-800', 'border-b-2', 'border-blue-500', 'light:border-blue-400', 'light:text-white');
            btnRegister.classList.add('text-gray-500', 'border-b', 'light:border-gray-400', 'light:text-gray-300');

            const btnLogin = document.getElementById('btnLogin');
            btnLogin.classList.remove('text-gray-500', 'border-b', 'light:border-gray-400', 'light:text-gray-300');
            btnLogin.classList.add('text-gray-800', 'border-b-2', 'border-blue-500', 'light:border-blue-400', 'light:text-white');
        });
    </script>
</body>

</html>
