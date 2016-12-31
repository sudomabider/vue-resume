<template>
    <div class="home-view">
        <h1>- Experiences</h1>
        <div id="experiences">
            <transition-group name="list" tag="div">
                <Experience
                        v-for="experience in experiences"
                        :experience="experience"
                        :duration="duration"
                        :key="experience.id"
                        track-by="id">
                </Experience>
            </transition-group>
        </div>

        <h1>- Education</h1>
        <div id="educations">
            <transition-group name="list" tag="div">
                <Experience
                        v-for="education in educations"
                        :experience="education"
                        :duration="duration"
                        :key="education.id"
                        track-by="id">
                </Experience>
            </transition-group>
        </div>
    </div>
</template>

<script>
  import Experience from '../components/Experience.vue'
  import experienceService from '../services/ExperienceService'

  export default {
    data () {
      return {
        experiences: [],
        educations: [],
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
            this.experiences = data.experiences.filter(function(experience){
              return experience.type === 'work';
            });
            this.educations = data.experiences.filter(function(experience){
              return experience.type === 'study';
            });
            this.duration = data.duration;
          });
      }
    },

    components: { Experience },
  }
</script>