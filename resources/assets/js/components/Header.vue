<template>
    <div class="jumbotron text-xs-center">
        <router-link :to="{ name: 'home' }" tag="h1" style="cursor: pointer">
            Resume <small>with vue.js</small>
        </router-link>
        <p>Full stack web developer and a  <Rotator :values="rotation" /></p>

    </div>
</template>

<script>
    import Rotator from './Rotator.vue'

    export default {
      data() {
        return {
          rotation: ['gamer', 'musician', 'motherfucker', 'meatlover']
        }
      },

      components: {
        Rotator
      }
    };
</script>