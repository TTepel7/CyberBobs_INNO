<template>
  <div>
    Привет мир!<button @click='logout'>Выйти</button>
    {{ userData }}
  </div>
</template>

<script>
import { logout, getUserProfile } from '~/api/api';

export default {
  data(){
    return {
      userData: {},
    }
  },
  head(){
    return {
        title: 'Витрина',
      }
  },
  async fetch(){
    this.userData = await getUserProfile();
  },
  middleware: ['auth'],
  methods:{
    logout(){
      logout().then((response)=>{
        this.$router.push('/login');
      });
    }
  },
}
</script>
