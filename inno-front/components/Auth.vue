<template>
  <button class="fog">
    <div class="modal">
      <div class="header">
        <h1>{{ title }}</h1>
      </div>
      <div class="content">
        <input class="inputField" v-model="email" placeholder='Введите почту' type="text" />
        <input class="inputField" v-model="password" placeholder='Введите пароль' type="password"/>
        <input v-if='isRegistration' class="inputField" v-model="repeatPassword" placeholder='Повторите пароль' type="password"/>
        <p v-if='errorText' class="error">{{errorText}}</p>
        <div v-if="!isRegistration" class="field" @click="isRememberMe = !isRememberMe">
          <input type="checkbox" v-model="isRememberMe">
          Запомнить меня
        </div>
        <div v-if='!isRegistration' class="field">
          <a class="rememberPassword" @click="rememberPassword" >Забыли пароль?</a>
        </div>
        <div class="field">
          <a class="registrationSwitch" @click="isRegistration = !isRegistration">{{ registrationSwitch }}</a>
        </div>
        <button class="enterButton" @click="signUp">Войти</button>
      </div>
    </div>
  </button>
</template>

<script>
import { auth } from '~/api/api.js';
export default {
  async fetch(){
    const data = await auth();
    console.log(data);
  },
  data(){
    return {
      email: "",
      password: "",
      repeatPassword: "",
      isRememberMe: false,
      errorText: "",

      isRegistration: false,
    }
  },
  methods:{
    rememberPassword(){
      console.log("rememberPass");
    },
    signIn(){
      this.errorText = "Неверный логин или пароль";
      alert('Ты не вошёл!');
    },
    signUp(){
      if(repeatPassword)
      this.errorText = "Неверный логин или пароль";
      alert('Ты не вошёл!');
    },
    validateEmail(email){
      const pattern = /[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/;
      return pattern.test(email);
    },
    validatePassword(password){
      const pattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/;
      return pattern.test(password);
    },
  },
  computed:{
    buttonText(){
      return this.isRegistration?'Зарегистрироваться':'Войти';
    },
    registrationSwitch(){
      return this.isRegistration?'Или нужно войти?':'Или нужно зарегистрироваться?';
    },
    title(){
      return this.isRegistration?'Регистрация':'Вход в систему';
    }
  }
}
</script>

<style lang="scss" scoped>

.error{
  font-size: 12px;
  line-height: 18px;
  color: #ff0000;
}

.header{
  display: flex;
  align-items: center;
}
.modal {
  position: absolute;
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

.content{
  display: flex;
  flex-direction: column;
  padding: 0 24px;
  align-items: flex-start;
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

.rememberPassword{
  cursor: pointer;
}

.registrationSwitch{
  cursor: pointer;
}
</style>
