<template>
    <div id="experiences">
        <transition-group name="list" tag="div">
           <Experience
                   v-for="(experience, index) in experiences"
                   :experience="experience"
                   :duration="duration"
                   :key="index"
                   track-by="id">
           </Experience>
        </transition-group>
    </div>
</template>

<script>
  import Experience from './Experience.vue'
  import experienceService from '../services/ExperienceService'

  export default {

    components: { Experience },

    data () {
      return {
        experiences: [],
        duration: ''
      };
    },

    created() {
      this.fetchExperiences();
    },

    methods: {
      fetchExperiences() {
        experienceService.getAll()
          .then(({ data }) => {
            console.log(data);
            this.experiences = data.experiences;
            this.duration = data.duration;
        });
      }
    }
  }
</script>