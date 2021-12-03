<template>
  <div v-if='startupList' class="indexPage">
    <Header >
      <button class="logoutButton" @click='logout'>Выйти</button>
    </Header>
    <SearchField class="searchField" v-model="searchText"
        placeholder="Начинайте вводить..." @update="filter" />

    <h1 class="title">[Витрина решений]</h1>
    <p class="description">{{ `${count} инновационных решений под любые ваши цели` }}</p>
    <div class="filters">
      <button v-for="direction in directionList" :key="direction.id" :class="filterClasses(direction.id)" @click="directionClick(direction.id)">
        {{ direction.alias }}
      </button>
    </div>
    <div class="startupCards">
      <StartupCard v-for="item in startupList" :key='item.id' :item='item'/>
    </div>
    <FloatingPanel :active="showPanel" @showMaster="showModal = true" />
    <MasterFilterModal v-if='showModal' @close="showModal = false" @search='masterFilterSearch'/>
  </div>
</template>

<script>
import { logout, getUserProfile, startups, directions } from '~/api/api';
import SearchField from '~/components/SearchField/SearchField.vue';
import StartupCard from '~/components/StartupCard.vue';
import FloatingPanel from '~/components/FloatingPanel.vue';
import Header from '~/components/Header.vue';
import MasterFilterModal from '~/components/MasterFilterModal/MasterFilterModal.vue';

export default {
  components: {
    SearchField,
    StartupCard,
    Header,
    FloatingPanel,
    MasterFilterModal,
  },
  data(){
    return {
      userData: {},
      searchText: '',
      startupList: [],
      directionList: [],
      count: 0,
      endPage: 0,
      timeout: false,
      showPanel: false,
      showModal: false,
      currentFilter: null,
      page: 0,
    }
  },
  head(){
    return {
      title: 'Витрина',
    }
  },
  watch:{
    page(){
      this.getStartups()
    },
    currentFilter(){
      this.getStartups()
    }
  },
  async fetch(){
    await this.getStartups()
    await this.getDirections()
  },
  middleware: ['auth'],
  mounted () {
    document.addEventListener('scroll', this.scrollY)
  },
  destroyed () {
    document.removeEventListener('scroll', this.scrollY)
  },

  methods:{
    async masterFilterSearch(result){

      let projectStage;
      let transport;
      let cert;
      this.page = 0;
      this.startupList = [];
      this.searchText = '';
      result.forEach((item) => {

        if(item.name === 'directions'){
          this.currentFilter = item.id;
        }else if(item.name === 'certs'){
          cert = item.id;
        }else if(item.name === 'transport'){
          transport = item.id;
        }else{
          projectStage = item.id;
        }

      });
      await startups(this.searchText, this.page + 1, this.currentFilter, projectStage, transport, cert).then((response) => {
        this.startupList = this.startupList.concat(response.data.items);
        this.count = response.data.count;
        this.endPage = response.data.total_page;
          setTimeout(()=>{ this.timeout = false}, 1000)
      })
      this.showModal = false;
    },
    logout(){
      logout().then((response)=>{
        this.$router.push('/login');
      });
    },
    filter(){
      this.page = 0;
      this.startupList = [];
      this.getStartups();
    },
    async getStartups(){
      if(!this.timeout) {
        this.timeout = true;
        await startups(this.searchText, this.page + 1, this.currentFilter).then((response) => {
          this.startupList = this.startupList.concat(response.data.items);
          this.count = response.data.count;
          this.endPage = response.data.total_page;
          setTimeout(()=>{ this.timeout = false}, 1000)
        })
      }
    },
    async getDirections(){
      directions().then((response) => {
        this.directionList = response.data
      });
    },
    directionClick(id){
      this.page = 0;
      this.startupList = [];
      if(id === this.currentFilter){
        this.currentFilter = '';
      }else{
        this.currentFilter = id;
      }
    },
    filterClasses(id){
      return {
        filter: id !== this.currentFilter,
        activeFilter: id === this.currentFilter,
      }
    },
    scrollY (event) {
      const scrollHeight = Math.max(
        document.body.scrollHeight, document.documentElement.scrollHeight,
        document.body.offsetHeight, document.documentElement.offsetHeight,
        document.body.clientHeight, document.documentElement.clientHeight

      )
      if (window.scrollY + window.innerHeight >= scrollHeight && this.page+1 <= this.endPage) {
        this.page++
      }
      this.showPanel = window.scrollY > 1500;
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
  overflow: hidden;

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

  .filters{
    display: flex;
    flex-direction: row;
    margin-bottom: 32px;
  }

  .searchField{
    margin-top: 60px;
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

  .filter{
    padding: 4px 6px;
    font-weight: 300;
    font-size: 14px;
    line-height: 20px;
    color: #25222C;
    box-sizing: border-box;
    border-radius: 43px;
    margin-right: 6px;
    margin-bottom: 4px;
    cursor: pointer;
  }

  .activeFilter {
    padding: 4px 6px;
    font-weight: 300;
    font-size: 14px;
    line-height: 20px;
    color: #ffffff;
    background-color: #009A96;
    box-sizing: border-box;
    border-radius: 43px;
    margin-right: 6px;
    margin-bottom: 4px;
    cursor: pointer;
  }
}

@media (max-width: 1600px) {
  .indexPage{
    .startupCards{
      grid-template-columns: repeat(1, 1fr);
    }
  }
}


</style>
