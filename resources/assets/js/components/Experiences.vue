<template>
    <div id="experiences">
       <transition name="fade" mode="out-in">
           <div v-if="!current">
               <Experience
                       v-for="experience in experiences"
                       :experience="experience"
                       :startyear="startyear"
                       :endyear="endyear"
                       :expand="expand"
                       track-by="id">
               </Experience>
           </div>
           <ExperienceDetails
                   v-else
                   :experience="current"
                   :expand="expand"/>
       </transition>
    </div>
</template>

<script>
  import Experience from './Experience.vue'
  import ExperienceDetails from './ExperienceDetails.vue'
  import experienceService from '../services/ExperienceService'

  export default {

    components: { Experience, ExperienceDetails },

    data () {
      return {
        experiences: [],
        current: false
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
      },

      currentKey() {
        if (this.current) {
          return this.current.id;
        }

        return 0;
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
      },

      expand(experience) {
        this.current = experience;
      }
    }
  }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s
    }
    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>