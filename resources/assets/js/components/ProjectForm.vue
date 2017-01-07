<template>
    <div class="ubuntu-mono">
        <ProjectInfo :projectData="project" v-if="project" />

        <div class="row">
            <div class="col-md-6">
                <h2 class="text-xs-center">
                    Skills
                    <a href="#" class="text-success small" @click.prevent="addSkillFormGroup">
                        <i class="fa fa-plus"></i>
                    </a>
                </h2>
                <ProjectSkills :projectSkills="projectSkills"
                                  :project="project"/>
            </div>

            <div class="col-md-6">
                <h2 class="text-xs-center">
                    Highlights
                    <a href="#" class="text-success small" @click.prevent="addHighlightFormGroup">
                        <i class="fa fa-plus"></i>
                    </a>
                </h2>
                <ProjectHighlights :projectHighlights="projectHighlights"
                                      :project="project"/>
            </div>
        </div>
    </div>
</template>

<script>
  import {yearMonth} from '../filters/timeFilters'
  import ProjectInfo from './ProjectInfo.vue'
  import ProjectSkills from './ProjectSkills.vue'
  import ProjectHighlights from './ProjectHighlights.vue'
  import projectService from '../services/ProjectService'

  export default {
    props: ['project'],

    data() {
      return {
        projectSkills: this.project.skills,
        projectHighlights: this.project.highlights
      }
    },

    methods: {
      addSkillFormGroup() {
        this.projectSkills.push({});
      },
      addHighlightFormGroup() {
        this.projectHighlights.push({});
      }
    },

    components: {
      ProjectInfo,
      ProjectSkills,
      ProjectHighlights
    }
  }
</script>