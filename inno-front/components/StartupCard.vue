<template>
  <div class="startupCard">
    <img class="cover" :src="item.image">
    <div class="content">
      <div class="header">
      <div class="directions">
        <div v-for='direction in item.directions' :key='direction.id' class="direction">{{ direction.alias }}</div>
      </div>
      <div class="lastUpdate">{{ date }}</div>
    </div>
    <div class="direction alt">{{ item.project_stage_id >= 5 ? 'Пилот':'Идея' }}</div>
    <div class="data">
      <div class="title">{{ item.title }}</div>
      <div class="text">{{ item.description }}</div>
    </div>
    <div class="footer">
      <div class="author">
        <img class="avatar" :src='item.team.logo'>
        <div class="username">{{ item.team.short_name }}</div>
      </div>
      <NuxtLink :to='`landing/${item.id}`' class="getMore">Узнать больше 🡢</NuxtLink>
    </div>
    </div>
  </div>
</template>

<script>
export default {

  props: {
    item: {
      type: Object,
      default: () => ({})
    }
  },
  computed:{
    date(){
      let date = new Date(this.item.updated_at);
      let day = date.getDate() < 10?`0${date.getDate()}`:date.getDate();
      let month = date.getMonth()+1 < 10?`0${date.getMonth()+1}`:date.getMonth()+1;
      return day+
            "/"+month+
            "/"+date.getFullYear()

    }
  },

}
</script>

<style lang="scss" scoped>
.startupCard{
  display: grid;
  max-width: 806px;
  grid-template-areas:
    'cover header'
    'cover title'
    'cover text'
    'cover footer';
  grid-template-columns: min-content;
  box-shadow: 0px 10px 10px 2px rgba(0, 0, 0, 0.05);
  border-radius: 16px;
  overflow: hidden;

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
    flex-wrap: wrap;
  }

  .avatar{
    width: 38px;
    height: 38px;
    margin-right: 10px;
    border-radius: 50%;
  }

  .author{
    display: flex;
    align-items: center;
    max-width: 200px;
  }

  .data{
    width: 424px;
    height: 200px;
    text-overflow: ellipsis;
    overflow: hidden;
  }

  .title {
    grid-area: title;
    font-weight: 300;
    font-size: 40px;
    line-height: 46px;
    color: #25222C;
  }

  .alt{
    margin-right: auto;
  }

  .footer{
    display: flex;
    justify-content: space-between;
    align-items: center;
    grid-area: footer;

  }

  .header{
    display: flex;
    justify-content: space-between;
    grid-area: header;
  }

  .text{
    grid-area: text;
    font-weight: 300;
    font-size: 18px;
    line-height: 27px;
    color: #25222C;
  }

  .lastUpdate{
    font-weight: 300;
    font-size: 18px;
    line-height: 22px;
    color: #6E798C;
  }

  .username{
    font-weight: 300;
    font-size: 18px;
    line-height: 22px;
    color: #009A96;
  }

  .getMore{
    font-weight: 300;
    font-size: 18px;
    line-height: 22px;
    color: #009A96;
  }

  .content{
    padding: 28px 32px 10px 28px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .cover{
    width: 320px;
    height: 356px;
    background-color: grey;
  }
}




</style>
