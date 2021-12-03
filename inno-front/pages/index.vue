<template>
  <div>
    <button @click='logout'>Выйти</button>
    {{ this.startups }}
    <SearchField v-model="searchText"
        placeholder="Начинайте вводить..." @update="getStartups" />
    <div class="startupCards">
      <StartupCard v-for="item in startupList" :key='item.id' :item='item'/>
    </div>
  </div>
</template>

<script>
import { logout, getUserProfile, startups } from '~/api/api';
import SearchField from '~/components/SearchField/SearchField.vue';
import StartupCard from '~/components/StartupCard.vue';

export default {
  components: {
    SearchField,
    StartupCard,
  },
  data(){
    return {
      userData: {},
      searchText: '',
      startupList: null,
    }
  },
  head(){
    return {
      title: 'Витрина',
    }
  },
  async fetch(){
    await this.getStartups()
  },
  middleware: ['auth'],
  methods:{
    logout(){
      logout().then((response)=>{
        this.$router.push('/login');
      });
    },
    async getStartups(){
      await startups(this.searchText).then((response) => {
        this.startupList = response.data;
      })
    }
  },
}
</script>

<style lang="scss" scoped>
.startupCards{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
</style>
