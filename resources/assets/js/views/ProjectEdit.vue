<template>
    <ProjectForm v-if="project"
                    :project="project"/>
</template>

<script>
  import ProjectForm from '../components/ProjectForm.vue'
  import projectService from '../services/ProjectService'

  export default {
    data() {
      return {
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
            this.project = data
          });
      }
    },

    components: { ProjectForm }
  }
</script>
