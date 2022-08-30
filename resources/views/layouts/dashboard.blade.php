<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    @include('components.custom-style')
</head>
<body>

<div class="w-full">
    <div class="sidebar">
        <div class="head">
            <a href="/" class="block mx-auto text-center"><img src="/assets/images/logo.svg" alt="" class="inline-block"></a>
        </div>
        <div class="nav">
            <ul>
                <li>
                    <a href="#"><img src="/assets/images/icon/home.svg" alt=""> <span>Home</span></a>
                </li>
                <li>
                    <a href="#"><img src="/assets/images/icon/bolt.svg" alt=""> <span>News</span></a>
                </li>
                <li>
                    <a href="#"><img src="/assets/images/icon/order.svg" alt=""> <span>Orders</span></a>
                </li>
                <li>
                    <a href="#"><img src="/assets/images/icon/chat.svg" alt=""> <span>Chats</span></a>
                </li>
                <li>
                    <a href="#"><img src="/assets/images/icon/setting.svg" alt=""> <span>Settings</span></a>
                </li>
            </ul>
        </div>
    </div>
    <main>
        <div class="topbar">
            <div class="wrapper flex flex-row justify-between">
                <div class="search">
                    <input type="text" placeholder="Type here..." class="form-control mt-0">
                </div>
                <div class="right-bar">
                    <div class="auth">
                        <ul>
                            <li>
                                <a href="/my-profile"><img src="/assets/images/icon/profile.svg" alt=""> <span>My profile</span></a>
                            </li>
                            <li>
                                <a href="#" class="logoutBtn">
                                    <img src="/assets/images/icon/logout.svg" alt="">
                                    <form action="/logout" method="POST" id="logout"></form>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </main>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.logoutBtn').on('click', function (e) {
            e.preventDefault();
            $('#logout').submit();
        });
    });
</script>
@stack('footer')
</body>
</html>