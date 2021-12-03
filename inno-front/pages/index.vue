<template>
  <div v-if='startupList' class="indexPage">
    <Header >
      <button class="logoutButton" @click='logout'>Выйти</button>
    </Header>
    <SearchField class="searchField" v-model="searchText"
        placeholder="Начинайте вводить..." @update="getStartups" />

    <h1 class="title">[Витрина решений]</h1>
    <p class="description">{{ `${startupList.count} инновационных решений под любые ваши цели` }}</p>
    <div class="startupCards">
      <StartupCard v-for="item in startupList.items" :key='item.id' :item='item'/>
    </div>
    <FloatingPanel :active="showPanel" />
  </div>
</template>

<script>
import { logout, getUserProfile, startups } from '~/api/api';
import SearchField from '~/components/SearchField/SearchField.vue';
import StartupCard from '~/components/StartupCard.vue';
import FloatingPanel from '~/components/FloatingPanel.vue';
import Header from '~/components/Header.vue';

export default {
  components: {
    SearchField,
    StartupCard,
    Header,
    FloatingPanel,
  },
  data(){
    return {
      userData: {},
      searchText: '',
      startupList: null,
      timeout: false,
      showPanel: false,
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
  mounted () {
    document.addEventListener('scroll', this.scrollY)
  },
  destroyed () {
    document.removeEventListener('scroll', this.scrollY)
  },

  methods:{
    logout(){
      logout().then((response)=>{
        this.$router.push('/login');
      });
    },
    async getStartups(){
      if(!this.timeout) {
        this.timeout = true;
        await startups(this.searchText).then((response) => {
          this.startupList = response.data;
          setTimeout(()=>{ this.timeout = false}, 1000)
        })
      }
    },
    scrollY (event) {
      const scrollHeight = Math.max(
        document.body.scrollHeight, document.documentElement.scrollHeight,
        document.body.offsetHeight, document.documentElement.offsetHeight,
        document.body.clientHeight, document.documentElement.clientHeight
      )
      if (window.scrollY + document.body.clientHeight >= scrollHeight) {
        this.page++
      }
      console.log(window.scrollY)
      this.showPanel = window.scrollY > 3000;
    },
  },
}
</script>

<style lang="scss" scoped>
.indexPage{
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #F6F7FA;

  .startupCards{
    display: grid;
    flex-direction: row;
    flex-wrap: wrap;
    justify-items: center;
    grid-template-columns: repeat(2, 1fr);
    grid-row-gap: 82px;
    grid-column-gap: 106px;
    width: 100%;
    padding: 80px 0;
    margin-bottom: 312px;
    background-color: #ffffff;
  }

  .searchField{
    margin-top: 156px;
    margin-bottom: 36px;
  }

  .title{
    font-weight: 300;
    font-size: 48px;
    line-height: 58px;
    color: #25222C;
  }

  .description {
    font-weight: 300;
    font-size: 18px;
    line-height: 27px;
    color:  #374A59;
  }

  .logoutButton{
    padding: 6px 24px;
    font-size: 18px;
    line-height: 36px;
    background-color: #009A96;
    border-radius: 8px;
    margin-right: 24px;
    color: #ffffff;
  }
}


</style>
