<template>
  <ol class="Breadcrumbs">
    <li class="Breadcrumb" v-for="breadcrumb in breadcrumbs">
      <a class="Breadcrumb__link" v-link="{ path: breadcrumb.link }" v-if="!currentPage(breadcrumb.link)">
        {{ breadcrumb.name }}
      </a>
      <span class="Breadcrumb__link Breadcrumb__link--inactive" v-else>
        {{ breadcrumb.name }}
      </span>
    </li>
  </ol>
</template>

<script>
export default {

  props: ['breadcrumbs'],

  methods: {
    currentPage (link) {
      return this.$route.path.split('?')[0] == link;
    }
  }
}
</script>