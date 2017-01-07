<template>
    <div>
        <div class="form-group" v-for="projectHighlight in projectHighlights">
            <ProjectHighlight
                    :projectHighlight="projectHighlight"
                    :projectId="project.id"/>
        </div>
    </div>
</template>

<script>
  import ProjectHighlight from './ProjectHighlight.vue'
  import skillService from '../services/SkillService'

  export default {
    props: ['projectHighlights', 'project'],

    components: { ProjectHighlight }
  }
</script>