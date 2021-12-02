<template>
  <button class="fog">
    <div class="content">
      <h1>Вход в систему</h1>
      <input class="inputField" v-model="email" placeholder='Введите почту' type="text" />
      <input class="inputField" v-model="password" placeholder='Введите пароль' type="text" />
      <div class="field">
        <input type="checkbox" v-model="checkedNames">
        Запомнить меня
      </div>
      <button class="enterButton">Войти</button>
    </div>
  </button>
</template>

<script>
export default {
  data(){
    return {
      email: "",
      password: "",
      isRememberMe: false
    }
  }
}
</script>

<style lang="scss" scoped>
.content {
  position: absolute;
  width: 300px;
  background-color: #ffffff;
  left: 50%;
  top: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 28px 14px;
  transform: translate(-50%, -50%);
  border-radius: 8px;
}

.fog {
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  width: 100%;
  height: 100%;
  background-color: #121212;
  opacity: 0.8;
}

.inputField{
  padding: 10px 12px;
  margin-bottom: 12px;
  font-size: 16px;
  line-height: 24px;
  color: #101010;
  letter-spacing: 0.02em;
  border: 2px solid #101010;
  border-radius: 8px;
}
.enterButton{
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px 24px;
  font-size: 16px;
  line-height: 20px;
  color: #ffffff;
  background-color: #000000;
  border-radius: 8px;
}

.field{
  display: flex;
  font-size: 16px;
  line-height: 24px;
  align-items: center;
  margin-bottom: 12px;
}
</style>
