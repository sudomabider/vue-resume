<template>
    <div>
        <div class="row" v-if="isWork">
            <div class="col-md-5">
                <SkillChart v-if="skills" :skills="skills" />
            </div>
            <div class="col-md-6 offset-md-1 mt-1" v-if="experience">
                <p style="letter-spacing: .1rem">
                    <span class="lead">{{ experience.employer }}</span>
                    | {{ experience.title  }}
                    | {{ experience.start_year }} <template v-if="!experience.is_single">- {{ experience.end_year }}</template>
                </p>
                <p v-for="highlight in highlights">
                    <i class="fa fa-arrow-right"></i> {{ highlight.content }}
                </p>
            </div>
        </div>
        <div v-if="isStudy">
            <div class="text-xs-center ubuntu-mono">
                <p>Nothing to see here...</p>
                <p class="lead">Education is overrated.</p>
                <div class="banner-dark">
                    Learn By doing!
                </div>
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
        },
        isWork() {
          return this.experience.type === 'work';
        },
        isStudy() {
          return this.experience.type === 'study';
        }
      },

      components: {
        SkillChart
      }
    }
</script>

<style>
    .banner-dark {
        padding: 2rem;
        letter-spacing: .3rem;
        font-size: 4rem;
        background: #333;
        color: #f8f8f8;
        text-transform: uppercase;
    }
</style>