<template>
    <div class="row project">
        <div class="col-xs-12">
            <router-link :to="{ name: 'project.show', params: { id: this.project.id } }" tag="div" class="clickable">
                <span class="lead" style="text-transform: lowercase">{{ project.name }}</span>
                <i class="fa fa-expand"></i>
            </router-link>
            <div class="yearline-bg"></div>
        </div>
    </div>
</template>

<script>
  export default {
    props: ['project']
  }
</script>

<style>
    .project .yearline-bg {
        height: .5rem;
        margin-top: .25rem;
        margin-bottom: .25rem;
    }
</style>