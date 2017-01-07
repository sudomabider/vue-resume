<template>
    <div>
        <div class="form-group" v-for="experienceHighlight in experienceHighlights">
            <ExperienceHighlight
                    :experienceHighlight="experienceHighlight"
                    :experienceId="experience.id"/>
        </div>
    </div>
</template>

<script>
    import ExperienceHighlight from './ExperienceHighlight.vue'
    import skillService from '../services/SkillService'

    export default {
      props: ['experienceHighlights', 'experience'],

      components: { ExperienceHighlight }
    }
</script>