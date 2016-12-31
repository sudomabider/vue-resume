<template>
    <div class="row experience">
        <div class="col-xs-12">
            <router-link :to="{ name: 'experience.show', params: { id: this.experience.id } }" tag="div" class="clickable">
                <span class="lead">{{ experience.employer }}</span>
                 | {{ experience.title  }}
                 | {{ experience.year_range }}
                 <i class="fa fa-expand"></i>
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
      props: ['experience', 'duration'],

      computed: {
        width() {
          return this.experience.duration*100/(this.duration) + '%';
        },
        left() {
          return (this.experience.left)*100/(this.duration) + '%';
        },
        style() {
          return 'left:' + this.left + ';width:' + this.width + ';';
        }
      }
    }
</script>