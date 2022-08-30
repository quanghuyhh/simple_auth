<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        900: '#160647',
                        700: '#862ADE',
                        600: '#6D44FF',
                        500: '#8B6BFF',
                        100: '#9C94B0',
                    },
                    gray: {
                        100: '#F5F4F7',
                    }
                }
            }
        }
    }
</script>
<link rel="stylesheet" href="/assets/css/style.css">
<style type="text/tailwindcss">
    .form-control {
        @apply block w-full rounded-md border-gray-300 shadow-sm;
        @apply focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50;
    }
    .form-row {
        @apply mt-4;
    }
    .btn {
        @apply rounded-md font-bold uppercase text-white;
        @apply px-4 py-3;
        @apply transition ease-in-out duration-150;
        @apply hover:drop-shadow-lg;
    }
    .btn-primary {
        @apply bg-primary-600;
        @apply border-transparent;
        @apply hover:bg-primary-600/80;
    }

    .btn-secondary {
        @apply focus:ring focus:ring-primary-100 border border-primary-100;
        @apply text-primary-900;
        @apply bg-white;
    }
    .form-horizon {

    }
    .sidebar {
        @apply fixed top-0 left-0;
        @apply h-screen;
        @apply w-[110px];
        @apply border border-0 border-r border-gray-200;
    }
    .sidebar .head {
        @apply text-center;
        @apply p-2;
    }
    .nav {
        @apply px-2;
    }
    .nav a img {
        width: 20px;
        height: 20px;
    }
    .nav a {
        @apply flex items-center justify-center flex-col;
        @apply px-4 py-8;
        @apply transition ease-in-out duration-200;
        @apply rounded-lg bg-white;
        @apply hover:drop-shadow-md;
    }

    .topbar {
        @apply w-full px-4 py-3;
        @apply border border-0 border-b border-gray-200;
    }
    .right-bar img {
        @apply inline-block w-[30px] h-[30px];
    }
    .right-bar .auth ul {
        @apply flex items-center;
    }
    .right-bar .auth ul li {
        @apply divide-x divide-gray-400;
    }
    .right-bar .auth ul a {
        @apply text-gray-700 block px-4 py-2 text-sm;
        @apply hover:text-gray-900;
    }
    main {
        @apply pl-[110px];
    }
    .main-content {
        @apply p-4;
    }
</style>