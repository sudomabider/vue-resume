<template>
    <div class="jumbotron text-xs-center">
        <router-link :to="{ name: 'home' }" tag="div" style="cursor: pointer">
            <h1>
                {{userName}}<span v-if="altName"> - <small>{{altName}}</small></span>
            </h1>
        </router-link>
        <p>Full stack web developer specializing in <Rotator :values="rotation" /></p>
        <div class="text-muted text-uppercase ubuntu-mono">
            <transition name="slide-fade" mode="out-in">
                <router-link :to="{ name: 'login'}" v-if="!$root.authenticated">
                    <i class="fa fa-sign-in"></i> Myself? Login!
                </router-link>
                <a href="#" @click.prevent="logout" v-else>
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </transition>
        </div>
    </div>
</template>

<script>
    import Rotator from './Rotator.vue'
    import auth from '../services/AuthService'

    const header = {
      template: ``
    };

    export default {
      data() {
        return {
          rotation: ['Laravel', 'Bootstrap', 'VueJS', 'ReactJS']
        }
      },

      computed: {
        userName() {
          return window.userName;
        },
        altName() {
          return window.altName;
        }
      },

      components: {
        Rotator
      },

      methods: {
        logout() {
          auth.logout();
        }
      }
    };
</script>