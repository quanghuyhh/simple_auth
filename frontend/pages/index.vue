<template>
  <div>
    <h1>Dashboard</h1>
    <flash-message />
  </div>
</template>

<script>
import FlashMessage from "~/components/FlashMessage";
export default {
  name: 'DashboardPage',
  components: {FlashMessage},
  layout: 'default',
  head: {
    title: 'Dashboard'
  },
  computed: {
    isLoggedIn() {
      return this.$auth.loggedIn
    }
  },
  mounted() {
    if (!this.isLoggedIn) {
      this.$router.push('/auth/login')
    }
  }
}
</script>
