<template>
    <ExperienceDetails :experience="experience" />
</template>

<script>
  import ExperienceDetails from '../components/ExperienceDetails.vue'
  import experienceService from '../services/ExperienceService'

  export default {
    data() {
      return {
        // this needs to be a falsy value
        experience: ''
      }
    },

    created() {
      this.fetchExperience();
    },

    methods: {
      setExperience(experience) {
        this.experience = experience
      },

      fetchExperience() {
        experienceService.getOne(this.$route.params.id)
          .then(({ data }) => {
            this.setExperience(data);
          });
      }
    },

    components: { ExperienceDetails }
  }
</script>
