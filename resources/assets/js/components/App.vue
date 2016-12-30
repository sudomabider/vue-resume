<template>
    <div id="app">
        <HeaderComponent />
        <main class="container">
            <transition name="out-in">
                <keep-alive>
                    <router-view></router-view>
                </keep-alive>
            </transition>
        </main>
        <!--<footer>-->
            <!--<ul class="nav nav-pills">-->
                <!--<li class="" v-if="!user.authenticated">-->
                    <!--<router-link :to="{ name: 'login' }">Login</router-link>-->
                <!--</li>-->
                <!--<li class="" v-if="user.authenticated">-->
                    <!--<router-link to="" @click.prevent="logout">Logout</router-link>-->
                <!--</li>-->
            <!--</ul>-->
        <!--</footer>-->
    </div>
</template>

<script>
  import auth from '../services/AuthService';
  import Header from './Header.vue'

  const App = {
    mounted () {
      this.user = auth.user;
    },

    data () {
      return {
        breadcrumbs: [],
        modalIsOpen: false,
        user: {}
      }
    },

    methods: {
      showModal () {
        this.modalIsOpen = true;
      },

      logout () {
        auth.logout();
      }
    },

    components: {
      'HeaderComponent': Header
    }
  };

  export default App
</script>