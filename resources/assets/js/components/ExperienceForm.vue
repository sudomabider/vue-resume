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
                    <div class="form-group row" v-for="(e_skill,index) in experience.skills">
                        <div class="col-md-7">
                            <select class="form-control">
                                <option v-for="skill in skills" :value="skill.id" :selected="e_skill.id === skill.id">{{skill.name}}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="number" :value="e_skill.percentage" class="form-control" placeholder="Percentage">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <a href="#" class="btn btn-link text-danger" @click.prevent="deleteSkill(index)">
                                <i class="fa fa-close"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import skillService from '../services/SkillService'
    import {yearMonth} from '../filters/timeFilters'

    export default {
      props: ['experience'],

      data() {
        return {
          skills: [],
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

      created() {
        this.fetchSkills();
      },

      methods: {
        fetchSkills() {
          skillService.getAll()
            .then(({ data }) => {
              this.skills = data
            });
        },

        deleteSkill(id) {
          console.log(id);
        }
      }
    }
</script>