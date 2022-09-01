<template>
  <div>
    <h1>My profile</h1>

    <div class="profile-form w-2/3 mx-auto">

      <flash-message/>

      <form enctype="multipart/form-data" @submit.prevent="updateProfile">
        <validation-observer ref="form">
          <div class="form-row">
            <label class="block text-sm font-medium text-gray-700">Photo</label>
            <div class="mt-1 flex items-center">
            <span class="inline-block h-28 w-28 overflow-hidden rounded-full bg-gray-100">
              <img
                id="avatar-img"
                ref="avatarCover"
                :src="currentUser?.avatar | api_photo"
                alt="" class="avatar-img"
              />
            </span>
              <label
                for="avatar"
                class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              >
                <input id="avatar" type="file" accept="image/*" name="avatar" class="hidden opacity-0"
                       @change="changeAvatar"/> Change
              </label>
            </div>
          </div>
          <div class="form-row">
            <label for="display_name" class="form-label text-bold text-primary-100">Name</label>
            <input
              id="display_name"
              v-model="user.display_name"
              type="text"
              class="form-control"
              name="display_name"
              placeholder="John Does"
              autocomplete="false"
            />
          </div>
          <div class="form-row">
            <label for="email" class="form-label">Email</label>
            <input
              id="email"
              v-model="user.email"
              type="text"
              name="email"
              class="form-control opacity-50"
              placeholder="example@gmail.com"
              disabled
              readonly
            />
          </div>
          <div class="form-row grid grid-cols-2 gap-4">
            <div class="form-group">
              <validation-provider
                v-slot="{ errors }"
                name="password"
                class=""
                ref="password"
              >
                <label for="password" class="form-label">Password</label>
                <input id="password" v-model="user.password" type="password" name="password" class="form-control"
                       autocomplete="false" minlength="6"/>
                <span class="input-invalid-message">
                  {{ errors[0] }}
                </span>
              </validation-provider>
            </div>
            <div class="form-group">
              <validation-provider
                v-slot="{ errors }"
                name="confirm_password"
                rules="confirmed:password"
                class=""
              >
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input
                  id="confirm_password"
                  v-model="user.confirm_password"
                  type="password"
                  name="confirm_password"
                  class="form-control"
                  minlength="6"
                />
              <span class="input-invalid-message">
                  {{ errors[0] }}
              </span>
              </validation-provider>
            </div>
          </div>
          <div class="form-row text-center">
            <button class="btn btn-primary text-uppercase inline-block">Update Profile</button>
          </div>
      </form>
    </div>
  </div>
</template>

<script>
import Vue from 'vue';
import FlashMessage from "~/components/FlashMessage";

export default {
  name: 'AuthProfile',
  components: {FlashMessage},
  layout: 'default',
  data() {
    return {
      user: {
        email: '',
        display_name: null,
        password: null,
        confirm_password: null
      },
      avatar: null
    }
  },
  head: {
    title: 'Update Profile'
  },
  computed: {
    isLoggedIn() {
      return this.$auth.loggedIn
    },
    currentUser() {
      return this.$auth.user || {}
    }
  },
  mounted() {
    if (!this.isLoggedIn) {
      this.$router.push('/auth/login')
    }
    this.initData()
  },
  methods: {
    initData() {
      Vue.set(this.user, 'email', this.currentUser.email)
      Vue.set(this.user, 'display_name', this.currentUser.display_name)
      Vue.set(this.user, 'avatar_url', this.currentUser.avatar_url)
    },
    changeAvatar(event) {
      const files = event.target.files;
      if (!files.length) {
        this.refs.avatarCover.src = '/assets/images/default-avatar.svg'
        return
      }
      const selectedFile = files[0];
      this.avatar = selectedFile;
      const reader = new FileReader();

      const imgtag = document.getElementById("avatar-img");
      imgtag.title = selectedFile.name;

      reader.onload = function (event) {
        imgtag.src = event.target.result;
      };

      reader.readAsDataURL(selectedFile);
    },
    async updateProfile() {
      if (!await this.$refs.form.validate()) {
        this.$toast.error("Invalid data. Please check and try again!");
        return
      }
      const formData = new FormData()

      if (this.avatar) {
        formData.append('avatar', this.avatar)
      }
      Object.keys(this.user).forEach((key) => {
        if (!this.user[key]) {
          return;
        }
        formData.append(key, this.user[key])
      })
      await this.$axios.post('/api/profile', formData)
        .then(() => this.$toast.success("Update profile successfully!"))
        .catch(() => this.$toast.error("Somethings went wrong!. Please try again."))
    }
  },
  filters: {
    api_photo(path) {
      if (!path || path.includes(process.env.API_ROOT_URL)) {
        return path
      }
      return process.env.API_ROOT_URL + '/' + path
    }
  }
}
</script>
