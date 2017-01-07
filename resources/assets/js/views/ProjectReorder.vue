<template>
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
            <div class="form-group row" v-for="project in projects" :key="project.id">
                <div class="col-md-10">
                    <p class="static-form-control">{{project.name}}</p>
                </div>
                <div class="col-md-2">
                    <input type="number" v-model="order[project.id]" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-xs-center">
                    <button class="btn btn-primary px-2 d-inline-block" @click.prevent="updateOrder">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import projectService from '../services/ProjectService'

    export default {
      data () {
        return {
          projects: [],
          order: []
        };
      },

      created() {
        this.fetchProjects();
      },

      methods: {
        fetchProjects() {
          projectService.getAll()
            .then(({ data }) => {
              this.projects = data;
              for (const key in data) {
                if( data.hasOwnProperty( key ) ) {
                  this.order[data[key].id] = data[key].sort;
                }
              }
            });
        },
        updateOrder() {
          projectService.reorder(JSON.stringify({order: this.order}))
            .then((response) => {
              this.fetchProjects();
            });
        }
      },
    }
</script>