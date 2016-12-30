<template>
  <div class="login-view">
    <div class="Login-alert" v-show="authError" transition="fade">
      Wrong email / password combination
    </div>
    <h1 class="Login-title">Login</h1>
    <form class="Login-form" @submit.prevent="login">
      <input
        type="email"
        name="email"
        class="Login-form__input"
        v-model="creds.email"
        placeholder="Email" required>
      <input
        type="password"
        name="password"
        class="Login-form__input"
        v-model="creds.password"
        placeholder="Password" required>
      <button type="submit" class="Button Login-form__button">
        Login
      </button>
    </form>
  </div>
</template>

<script>

  import auth from '../services/AuthService';

  const LoginView = {

    data () {
      return {
        creds: {
          email: '',
          password: ''
        },
        authError: false
     }
    },

    methods: {
      login () {
        auth.login(this, this.creds);
        this.creds = { email: '', password: '' };
      },

      showError () {
        this.authError = true;
      },

      hideError () {
        this.authError = false;
      }
    },

    route: {
      activate () {
        this.$root.breadcrumbs = [];
        this.hideError();
      }
    }
  };

  export default LoginView
</script>