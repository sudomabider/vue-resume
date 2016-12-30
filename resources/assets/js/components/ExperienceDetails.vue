<template>
    <div>
        <div class="row">
            <div class="col-md-5">
                <SkillChart v-if="skills" :skills="skills" />
            </div>
            <div class="col-md-6 offset-md-1 mt-1" v-if="experience">
                <p>
                    <span class="lead">{{ experience.employer }}</span>
                    | {{ experience.title  }}
                    | {{ experience.start_year }} <template v-if="!experience.is_single">- {{ experience.end_year }}</template>
                </p>
                <p v-for="highlight in highlights">
                    <i class="fa fa-arrow-right"></i> {{ highlight.content }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import SkillChart from './SkillChart.vue'

    export default {
      props: ['experience'],

      computed: {
        highlights() {
          return this.experience.highlights;
        },
        skills() {
          return this.experience.skills;
        }
      },

      components: {
        SkillChart
      }
    }
</script>