<template>
  <button class="fog">
    <div class="modal">
      <div class="header">
        <p>{{ title }}</p>

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
        <div v-if='!isRegistration' class="field right">
          <a class="rememberPassword" @click="rememberPassword" >Забыли пароль?</a>
        </div>


        <div v-if="!isRegistration" class="field rememberMe" @click="isRememberMe = !isRememberMe">
          <input type="checkbox" v-model="isRememberMe">
          Запомнить меня
        </div>


        <button class="enterButton" @click="isRegistration?signUp():signIn()">{{ buttonText }}</button>
        <div class="field" @click="testSignIn">
          Войти под тестовым аккаунтом
        </div>
        <div class="field">
          <p>{{ supportText }}</p>
          <a class="registrationSwitch" @click="isRegistration = !isRegistration">{{ registrationSwitch }}</a>
        </div>
      </div>
    </div>
  </button>
</template>

<script>
import { signUp, signIn, restore,testSignIn } from '~/api/api.js';
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
    testSignIn(){
      testSignIn().then((response)=>{
        localStorage.setItem('token', response.data.access_token);

        this.$router.replace({ name: 'index'} )
      })
    },
    signIn(){
      if(this.email === ""){
        this.errorText = "Введите почту";
      }
      else if(this.password === ""){
        this.errorText = "Введите пароль";
      }
      else{
        this.errorText = '';
        signIn(this.email, this.password).then((response) => {

          if(this.isRememberMe) {

            localStorage.setItem('token', response.data.access_token);
            localStorage.setItem('tokenUpdated', Date.now());
          }
          else{
            document.cookie = `accessToken=${response.data.access_token}`
            document.cookie = `tokenUpdated=${Date.now()}`
          }
          this.$router.replace({ name: 'index'} )
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
        this.isRegistration= false;

        signUp(this.firstName, this.lastName, this.email, this.password, this.repeatPassword).then((response) => {
          this.$router.replace({ name: 'index'} )

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
      return this.isRegistration?'Войти?':'Зарегистрироваться?';
    },
    supportText(){
      return this.isRegistration?'Есть аккаунт?':'Нет аккаунта?';
    },
    title(){
      return this.isRegistration?'[Регистрация]':'[Вход в систему]';
    }
  }
}
</script>

<style lang="scss" scoped>

.error{
  max-width: 180px;
  font-size: 14px;
  line-height: 18px;
  color: #ff0000;
  margin: 0 auto;
  margin-bottom: 12px;
}

.inputFields{
  display: flex;
  flex-direction: column;
}

.right{
  justify-content: flex-end;
}

.header{
  display: flex;
  align-items: center;
  font-size: 24px;
  line-height: 29px;
  color: #009A96;
}
.modal {
  position: absolute;
  background-color: #ffffff;
  left: 50%;
  top: 50%;
  width: 600px;
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
  width: 234px;
  padding: 10px 12px;
  margin-bottom: 20px;
  font-size: 16px;
  line-height: 24px;
  border: 1px solid #009A96;
  box-sizing: border-box;
  color: #101010;
  letter-spacing: 0.02em;
  border-radius: 48px;

  &:focus{
    outline: 0;
  }
}

.enterButton{
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px 24px;
  font-size: 16px;
  line-height: 20px;
  color: #ffffff;
  background-color: #009A96;
  border-radius: 8px;
  cursor: pointer;
}

.field{
  display: flex;
  font-size: 16px;
  line-height: 24px;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
}

.rememberPassword{
  font-weight: 300;
  font-size: 14px;
  line-height: 17px;
  cursor: pointer;
  color: #009A96;
  margin-left: auto;

}

.registrationSwitch{
  font-size: 14px;
  line-height: 17px;
  text-decoration-line: underline;

  color: #009A96;
  cursor: pointer;
}

.rememberMe{
  font-size: 14px;
  line-height: 17px;
  color: #25222C;
  margin-right: auto;

}
</style>
