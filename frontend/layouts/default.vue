<template>
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
                  <nuxt-link to="/profile"><img src="/assets/images/icon/profile.svg" alt=""> <span>My profile</span></nuxt-link>
                </li>
                <li>
                  <a href="javascript:void(0);" class="logoutBtn" @click.prevent="logout">
                    <img src="/assets/images/icon/logout.svg" alt="">
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="main-content">
        <Nuxt />
      </div>
    </main>

  </div>
</template>

<script>
export default {
  name: 'DefaultLayout',
  methods: {
    async logout() {
      await this.$auth.logout()
      await this.$router.push('/auth/login')
    }
  }
}
</script>

