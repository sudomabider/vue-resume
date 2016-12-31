<template>
    <transition name="slide-fade" mode="out-in">
        <span :key="key">
            <span class="rotator ubuntu-mono">{{ value }}</span>
        </span>
    </transition>
</template>

<script>
  const Rotator = {
    props: ['values'],

    data() {
      return {
        key: 0
      }
    },

    mounted() {
      setInterval(() => {
        this.rotate();
      }, 2000);
    },

    methods: {
      rotate() {
        this.key = this.getNextKey();
      },
      getNextKey() {
        const nextKey = this.key + 1;
        return typeof this.values[nextKey] === 'undefined' ? 0 : nextKey;
      }
    },

    computed: {
      value() {
        return this.values[this.key];
      }
    }
  };

  export default Rotator;
</script>

<style>
    .rotator {
        display: inline-block;
        font-size: 1.2em;
        /*text-transform: uppercase;*/
        border-bottom: 2px solid #555;
        margin: auto 0.2rem;
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .5s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-active {
        transform: translateX(20px);
        opacity: 0;
    }
</style>