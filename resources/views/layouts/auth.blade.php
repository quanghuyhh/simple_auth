<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('components.custom-style')
</head>
<body>
<div class="w-full">
    <div class="grid grid-cols-2 min-h-screen">
        <div class="col flex flex-row items-center justify-center">
            <img src="/assets/images/auth-signup.png" alt="" class="">
        </div>
        <div class="col flex flex-row items-center ">
            <div class="flex items-center w-full flex-col">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@stack('footer')
</body>
</html>