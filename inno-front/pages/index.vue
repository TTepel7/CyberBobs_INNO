<template>
  <div>
    <button @click='logout'>Выйти</button>
    <SearchField v-model="searchText"
        placeholder="Начинайте вводить..." />
    {{ searchText }}
  </div>
</template>

<script>
import { logout, getUserProfile } from '~/api/api';
import SearchField from '~/components/SearchField/SearchField.vue';

export default {
  components: {
    SearchField
  },
  data(){
    return {
      userData: {},
      searchText: '',
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
