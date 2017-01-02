<template>
    <div id="app">
        <HeaderComponent />

        <main class="container">
            <transition name="slide-fade" mode="out-in">
                <div :key="routename">
                    <router-link :to="{ name: 'home' }" class="btn btn-light btn-block mb-1" v-if="!homepage">
                        <i class="fa fa-arrow-left"></i> Go Back
                    </router-link>
                    <keep-alive>
                        <router-view></router-view>
                    </keep-alive>
                </div>
            </transition>
        </main>
        <br>
        <div class="jumbotron" style="padding:2rem;">
            <div class="container ubuntu-mono">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-xs-center" style="margin-bottom:1rem;">GET IN TOUCH</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-lg-2 col-lg-8">
                        <ContactForm />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import auth from '../services/AuthService'
  import Header from './Header.vue'
  import ContactForm from '../components/ContactForm.vue'

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
      },

      currentYear() {
        return new Date().getFullYear();
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
      'HeaderComponent': Header,
      ContactForm
    }
  };

  export default App
</script>

<style>
    /* fade-enter */
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s
    }
    .fade-enter, .fade-leave-active {
        opacity: 0
    }

    /* slide-fade */
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

    /* slide-down-fade */

    .slide-down-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-down-fade-leave-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-down-fade-enter, .slide-down-fade-leave-active {
        transform: translateY(20px);
        opacity: 0;
    }

    /* fade-up */
    .fade-up-leave-active {
        transition: all .3s ease;
    }

    .fade-up-enter-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .fade-up-enter {
        height: 0;
        opacity: 0;
    }

    .fade-up-leave-active {
        opacity: 0;
    }

    /* list */
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