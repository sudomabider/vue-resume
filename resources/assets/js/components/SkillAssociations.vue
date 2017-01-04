<template>
    <div>
        <div class="form-group" v-for="association in associations">
            <SkillAssociation :association="association" :skills="skills" :experience="experience" />
        </div>
    </div>
</template>

<script>
    import SkillAssociation from './SkillAssociation.vue'
    import skillService from '../services/SkillService'

    export default {
      props: ['associations', 'experience'],

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

      components: { SkillAssociation }
    }
</script>