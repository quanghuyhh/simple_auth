<template>
  <form class="auth-form w-10/12 mx-auto" @submit.prevent="register">
    <validation-observer ref="form">

      <h1 class="text-2xl font-bold leading-6 text-gray-900">Marketplace</h1>
      <h2 class="text-4xl font-bold leading-6 text-gray-900 my-7">Create an account</h2>

      <flash-message/>
      <div class="form-row">
        <label for="display_name" class="form-label text-bold text-primary-100">Name</label>
        <input id="display_name" v-model="user.display_name" type="text" class="form-control" name="display_name"
               placeholder="John Does">
      </div>
      <div class="form-row">
        <validation-provider
          v-slot="{ errors }"
          name="email"
          rules="required|email"
          class=""
        >
          <label for="email" class="form-label">Email</label>
          <input id="email" v-model="user.email" type="email" name="email" class="form-control"
                 placeholder="example@gmail.com" required>
          <span class="input-invalid-message">
              {{ errors[0] }}
          </span>
        </validation-provider>
      </div>
      <div class="form-row grid grid-cols-2 gap-4">
        <div class="form-group">
          <validation-provider
            v-slot="{ errors }"
            name="password"
            rules="required|min:6"
            class=""
            ref="password"
          >
            <label for="password" class="form-label">Password</label>
            <input id="password" v-model="user.password" type="password" name="password" class="form-control" required
                   minlength="6">
            <span class="input-invalid-message">
              {{ errors[0] }}
          </span>
          </validation-provider>
        </div>
        <div class="form-group">
          <validation-provider
            v-slot="{ errors }"
            name="confirm_password"
            rules="required|min:6|confirmed:password"
            class=""
          >
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input id="confirm_password" v-model="user.confirm_password" type="password" name="confirm_password"
                   class="form-control" required minlength="6">
            <span class="input-invalid-message">
              {{ errors[0] }}
          </span>
          </validation-provider>
        </div>
      </div>
      <div class="form-row grid grid-cols-2 gap-4 mt-8">
        <button type="submit" class="btn btn-primary text-uppercase">REGISTER</button>
        <nuxt-link to="/auth/login" class="btn btn-secondary text-uppercase text-center">Sign In</nuxt-link>
      </div>
    </validation-observer>

  </form>
</template>

<script>
import FlashMessage from "~/components/FlashMessage";

export default {
  name: 'AuthRegister',
  components: {FlashMessage},
  layout: 'auth',
  auth: 'guest',
  data() {
    return {
      user: {
        display_name: null,
        email: null,
        password: null,
        confirm_password: null,
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
    async register() {
      if (!await this.$refs.form.validate()) {
        this.$toast.error("Invalid data. Please check and try again!");
        return
      }
      try {
        await this.$axios.post('/api/auth/register', this.user)
        this.$toast.success("Create account successfully!");
        this.$router.push('/auth/login')
      } catch (err) {
        this.$toast.error("Somethings went wrong! Please try again!");
      }
    }
  }
}
</script>
