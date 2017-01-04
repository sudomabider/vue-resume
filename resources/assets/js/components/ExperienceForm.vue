<template>
    <div class="ubuntu-mono">
        <form>
            <div class="row">
                <div class="col-md-4 form-group">
                    <input type="text" name="employer" v-model="form.employer" class="form-control" placeholder="Employer">
                </div>
                <div class="col-md-4 form-group">
                    <input type="text" name="title" v-model="form.title" class="form-control" placeholder="Title">
                </div>
                <div class="col-md-2 form-group">
                    <input type="text" name="start" v-model="form.start" class="form-control" placeholder="Start date">
                </div>
                <div class="col-md-2 form-group">
                    <input type="text" name="end" v-model="form.end" class="form-control" placeholder="End date">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-xs-center">Skills</h2>
                    <SkillAssociations :associations="experience.skills" :experience="experience" />
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {yearMonth} from '../filters/timeFilters'
    import SkillAssociations from './SkillAssociations.vue'

    export default {
      props: ['experience'],

      data() {
        return {
          form: {
            employer: this.experience.employer,
            title: this.experience.title,
            start: yearMonth(this.experience.start),
            end: yearMonth(this.experience.end),
            skills: this.experience.skills || [],
            highlights: this.experience.highlights || []
          }
        }
      },

      components: {
        SkillAssociations
      }
    }
</script>