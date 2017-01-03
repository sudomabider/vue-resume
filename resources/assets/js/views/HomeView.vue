<template>
    <div class="home-view">
        <h1 class="resume-header">
            Experiences
        </h1>
        <h1 class="d-inline" v-if="$root.authenticated">
            <router-link :to="{ name: 'home'}" class="btn btn-success btn-sm">
                <i class="fa fa-plus fa-fw"></i>NEW
            </router-link>
        </h1>
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
        <br>
        <h1 class="resume-header">Education</h1>
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
        <br>
        <h1 class="resume-header">Projects</h1>
        <div id="projects">
            <transition-group name="list" tag="div">
                <Project
                        v-for="project in projects"
                        :project="project"
                        :key="project.id"
                        track-by="id">
                </Project>
            </transition-group>
        </div>
    </div>
</template>

<script>
  import Experience from '../components/Experience.vue'
  import Project from '../components/Project.vue'
  import experienceService from '../services/ExperienceService'
  import projectService from '../services/ProjectService'

  export default {
    data () {
      return {
        experiences: [],
        educations: [],
        projects: [],
        duration: ''
      };
    },

    created() {
      this.fetchExperiences();
      this.fetchProjects();
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
      },

      fetchProjects() {
        projectService.getAll()
          .then(({ data }) => {
            this.projects = data;
          });
      }
    },

    components: {
      Experience,
      Project
    },
  }
</script>

<style>
    h1.resume-header {
        letter-spacing: .2rem;
        background: #888;
        color: #f8f8f8;
        display: inline-block;
        padding: 0.1rem 0.5rem;
    }

    .experience, .project {
        letter-spacing: 0.15rem;
        margin-bottom: 1rem;
    }

    span.lead {
        text-transform: uppercase;
    }

    .yearline-bg {
        position: relative;
        width: 100%;
        height: 1rem;
        background-color: #ccc;
    }

    .yearline {
        position: absolute;
        height: 1rem;
        background-color: #555;
        left: 20%;
        width: 10%;
    }
</style>