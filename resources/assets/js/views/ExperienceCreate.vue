<template>
    <ExperienceForm :experience="experience" />
</template>

<script>
  import ExperienceForm from '../components/ExperienceForm.vue'
  import experienceService from '../services/ExperienceService'

  export default {
    data() {
      return {
        experience: {}
      }
    },

    components: { ExperienceForm }
  }
</script>
