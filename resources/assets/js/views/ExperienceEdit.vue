<template>
    <ExperienceForm v-if="experience"
                    :experience="experience"/>
</template>

<script>
  import ExperienceForm from '../components/ExperienceForm.vue'
  import experienceService from '../services/ExperienceService'

  export default {
    data() {
      return {
        experience: ''
      }
    },

    created() {
      this.fetchExperience();
    },

    methods: {
      fetchExperience() {
        experienceService.getOne(this.$route.params.id)
          .then(({ data }) => {
            this.experience = data
          });
      }
    },

    components: { ExperienceForm }
  }
</script>
