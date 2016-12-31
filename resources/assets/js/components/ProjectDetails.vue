<template>
    <div>
        <div class="row">
            <div class="col-md-5">
                <SkillChart v-if="skills" :skills="skills" />
            </div>
            <div class="col-md-6 offset-md-1 mt-1" v-if="project">
                <p class="lead">{{ project.name }}</p>
                <p>
                    <span class="d-block">
                        <i class="fa fa-link fa-fw"></i> <a href="project.url" target="_blank">{{ project.url }}</a>
                    </span>
                    <span class="d-block">
                        <i class="fa fa-github fa-fw"></i> <a href="project.source" target="_blank">{{ project.source }}</a>
                    </span>
                </p>
                <p v-for="highlight in highlights">
                    <i class="fa fa-check"></i> {{ highlight.content }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
  import SkillChart from './SkillChart.vue'

  export default {
    props: ['project'],

    computed: {
      highlights() {
        return this.project.highlights;
      },
      skills() {
        return this.project.skills;
      }
    },

    components: {
      SkillChart
    }
  }
</script>