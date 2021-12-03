<template>
  <div :class="classes">
    <p class="title">Я не нашёл нужное решение</p>
    <div class="buttons">
      <button class="button" @click="$emit('showMaster')">Воспользоваться мастер-фильтром</button>
      <button class="button_outline">Оставить запрос</button>
    </div>
  </div>
</template>

<script>
export default {
  props:{
    active:{
      type: Boolean,
      default: false,
    }
  },
  computed:{
    classes(){
      return {floatingPanel: true, ["_active"]: this.active };
    }
  }
}
</script>

<style lang="scss" scoped>
.floatingPanel{
  position: fixed;
  display: flex;
  flex-direction: column;
  width: 1012px;
  height: 176px;
  bottom: 86px;
  left: 50%;
  transform: translateX(-50%);
  padding: 22px 26px;
  background: rgba(255, 255, 255, 0.77);
  backdrop-filter: blur(8px);
  border-radius: 46px;
  opacity: 0;
  transition: opacity 0.3s ease-out;

  &._active{
    opacity: 1;
  }

  .title{
    font-weight: 300;
    font-size: 48px;
    line-height: 58px;
    color: #25222C;
    margin: auto;
  }

  .buttons {
    display: flex;
    justify-content: space-between;
  }

  .button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 454px;
    height: 68px;
    color: #ffffff;
    background-color: #009A96;
    border: 1px solid transparent;
    font-weight: 300;
    font-size: 24px;
    line-height: 29px;
    border-radius: 48px;
  }
  .button_outline{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 454px;
    height: 68px;
    color: #25222C;
    background-color: #ffffff;
    border: 1px solid #009A96;
    font-weight: 300;
    font-size: 24px;
    line-height: 29px;
    border-radius: 48px;
  }
}
</style>
