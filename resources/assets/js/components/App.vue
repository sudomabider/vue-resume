<template>
    <div id="app">
        <HeaderComponent />

        <main class="container">
            <transition name="slide-fade" mode="out-in">
                <div :key="routename">
                    <router-link :to="{ name: 'home' }" class="btn btn-info btn-block mb-1" v-if="!homepage">
                        <i class="fa fa-arrow-left"></i> Go Back
                    </router-link>
                    <keep-alive>
                        <router-view></router-view>
                    </keep-alive>
                </div>
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
  import auth from '../services/AuthService'
  import Header from './Header.vue'

  const App = {
    mounted () {
      this.user = auth.user;
    },

    data () {
      return {
        modalIsOpen: false,
        user: {}
      }
    },

    computed: {
      homepage () {
        return this.$route.name === 'home';
      },

      routename() {
        return this.$route.name;
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

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s
    }
    .fade-enter, .fade-leave-active {
        opacity: 0
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-active {
        transform: translateX(20px);
        opacity: 0;
    }

    .list-enter-active, .list-leave-active {
        transition: all .2s;
    }
    .list-enter, .list-leave-active {
        opacity: 0;
        transform: translateY(-30px);
    }

    h1 {
        font-family: 'Ubuntu Mono', sans-serif;
        text-transform: uppercase;
    }
</style>