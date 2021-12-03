<template>
  <button class="fog">
    <div class="modal">
      <div class="header">
        <h1>{{ title }}</h1>

      </div>
      <div class="content">
        <p v-if='errorText' class="error">{{errorText}}</p>
        <div class="inputFields">
          <input v-if='isRegistration' class="inputField" v-model="firstName" placeholder='Введите имя' type="text" />
          <input v-if='isRegistration' class="inputField" v-model="lastName" placeholder='Введите фамилию' type="text"/>
          <input class="inputField" v-model="email" placeholder='Введите почту' type="text" />
          <input class="inputField" v-model="password" placeholder='Введите пароль' type="password"/>
          <input v-if='isRegistration' class="inputField" v-model="repeatPassword" placeholder='Повторите пароль' type="password"/>
        </div>


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
        <button class="enterButton" @click="isRegistration?signUp():signIn()">{{ buttonText }}</button>
      </div>
    </div>
  </button>
</template>

<script>
import { signUp, signIn, restore } from '~/api/api.js';
export default {
  data(){
    return {
      email: "",
      password: "",
      repeatPassword: "",
      isRememberMe: false,
      errorText: "",
      firstName: "",
      lastName: '',

      isRegistration: false,
    }
  },
  methods:{
    rememberPassword(){
      if(this.email === "" || !this.validateEmail){
        this.errorText = "Введите почту для восстановления"
      }else{
        alert('Вам на почту отправлено письмо для восстановления пароля');
        restore(this.email);
      }

    },
    signIn(){
      if(this.email === ""){
        this.errorText = "Введите почту";
      }
      else if(this.password === ""){
        this.errorText = "Введите пароль";
      }
      else{
        signIn(this.email, this.password).then((response) => {
          if(this.isRememberMe) localStorage.setItem('token', response.data.access_token);
          else document.cookie = `accessToken=${response.data.access_token}`
          this.$router.back()
        }).catch((error ) => {
          const response = error.response.data;
          if(response['email'] === "The email must be a valid email address."){
            this.errorText = 'Введите корректную почту'
          }else if(response['password'] === "The email must be a valid email address."){
            this.errorText = 'Введите корректный пароль'
          }else if(response['error'] === "Wrong Login or Password."){
            this.errorText = 'Неверный логин или пароль'
          }
        });
      }
    },
    signUp() {
      if(this.firstName === ""){
        this.errorText = 'Введите имя'
      }
      else if(this.lastName === ""){
        this.errorText = 'Введите фамилию'
      }
      else if(this.email === "" || !this.validateEmail(this.email)){
        this.errorText = 'Введите корректную почту'
      }
      else if(this.repeatPassword !== this.password){
        this.errorText = "Пароли не совпадают";
      }
      else if(!this.validatePassword(this.password)){
        this.errorText = "Пароль должен быть не менее 8 символов и должен иметь 1 большую, 1 маленькую букву, 1 цифру и 1 спец. символ.";
      }else{
        signUp(this.firstName, this.lastName, this.email, this.password, this.repeatPassword).then((response) => {
            this.$router.back()
        }).catch((error) => {
          if(error['email'] === "The email must be a valid email address."){
            this.errorText = 'Введите корректную почту'
          }else if(error['password'] === "The email must be a valid email address."){
            this.errorText = 'Введите корректный пароль'
          }else if(error['error'] === "Wrong Login or Password."){
            this.errorText = 'Неверный логин или пароль'
          }

        });
      }

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
  max-width: 180px;
  font-size: 12px;
  line-height: 18px;
  color: #ff0000;
  margin: 0 auto;
  margin-bottom: 12px;
}

.inputFields{
  display: flex;
  flex-direction: column;
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
  align-items: stretch;
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
  cursor: pointer;
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
