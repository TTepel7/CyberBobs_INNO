<template>
  <div class="landingPilot">
    <h2 class="title">Пилот</h2>
    <div class="content">
      <img class="logo" :src="item.pilot_owner.logo" />
      <div class="stages">

        <div v-for="(stage, index) in stages" :key='index' class="stage">
            <div class='timeline'>
              <img class="circle" :src="require('./circle.svg')" />
              <img v-if='index !== stages.length - 1' class="line" :src="require('./line.svg')" />
            </div>
            <div class="date">{{stage.date}}</div>
            <div class="text">{{stage.text}}</div>
        </div>
      </div>
    </div>
    <a class="downloadButton" :href="item.doc_url" download >Скачать отчёт</a>
  </div>
</template>

<script>
export default {
  props:{
    item:{
      type: Object,
      default: ()=>({})
    }
  },
  computed:{

    stages(){
      return JSON.parse(this.item.stages_json)
    }
  }

}
</script>

<style lang="scss" scoped>
.landingPilot{
  padding: 60px 200px 60px 240px;
  background-color: #ffffff;

  .downloadButton{
    font-weight: 300;
    font-size: 24px;
    line-height: 29px;
    color: #ffffff;
    padding: 20px 38px;
    background-color: #009A96;
    border-radius: 48px;
    float: right;
  }

  .timeline{
    position: relative;
    display: flex;
    margin-bottom: 24px;
  }

  .title{
    font-weight: 300;
    font-size: 48px;
    line-height: 58px;
    color: #25222C;
    margin-bottom: 54px;
  }

  .content{
    display: flex;
    flex-direction: row;
  }

  .stages{
    display: flex;
    flex-direction: row;
    margin-bottom: 100px;
  }

  .stage{
    margin-right: 54px;
    max-width: 276px;

  }

  .date{
    font-style: normal;
    font-weight: 300;
    font-size: 24px;
    line-height: 27px;
    color: #374A59;
    margin-bottom: 20px;
  }

  .text{
    font-weight: 300;
    font-size: 18px;
    line-height: 27px;
    text-align: justify;
    color: #374A59;
  }


  .logo{
    width: 280px;
    height: 184px;
    margin-right: 196px;
  }

}
</style>
