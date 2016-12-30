<template>
    <div class="row experience">
        <div class="col-xs-12">
            <router-link :to="{ name: 'experience.show', params: { id: this.experience.id } }" tag="div" style="cursor: pointer">
                <span class="lead">{{ experience.employer }}</span>
                 | {{ experience.title  }}
                 | {{ experience.start_year }} <template v-if="!experience.is_single">- {{ experience.end_year }}</template>
                 <i class="fa fa-arrow-circle-o-right"></i>
            </router-link>
            <div class="yearline-bg">
                <div class="yearline" :style="style"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import { year } from '../filters/timeFilters'

    export default {
      props: ['experience', 'startyear', 'endyear', 'expand'],

      computed: {
        width() {
          return this.experience.year_duration*100/(this.endyear - this.startyear + 1) + '%';
        },
        left() {
          return (this.experience.start_year - this.startyear)*100/(this.endyear - this.startyear + 1) + '%';
        },
        style() {
          return 'left:' + this.left + ';width:' + this.width + ';';
        }
      }
    }
</script>

<style>
    .experience {
        letter-spacing: 0.15rem;
        margin-bottom: 1rem;
    }

    span.lead {
        text-transform: uppercase;
    }

    .yearline-bg {
        position: relative;
        width: 100%;
        height: 1rem;
        background-color: #ccc;
    }

    .yearline {
        position: absolute;
        height: 1rem;
        background-color: #555;
        left: 20%;
        width: 10%;
    }
</style>