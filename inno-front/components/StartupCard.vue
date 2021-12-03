<template>
  <div class="root">
    <img class="cover" :src="item.image">
    <div class="content">
      <div class="header">
      <div class="directions">
        <div v-for='direction in item.directions' :key='direction.id' class="direction">{{ direction.name }}</div>
      </div>
      <div class="lastUpdate">{{ date }}</div>
    </div>
    <div class="data">
      <div class="title">{{ item.title }}</div>
      <div class="text">{{ item.description }}</div>
    </div>
    <div class="footer">
      <div class="author">
        <div class="avatar">{{ item.team.logo }}</div>
        <div class="username">{{ item.team.short_name }}</div>
      </div>
      <div class="getMore">Узнать больше 🡢</div>
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
      let hours = date.getHours() < 10? `0${date.getHours()}`:date.getHours();
      let minutes = date.getMinutes() < 10? `0${date.getMinutes()}`:date.getMinutes();
      let seconds = date.getSeconds() < 10? `0${date.getSeconds()}`:date.getSeconds();
      return date.getDate()+
            "/"+(date.getMonth()+1)+
            "/"+date.getFullYear()+
            " "+ hours +
            ":"+ minutes+
            ":"+ seconds;

    }
  },

}
</script>

<style lang="scss" scoped>
.root{
  display: grid;
  max-width: 806px;
 display: grid;
  grid-template-areas:
    'cover header'
    'cover title'
    'cover text'
    'cover footer';
  grid-template-columns: min-content;
}

.direction{
  font-weight: 300;
  font-size: 20px;
  line-height: 24px;
  color: #25222C;
  border: 1px solid #009A96;
  box-sizing: border-box;
  border-radius: 43px;
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

.footer{
  display: flex;
  justify-content: space-between;
  grid-area: footer;

}

.header{
  display: flex;
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
}

.cover{
  width: 320px;
  height: 356px;
  background-color: grey;
}


</style>
