<template>
    <div id="experiences">
        <transition-group name="list" tag="div">
           <Experience
                   v-for="(experience, index) in experiences"
                   :experience="experience"
                   :startyear="startyear"
                   :endyear="endyear"
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
        experiences: []
      };
    },

    created() {
      this.fetchExperiences();
    },

    computed: {
      startyear() {
        const years = this.experiences.map(function(experience) {
          return experience.start_year;
        });
        return Math.min(...years);
      },

      endyear() {
        const years = this.experiences.map(function(experience) {
          return experience.end_year;
        });
        return Math.max(...years);
      }
    },

    methods: {
      setExperiences(experiences) {
        this.experiences = experiences
      },

      fetchExperiences() {
        experienceService.getAll()
          .then(({ data }) => {
          this.setExperiences(data);
        });
      }
    }
  }
</script>