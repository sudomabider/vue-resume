<template>
    <transition name="slide-fade" mode="out-in">
        <div :key="editing" v-if="!hidden">
            <div class="row" v-if="editing">
                <div class="col-md-9">
                    <textarea name="content" rows="3" class="form-control" v-model="form.content"></textarea>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-link text-success" @click.prevent="savehighlight">
                        <i class="fa fa-check"></i>
                    </a>
                    <a href="#" class="btn btn-link text-danger" @click.prevent="cancel">
                        <i class="fa fa-close"></i>
                    </a>
                </div>
            </div>
            <div class="row" v-else>
                <div class="col-md-9">
                    <p class="form-control-static mb-0">
                        {{ form.content }}
                    </p>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-link text-warning" @click.prevent="edit">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-link text-danger" @click.prevent="deletehighlight">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
  import experienceHighlightService from '../services/ExperienceHighlightService'

  export default {
    props: ['experienceHighlight', 'experienceId'],

    data() {
      return {
        form: {
          content: ''
        },
        editing: !this.experienceHighlight.id,
        hidden: false
      }
    },

    created() {
      this.reset();
    },

    methods: {
      edit() {
        this.editing = true;
      },
      cancel() {
        if (this.experienceHighlight.id) {
          this.editing = false;
          this.reset();
        } else {
          this.hidden = true;
        }
      },
      savehighlight() {
        this.editing = false;
        if (this.experienceHighlight.id) {
          this.updatehighlight();
        }
        else {
          this.storehighlight();
        }
      },
      storehighlight() {
        experienceHighlightService.store(this.experienceId, JSON.stringify(this.form))
          .then(({data}) => {
            this.experienceHighlight.id = data.id;
          }, (response) => {
            this.reset();
          });
      },
      updatehighlight() {
        experienceHighlightService.update(this.experienceHighlight.id, JSON.stringify(this.form))
          .then(({data}) => {
            //
          }, (response) => {
            this.reset();
          });
      },
      deletehighlight() {
        experienceHighlightService.delete(this.experienceHighlight.id)
          .then(({data}) => {
            this.hidden = true;
          }, (response) => {
            this.reset();
          });
      },
      reset() {
        this.form.content = this.experienceHighlight.content;
      }
    }
  }
</script>