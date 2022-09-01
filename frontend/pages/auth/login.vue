<template>
  <form class="auth-form w-10/12 mx-auto" @submit.prevent="userLogin">
    <h1 class="text-2xl font-bold leading-6 text-gray-900">Marketplace</h1>
    <h2 class="text-4xl font-bold leading-6 text-gray-900 my-7">Login your account</h2>

    <flash-message />

    <div class="form-row">
      <label for="email" class="form-label">Email</label>
      <input id="email" v-model="login.email" type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
    </div>
    <div class="form-row">
      <label for="password" class="form-label">Password</label>
      <input id="password" v-model="login.password" type="password" name="password" class="form-control" placeholder="" required minlength="6">
    </div>
    <div class="form-row grid grid-cols-2 gap-4 mt-8">
      <button type="submit" class="btn btn-primary uppercase">Sign In</button>
      <nuxt-link to="/auth/register" class="btn btn-secondary uppercase text-center">REGISTER</nuxt-link>
    </div>
  </form>
</template>

<script>
import FlashMessage from "~/components/FlashMessage";
export default {
  name: 'AuthLogin',
  components: {FlashMessage},
  layout: 'auth',
  auth: 'guest',
  data() {
    return {
      login: {
        email: '',
        password: ''
      }
    }
  },
  computed: {
    isLoggedIn() {
      return this.$auth.loggedIn
    }
  },
  mounted() {
    if (this.isLoggedIn) {
      this.$router.push('/')
    }
  },
  methods: {
    async userLogin() {
      try {
        await this.$auth.loginWith('local', { data: this.login })
        this.$toast.success("Login successfully!");
        await this.$router.push('/')
      } catch (err) {
        this.$toast.error("Fail to login!");
      }
    }
  }
}
</script>
