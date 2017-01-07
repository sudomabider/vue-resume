<template>
    <div>
        <div class="form-group" v-for="experienceSkill in experienceSkills">
            <ExperienceSkill
                    :experienceSkill="experienceSkill"
                    :skills="skills"
                    :experience="experience"/>
        </div>
    </div>
</template>

<script>
    import ExperienceSkill from './ExperienceSkill.vue'
    import skillService from '../services/SkillService'

    export default {
      props: ['experienceSkills', 'experience'],

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

      components: { ExperienceSkill }
    }
</script>