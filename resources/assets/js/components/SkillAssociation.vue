<template>
    <transition name="slide-fade" mode="out-in">
        <div :key="editing">
            <div class="row" v-if="editing">
                <div class="col-md-5">
                    <select class="form-control" v-model="skill_id">
                        <option v-for="skill in skills" :value="skill.id">{{skill.name}}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="number" v-model="percentage" class="form-control" placeholder="Percentage">
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-link text-success" @click.prevent="saveSkill">
                        <i class="fa fa-check"></i>
                    </a>
                    <a href="#" class="btn btn-link text-danger" @click.prevent="cancel">
                        <i class="fa fa-close"></i>
                    </a>
                </div>
            </div>
            <div class="row" v-else>
                <div class="col-md-5">
                    <p class="form-control-static mb-0">
                        {{ selected.name }}
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="form-control-static mb-0">
                        {{ percentage }}%
                    </p>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-link text-warning" @click.prevent="edit">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-link text-danger" @click.prevent="deleteSkill">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import experienceSkillService from '../services/ExperienceSkillService'

    export default {
      props: ['association', 'skills', 'experience'],

      data() {
        return {
          skill_id: '',
          percentage: '',
          editing: false
        }
      },

      created() {
        this.reset();
      },

      computed: {
        selected() {
          const vm = this;

          const checkId = (skill) => {
            return skill.id === this.skill_id;
          };

          return this.skills.find(checkId) || {};
        }
      },

      methods: {
        edit() {
          this.editing = true;
        },
        cancel() {
          this.editing = false;
        },
        saveSkill() {
          this.editing = false;
          if (this.association.id) {
            this.updateSkill();
          }
          else {
            this.storeSkill();
          }
        },
        storeSkill() {

        },
        updateSkill() {
          experienceSkillService.update(this.experience.id, this.association.id, JSON.stringify({
            id: this.selected.id,
            percentage: this.percentage
          }))
            .then(({data}) => {

            }, (response) => {
              this.reset();
            });
        },
        deleteSkill() {

        },
        reset() {
          this.skill_id = this.association.id;
          this.percentage = this.association.percentage;
        }
      }
    }
</script>