<template>
    <div>
        <div class="form-group" v-for="projectSkill in projectSkills">
            <ProjectSkill
                    :projectSkill="projectSkill"
                    :skills="skills"
                    :project="project"/>
        </div>
    </div>
</template>

<script>
  import ProjectSkill from './ProjectSkill.vue'
  import skillService from '../services/SkillService'

  export default {
    props: ['projectSkills', 'project'],

    data() {
      return {
        skills: [],
      }
    },

    created() {
      this.fetchSkills();
    },

    methods: {
      fetchSkills() {
        skillService.getAll()
          .then(({ data }) => {
            this.skills = data
          });
      }
    },

    components: { ProjectSkill }
  }
</script>