<template>
    <div>
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
            <div class="col-xs-12 form-group text-xs-center">
                <button class="btn btn-primary d-inline-block px-2" @click.prevent="saveExperience" :disabled="!formChanged">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
  import {yearMonth} from '../filters/timeFilters'
  import experienceService from '../services/ExperienceService'

  export default {
    props: ['experienceData'],

    data() {
      return {
        experience: this.experienceData || {},
        form: {
          employer: '',
          title: '',
          start: '',
          end: ''
        }
      }
    },

    mounted() {
      if (this.experienceData) {
        this.form.employer = this.experienceData.employer;
        this.form.title = this.experienceData.title;
        this.form.start = yearMonth(this.experienceData.start);
        this.form.end = yearMonth(this.experienceData.end);
      }
    },

    computed: {
      formChanged() {
        return this.form.employer !== this.experience.employer ||
          this.form.title !== this.experience.title ||
          this.form.start !== yearMonth(this.experience.start) ||
          this.form.end !== yearMonth(this.experience.end);
      }
    },

    methods: {
      saveExperience() {
        if (this.experienceData) {
          experienceService.update(this.experience.id, JSON.stringify(this.form))
            .then(({data}) => {
              this.experience = data;
              this.form.employer = this.experience.employer;
              this.form.title = this.experience.title;
              this.form.start = yearMonth(this.experience.start);
              this.form.end = yearMonth(this.experience.end);
            }, (response) => {

            });
        }

        else {
          experienceService.store(JSON.stringify(this.form))
            .then(({data}) => {
              this.$router.push('/experiences/' + data.id + '/edit');
            }, (response) => {

            });
        }
      }
    }
  }
</script>