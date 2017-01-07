<template>
    <div>
        <div class="row">
            <div class="col-md-4 form-group">
                <input type="text" name="name" v-model="form.name" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-4 form-group">
                <input type="text" name="source" v-model="form.source" class="form-control" placeholder="Source Url">
            </div>
            <div class="col-md-2 form-group">
                <input type="text" name="url" v-model="form.url" class="form-control" placeholder="Project Url">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group text-xs-center">
                <button class="btn btn-primary d-inline-block px-2" @click.prevent="saveProject" :disabled="!formChanged">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
  import projectService from '../services/ProjectService'

  export default {
    props: ['projectData'],

    data() {
      return {
        project: this.projectData || {},
        form: {
          name: '',
          source: '',
          url: ''
        }
      }
    },

    mounted() {
      if (this.projectData) {
        this.form.name = this.projectData.name;
        this.form.source = this.projectData.source;
        this.form.url = this.projectData.url;
      }
    },

    computed: {
      formChanged() {
        return this.form.name !== this.project.name ||
          this.form.source !== this.project.source ||
          this.form.url !== this.project.url;
      }
    },

    methods: {
      saveProject() {
        if (this.projectData) {
          projectService.update(this.project.id, JSON.stringify(this.form))
            .then(({data}) => {
              this.project = data;
              this.form.name = this.project.name;
              this.form.source = this.project.source;
              this.form.url = this.project.url;
            }, (response) => {

            });
        }

        else {
          projectService.store(JSON.stringify(this.form))
            .then(({data}) => {
              this.$router.push('/projects/' + data.id + '/edit');
            }, (response) => {

            });
        }
      }
    }
  }
</script>