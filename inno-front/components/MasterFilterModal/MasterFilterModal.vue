<template>
  <div class="fog">
    <div class="modal">
      <div class="header">
        <h2 class="title">[Мастер-фильтр]</h2>
        <p class="description">Мастер-фильтр поможет найти подходящие решения с помощью простых наводящих вопросов</p>
        <button class="closeButton" @click="$emit('close')"><img :src="require('./close.svg')"/></button>
      </div>
      <div class="content">
        <p class="question">{{ question }}</p>
        <div class="carousel">
          <div class="leftButtonWrapper">
            <button v-if='currentStage > 0' class="leftButton" @click='previousStage'><img :src="require('./left.svg')" /></button>
          </div>
          <div class='answers'>
            <button v-for="answer in answers" :key="answer.id" :class="answerClasses(answer.id)" @click="clickAnswer(answer.id)">{{ answer.text }}</button>
          </div>
          <div class="rightButtonWrapper">
            <button v-if='currentStage < lastStage' class="rightButton" @click='nextStage'><img :src="require('./right.svg')" /></button>
          </div>
        </div>
      </div>
      <button class="submitButton" @click="$emit('search', result)">
        Найти идеальное решение
      </button>
    </div>

  </div>
</template>

<script>
import { directions, certs, transport, project_stages } from '~/api/api';

const STAGE_LIST =  [
  {
    id: 'projectStages',
    question: "Проекты на какой стадии вас интересуют",
    answers:[
      {
        text: 'На этапе заявки',
        id: 2,
      },
      {
        text: 'На этапе пилотирования',
        id: 1,
      },
      {
        text: 'Не важно',
        id: '',
      },
    ]
  },
  {
    id:'transport',
    question: "Выберите приоритетную организацию будущего решения?",
    answers:[
      {
        text: 'Московский метрополитен',
        id: 1,
      },
      {
        text: 'Мосгорстранс',
        id: 2,
      },
      {
        text: 'ЦОДД',
        id: 3,
      },
      {
        text: 'Организатор перевозок',
        id: 4,
      },
      {
        text: 'Мостранспроект',
        id: 5,
      },
      {
        text: 'АМПП',
        id: 6
      },
      {
        text: 'Не важно',
        id: '',
      },
    ]
  },
  {
    id: 'direction',
    question: "Наиболее привлекательное направление",
    answers:[
      {
        text: 'Гор транспорт',
        id: 1,
      },
      {
        text: 'Мобильность',
        id: 2,
      },
      {
        text: 'Безопасность',
        id: 3,
      },
      {
        text: 'Экология',
        id: 4,
      },
      {
        text: 'ИТ',
        id: 5,
      },
      {
        text: 'Не важно',
        id: '',
      },
    ]
  },
];

export default {
  STAGE_LIST,
  data(){
    return {
      currentStage: 0,
      lastStage: 2,
      result: [
        {
          name: 'projectStages',
          id: null,
        },
        {
          name: 'transports',
          id: null,
        },
        {
          name: 'directions',
          id: null,
        },
      ],
      directionList: [],
      certList: [],
      transportList: [],
      projectStagesList: []
    }
  },
  async fetch(){
    this.directionList = await directions();
    this.transportList = await transport();
    this.projectStagesList = await project_stages();
  },
  computed:{
    question(){
      return STAGE_LIST[this.currentStage].question;
    },
    answers(){
      return STAGE_LIST[this.currentStage].answers;
    }
  },
  methods:{
    nextStage(){
      this.currentStage += 1;
    },
    previousStage(){
      this.currentStage -= 1;
    },
    clickAnswer(id){
      this.result[this.currentStage].id = id;
    },
    answerClasses(id){
      return {
        answer:this.result[this.currentStage].id !== id,
        activeAnswer:this.result[this.currentStage].id === id,
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.fog{
  position: fixed;
  top:0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(8px);


  .modal{
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    width: 1326px;
    height: 581px;
    padding: 50px;
    background-color: #ffffff;
    border-radius: 59px;
    box-shadow: 0px 10px 10px 4px rgba(0, 0, 0, 0.05);
  }

  .closeButton {
    position:absolute;
    right: 52px;
    top: 46px;
  }

  .answers{
    display: flex;
    height: 184px;
    align-items: center;
  }

  .title{
    font-weight: 300;
    font-size: 48px;
    line-height: 58px;
    color: #009A96;
    margin-bottom: 16px;


  }

  .answer{
    display: flex;
    width: 136px;
    height: 136px;
    margin-right: 40px;
    background-color: #F6F7FA;
    align-items: center;
    justify-content: center;
    text-align: center;
    cursor: pointer;

    &:last-child{
      margin-right: 0;
    }
  }

  .activeAnswer{
    display: flex;
    width: 136px;
    height: 136px;
    margin-right: 40px;
    background-color: #F6F7FA;
    align-items: center;
    justify-content: center;
    text-align: center;
    cursor: pointer;
    border: 2px #009A96 solid;
    &:last-child{
      margin-right: 0;
    }
  }

  .leftButtonWrapper{
    width: 48px;
    height: 48px;
  }

  .rightButtonWrapper{
    width: 48px;
    height: 48px;
  }

  .description{
    text-align: center;
    max-width: 368px;
    font-weight: 300;
    font-size: 18px;
    line-height: 27px;
    color: #374A59;
    margin-bottom: 60px;
  }

  .question{
    font-weight: 300;
    font-size: 36px;
    line-height: 44px;
    color: #25222C;
    margin: 0 auto;
  }

  .content{
    display: flex;
    flex-direction: column;

  }

  .carousel{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .submitButton{
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
