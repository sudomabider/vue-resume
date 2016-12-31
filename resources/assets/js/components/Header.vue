<template>
    <div class="jumbotron text-xs-center">
        <router-link :to="{ name: 'home' }" tag="div" style="cursor: pointer">
            <h1>
                Veo Chen - <small>陈禹松</small>
            </h1>
        </router-link>
        <p>Full stack web developer specializing in <Rotator :values="rotation" /></p>

    </div>
</template>

<script>
    import Rotator from './Rotator.vue'

    export default {
      data() {
        return {
          rotation: ['Laravel', 'Bootstrap', 'VueJS', 'ReactJS']
        }
      },

      components: {
        Rotator
      }
    };
</script>