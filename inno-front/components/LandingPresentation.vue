<template>
  <div class="landingContacts">
    <h2 class="title">Презентация</h2>
    <iframe width="1470" height="744" :src="item.pdf_url" />
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
  background-color: #ffffff;

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

}
</style>
