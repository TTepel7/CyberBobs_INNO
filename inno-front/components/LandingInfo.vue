<template>
  <div class="landingInfo">
    <div class="cards">
      <div class="card">
        <div class="cardTitle">Польза</div>
        <div class="cardItem">
          <div v-for="(advantage, index) in advantages(item.advantages_json)" :key="index" class='item'>
            {{ advantage }}
          </div>
        </div>
      </div>
      <div class="card">
        <div class="cardTitle">Кейсы использования</div>
        <div class="cardItem">{{ item.transport_type.name }}</div>
      </div>
      <div v-if="item.project_stage_id < 5" class="card">
        <div class="cardTitle">Запрос к акселератору и видение пилотного проекта</div>
        <div class="cardItem">{{ item.request_text }}</div>
      </div>
      <div v-if="item.project_stage_id < 5" class="card">
        <div class="cardTitle">Откуда узнали про акселератор</div>
        <div class="cardItem">{{  }}</div>
      </div>
    </div>

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
  methods:{
    advantages(item){
      return JSON.parse(item)
    }
  }

}
</script>

<style lang="scss" scoped>
.landingInfo{
  padding: 110px 200px 60px 240px;
  background-color: #F6F7FA;

  .cards{
    display: grid;
    grid-column-gap: 234px;
    flex-direction: row;
    grid-template-columns: repeat(2, 1fr);
    margin-bottom: 60px;

  }
  .card{
    overflow: hidden;
  }

  .cardTitle {
    font-style: normal;
    font-weight: 300;
    font-size: 36px;
    line-height: 44px;
    margin-bottom: 60px;
    margin-top: 60px;
  }

  .cardsItems{
    background-color: #ffffff;
  }

  .item{
    margin-bottom: 24px;
  }

  .cardItem{
    padding: 24px;
    font-weight: 300;
    font-size: 18px;
    line-height: 27px;
    margin-bottom: 20px;
    background-color: #ffffff;
    width: 100%;
    height: 100%;
  }
}
</style>
