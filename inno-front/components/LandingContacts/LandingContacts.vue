<template>
  <div class="landingContacts">
    <h2 class="title">Контакты</h2>
    <div class="content">
      <img class='logo' :src='item.team.logo' />
      <div class="card">
        <div class="header">
          <div class="teamName">
            {{item.team.short_name}}
          </div>
          <img class="point" :src="require('./point.svg')">
          <div class="inn">
            {{item.team.inn}}
          </div>
          <img class="point" :src="require('./point.svg')">
          <div class="staff">
            {{item.team.staff_type.name}}
          </div>
        </div>
        <div class="middle">
          <img class="avatar" :src="require('./leader.png')">

          <div class="contacts">
            <div class="name">
              {{ item.leader.first_name + " " + item.leader.last_name}}
              <div class='tag'>{{ item.leader.position }}</div>
            </div>
            <div class="media">
              <div class="phone">
                <img class="icon" :src="require('./phone.svg')">
                {{item.leader.phone}}
              </div>
              <div class="email">
                <img class="icon" :src="require('./dog.svg')">
                {{item.leader.email}}
              </div>
              <div class="site">
                <img class="icon" :src="require('./planet.svg')">
                {{item.team.site_url}}
              </div>
            </div>
          </div>
        </div>
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
  computed:{
    stages(){
      return JSON.parse(this.item.stages_json)
    }
  }

}
</script>

<style lang="scss" scoped>
.landingContacts{
  padding: 60px 200px 60px 240px;
  background-color: #F6F7FA;

  .logo{
    width: 195px;
    height: 202px;
    margin-right: 140px;
  }

  .title{
    font-weight: 300;
    font-size: 48px;
    line-height: 58px;
    color: #25222C;
  }

  .content{
    display: flex;
    align-items: center;
  }

  .media{
    display: flex;
    align-items: center;
  }

  .header{
    display: flex;
    align-items: center;
  }

  .middle{

    display: flex;
    align-items: center;
  }

  .teamName {
    font-weight: 300;
    font-size: 36px;
    line-height: 44px;
    color: #009A96;
  }

  .inn {
    font-weight: 300;
    font-size: 24px;
    line-height: 27px;
    color: #25222C;
  }

  .staff {
    font-weight: 300;
    font-size: 24px;
    line-height: 27px;
    color: #25222C;
  }

  .name {
    position: relative;
    display: flex;
    font-weight: 300;
    font-size: 36px;
    line-height: 27px;
    text-align: justify;
    color: #25222C;
    margin-top: 20px;
    margin-bottom: 20px;
    margin-right: 14px;
  }

  .phone{
    display: flex;
    margin-right: 30px;
    align-items: center;
  }

  .contacts{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
  .email{
    display: flex;
    margin-right: 30px;
    align-items: center;
  }
  .site{
    display: flex;
    align-items: center;
  }

  .media {
    font-size: 18px;
    line-height: 27px;
    text-align: justify;
    color: #25222C;
  }

  .avatar{
    width: 96px;
    height: 96px;
    margin-right: 34px;;
  }

  .icon{
    margin-right: 14px;
  }

  .point{
    margin: 0 15px;
  }

  .tag{
    top: -20px;
    right: -140px;
    font-weight: 300;
    font-size: 20px;
    line-height: 24px;
    margin-left: 20px;
    color: #FFFFFF;
    background-color: #009A96;
    border-radius: 43px;
    padding: 2px 12px;
  }
}
</style>
