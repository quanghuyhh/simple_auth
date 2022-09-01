<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('components.custom-style')
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/vue-router@4"></script>
</head>
<body>
    <div id="app">
        <h1>Hello App!</h1>
        <p>
            <!-- use the router-link component for navigation. -->
            <!-- specify the link by passing the `to` prop. -->
            <!-- `<router-link>` will render an `<a>` tag with the correct `href` attribute -->
            <router-link to="/">Go to Home</router-link>
            <router-link to="/about">Go to About</router-link>
        </p>
        <!-- route outlet -->
        <!-- component matched by the route will render here -->
        <router-view></router-view>
    </div>

<script type="text/javascript">
    // 1. Define route components.
    // These can be imported from other files
    const Home = { template: '<div>Home</div>' }
    const About = { template: '<div>About</div>' }

    // 2. Define some routes
    // Each route should map to a component.
    // We'll talk about nested routes later.
    const routes = [
        { path: '/', component: Home },
        { path: '/about', component: About },
    ]

    // 3. Create the router instance and pass the `routes` option
    // You can pass in additional options here, but let's
    // keep it simple for now.
    const router = VueRouter.createRouter({
        // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
        history: VueRouter.createWebHistory(),
        routes, // short for `routes: routes`
    })

    // 5. Create and mount the root instance.
    const app = Vue.createApp({})
    // Make sure to _use_ the router instance to make the
    // whole app router-aware.
    app.use(router)

    app.mount('#app')
</script>
</body>
</html>