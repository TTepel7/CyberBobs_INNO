<template>
  <div class="landingMain">
    <div class="content">
      <div class="header">
        <h1 class="title">{{ item.title }}</h1>
        <div class='tag'>{{ pilot?'Пилот':'Идея' }}</div>
      </div>
      <div class="directions">
        <div v-for='direction in item.directions' :key="direction" class="direction" >
          {{ direction.alias }}
        </div>
      </div>
      <div class="author">
        <img class="authorLogo" :src='item.team.logo'>
        <div class="authorName">
          {{ item.team.short_name}}
        </div>
        <img class="point" :src="require('./point.svg')">
        <div class="companyName">
           {{ item.transport_type.name }}
        </div>
      </div>
      <div class="directions">
        <div class="direction">
          {{ item.project_status.name }}
        </div>
      </div>
      <div class="description">
        {{ item.description }}
      </div>
    </div>
    <img class="cover" :src='item.image'>
  </div>
</template>

<script>
export default {
  props:{
    item:{
      type: Object,
      default: ()=>({})
    },
    pilot:{
      type: Boolean,
      default: false,
    }
  }

}
</script>

<style lang="scss" scoped>
.landingMain{
  display: grid;
  padding: 110px 200px 60px 240px;
  grid-template-areas: 'content cover';
  grid-column-gap: 234px;

  .content{
    grid-area: content;
  }

  .cover {
    grid-area: cover;
  }

  .tag{
    position: absolute;
    top: -10px;
    right: -20px;
    font-weight: 300;
    font-size: 20px;
    line-height: 24px;

    color: #FFFFFF;
    background-color: #009A96;
    border-radius: 43px;
    padding: 2px 12px;
  }

  .header{
    position: relative;
  }

  .title{
    font-weight: 300;
    font-size: 48px;
    line-height: 58px;
    color: #25222C;
  }

  .author{
    display: flex;
    flex-direction: row;
    align-items: center;

  }

  .point{
    width: 10px;
    height: 10px;
    color: #009A96;
    margin-right: 10px;
  }

  .authorLogo {
    width: 50px;
    height: 68px;
    margin-right: 38px;
  }

  .direction{
    padding: 4px 6px;
    font-weight: 300;
    font-size: 14px;
    line-height: 20px;
    color: #25222C;
    border: 1px solid #009A96;
    box-sizing: border-box;
    border-radius: 43px;
    margin-right: 6px;
    margin-bottom: 4px;
  }

  .directions{
    display: flex;
    flex-direction: row;
    margin-bottom: 16px;
  }

  .authorName {
    font-weight: 300;
    font-size: 36px;
    line-height: 44px;
    color: #009A96;
    margin-right: 10px;
  }

  .companyName {
    font-weight: 300;
    font-size: 36px;
    line-height: 44px;
    color: #25222C;
  }

  .description{
    max-width: 728px;
    font-weight: 300;
    font-size: 18px;
    line-height: 27px;
    text-align: justify;
    color: #374A59;

  }
}
</style>
