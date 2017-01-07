<template>
    <div class="ubuntu-mono">
        <ExperienceInfo :experienceData="experience" v-if="experience" />

        <div class="row">
            <div class="col-md-6">
                <h2 class="text-xs-center">
                    Skills
                    <a href="#" class="text-success small" @click.prevent="addSkillFormGroup">
                        <i class="fa fa-plus"></i>
                    </a>
                </h2>
                <ExperienceSkills :experienceSkills="experienceSkills"
                                   :experience="experience"/>
            </div>

            <div class="col-md-6">
                <h2 class="text-xs-center">
                    Highlights
                    <a href="#" class="text-success small" @click.prevent="addHighlightFormGroup">
                        <i class="fa fa-plus"></i>
                    </a>
                </h2>
                <ExperienceHighlights :experienceHighlights="experienceHighlights"
                                  :experience="experience"/>
            </div>
        </div>
    </div>
</template>

<script>
    import {yearMonth} from '../filters/timeFilters'
    import ExperienceInfo from './ExperienceInfo.vue'
    import ExperienceSkills from './ExperienceSkills.vue'
    import ExperienceHighlights from './ExperienceHighlights.vue'
    import experienceService from '../services/ExperienceService'

    export default {
      props: ['experience'],

      data() {
        return {
          experienceSkills: this.experience.skills,
          experienceHighlights: this.experience.highlights
        }
      },

      methods: {
        addSkillFormGroup() {
          this.experienceSkills.push({});
        },
        addHighlightFormGroup() {
          this.experienceHighlights.push({});
        }
      },

      components: {
        ExperienceInfo,
        ExperienceSkills,
        ExperienceHighlights
      }
    }
</script>