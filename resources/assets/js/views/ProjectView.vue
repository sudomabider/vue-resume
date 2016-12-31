<template>
    <ProjectDetails :project="project" />
</template>

<script>
  import ProjectDetails from '../components/ProjectDetails.vue'
  import projectService from '../services/ProjectService'

  export default {
    data() {
      return {
        // this needs to be a falsy value
        project: ''
      }
    },

    created() {
      this.fetchProject();
    },

    methods: {
      fetchProject() {
        projectService.getOne(this.$route.params.id)
          .then(({ data }) => {
            this.project = data;
          });
      }
    },

    components: { ProjectDetails }
  }
</script>
