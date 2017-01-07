<template>
    <transition name="slide-fade" mode="out-in">
        <div :key="editing" v-if="!hidden">
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
      props: ['experienceSkill', 'skills', 'experience'],

      data() {
        return {
          skill_id: '',
          percentage: '',
          editing: !this.experienceSkill.id,
          hidden: false
        }
      },

      created() {
        this.reset();
      },

      computed: {
        selected() {
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
          if (this.experienceSkill.id) {
            this.editing = false;
            this.reset();
          } else {
            this.hidden = true;
          }
        },
        saveSkill() {
          this.editing = false;
          if (this.experienceSkill.id) {
            this.updateSkill();
          }
          else {
            this.storeSkill();
          }
        },
        storeSkill() {
          experienceSkillService.store(this.experience.id, JSON.stringify({
            id: this.selected.id,
            percentage: this.percentage
          }))
            .then(({data}) => {
              this.experienceSkill.id = data.id;
            }, (response) => {
              this.reset();
            });
        },
        updateSkill() {
          experienceSkillService.update(this.experience.id, this.experienceSkill.id, JSON.stringify({
            id: this.selected.id,
            percentage: this.percentage
          }))
            .then(({data}) => {
              //
            }, (response) => {
              this.reset();
            });
        },
        deleteSkill() {
          experienceSkillService.delete(this.experience.id, this.experienceSkill.id)
            .then(({data}) => {
              this.hidden = true;
            }, (response) => {
              this.reset();
            });
        },
        reset() {
          this.skill_id = this.experienceSkill.id;
          this.percentage = this.experienceSkill.percentage;
        }
      }
    }
</script>