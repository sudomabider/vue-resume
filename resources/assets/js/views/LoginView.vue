<template>
  <div id="login">
    <h1 class="text-xs-center">Login</h1>
    <div class="col-lg-8 offset-lg-2 col-md-1 offset-md-10">
      <transition name="fade-up">
        <div class="alert alert-danger" v-show="authError">
          Invalid credentials
        </div>
      </transition>
      <form class="Login-form" @submit.prevent="login">
        <div class="form-group">
          <input
                  type="email"
                  name="email"
                  class="form-control"
                  v-model="creds.email"
                  placeholder="Email" required>
        </div>
        <div class="form-group">
          <input
                  type="password"
                  name="password"
                  class="form-control"
                  v-model="creds.password"
                  placeholder="Password" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">
            Login
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>

  import auth from '../services/AuthService';

  export default {

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
        //this.creds = { email: '', password: '' };
      },

      showError () {
        this.authError = true;
      },

      hideError () {
        this.authError = false;
      }
    }
  }
</script>