<template>
    <div>
        <div class="row">
            <div class="col-md-5">
                <SkillChart :skills="experience.skills" />
            </div>
            <div class="col-md-6 offset-md-1 mt-1">
                <p @click="toggle" style="cursor: pointer">
                    <span class="lead">{{ experience.employer }}</span>
                    | {{ experience.title  }}
                    | {{ experience.start_year }} <template v-if="!experience.is_single">- {{ experience.end_year }}</template>
                    <i class="fa fa-minus-square"></i>
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
      props: ['experience', 'expand'],

      computed: {
        highlights() {
          return this.experience.highlights;
        }
      },

      methods: {
        toggle() {
          this.expand(false);
        }
      },

      components: {
        SkillChart
      }
    }
</script>