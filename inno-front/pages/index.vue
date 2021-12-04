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
      <div class='divider'></div>
      <button :class="pilotClasses(1)" @click="pilotClick(1)">
        Пилот
      </button>
       <button :class="pilotClasses(2)" @click="pilotClick(2)">
        Идея
      </button>
    </div>
    <div class="filters">

    </div>
    <div class="startupCards">
      <StartupCard v-for="item in startupList" :key='item.id' :item='item'/>
    </div>
    <FloatingPanel :active="showPanel" @showMaster="showModal = true" @showRequest="showRequestModal = true" />
    <MasterFilterModal v-if='showModal' @close="showModal = false" @search='masterFilterSearch'/>
    <RequestModal v-if='showRequestModal' @close="showRequestModal = false" @send='showRequestModal = false'/>
  </div>
</template>

<script>
import { logout, getUserProfile, startups, directions } from '~/api/api';
import SearchField from '~/components/SearchField/SearchField.vue';
import StartupCard from '~/components/StartupCard.vue';
import FloatingPanel from '~/components/FloatingPanel.vue';
import Header from '~/components/Header.vue';
import MasterFilterModal from '~/components/MasterFilterModal/MasterFilterModal.vue';
import RequestModal from '~/components/RequestModal/RequestModal.vue';

export default {
  components: {
    SearchField,
    StartupCard,
    Header,
    FloatingPanel,
    MasterFilterModal,
    RequestModal,
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
      showRequestModal: false,
      currentFilter: null,
      pilot: null,
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
    },
    pilot(){
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

      result.forEach((item) => {
        if(item.name === 'directions'){
          this.currentFilter = item.id;
        }else if(item.name === 'transport'){
          transport = item.id;
        }else if(item.name === 'projectStages'){
          this.pilot = item.id
        }
        startups(this.searchText, this.page + 1, this.currentFilter, projectStage, transport, cert, this.pilot).then((response) => {
          this.page = 0;
          this.startupList = [];
          this.searchText = '';
          this.startupList = this.startupList.concat(response.data.items);
          this.count = response.data.count;
          this.endPage = response.data.total_page;
            setTimeout(()=>{ this.timeout = false}, 1000)
        })
        this.showModal = false;
      });

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
        await startups(this.searchText, this.page + 1, this.currentFilter, '', '', '', this.pilot).then((response) => {
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
    pilotClick(id){
      this.page = 0;
      this.startupList = [];
      if(id === this.pilot){
        this.pilot = '';
      }else{
        this.pilot = id;
      }
    },
    filterClasses(id){
      return {
        filter: id !== this.currentFilter,
        activeFilter: id === this.currentFilter,
      }
    },
    pilotClasses(id){
      return {
        filter: id !== this.pilot,
        activeFilter: id === this.pilot,
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

  .divider{
    border-left: 1px solid #009A96;
    height: 32px;
    margin: 0 10px;
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
