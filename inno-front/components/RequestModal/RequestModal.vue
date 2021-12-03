<template>
  <div class="fog">
    <div class="modal">
      <div class="header">
        <h2 class="title">[Запрос на инновацию]</h2>
        <p class="description">Заполните поля формы и опишите главные проблемы, требования и пожелания, чтобы мы смогли решить вашу задачу </p>
        <button class="closeButton" @click="$emit('close')"><img :src="require('./close.svg')"/></button>
      </div>
      <div class='carousel'>
        <div class="leftButtonWrapper">
          <button v-if='currentStage > 0' class="leftButton" @click='previousStage'><img :src="require('./left.svg')" /></button>
        </div>
        <div class="content" v-if='currentStage === 0'>
          <div class="field">
            <div class="fieldName">Что болит?</div>
            <div class="fieldDescription">Опишите своими словами существующую в организации проблему. Можно сформулировать проблему в форме задачи</div>
            <input type='text' class="fieldInput">
          </div>
          <div class="field">
            <div class="fieldName">Как проявляется ваша проблема?</div>
            <div class="fieldDescription">Приведите описание реальной ситуации, в которой бы проблема проявилась</div>
            <input type='text' class="fieldInput">
          </div>
          <div class="field">
            <div class="fieldName">Что будет если проблему не решать?</div>
            <div class="fieldDescription">Опишите нежелательные эффекты, которые возникают или могут возникнуть из-за того, что проблема не решается</div>
            <input type='text' class="fieldInput">
          </div>
        </div>
        <div class="content" v-if='currentStage === 1'>
          <div class="field">
            <div class="fieldName">Почему так происходит?</div>
            <div class="fieldDescription">Опишите своими словами существующую в организации проблему. Можно сформулировать проблему в форме задачи</div>
            <input type='text' class="fieldInput">
          </div>
          <div class="field">
            <div class="fieldName">У кого болит?</div>
            <div class="fieldDescription">Приведите описание реальной ситуации, в которой бы проблема проявилась</div>
            <input type='text' class="fieldInput">
          </div>
          <div class="field">
            <div class="fieldName">Пробовали решить?</div>
            <div class="fieldDescription">Опишите нежелательные эффекты, которые возникают или могут возникнуть из-за того, что проблема не решается</div>
            <input type='text' class="fieldInput">
          </div>
        </div>
        <div class="content" v-if='currentStage === 2'>
          <div class="field">
            <div class="fieldName">Желаемый срок решения проблемы? </div>
            <div class="emojiList">
              <div class='item'>
                <img class='emoji' :src="require('./emoji1.png')"/>
                <p class='emojiTitle'>Даже не знаю</p>
              </div>
              <div class='item'>
                <img class='emoji' :src="require('./emoji2.png')" />
                <p class='emojiTitle'>Да подождёт</p>
              </div>
              <div class='item'>
                <img class='emoji' :src="require('./emoji3.png')"/>
                <p class='emojiTitle'>Поскорее бы...</p>
              </div>
              <div class='item'>
                <img class='emoji' :src="require('./emoji4.png')"/>
                <p class='emojiTitle'>Так-то срочно</p>
              </div>
              <div class='item'>
                <img class='emoji' :src="require('./emoji5.png')"/>
                <p class='emojiTitle'>Сроки горят!</p>
              </div>
            </div>
          </div>
          <div class="field">
              <div class="fieldName">Как с вами связаться</div>
              <div class="group">
                <p class="groupName">Наименование вашего предприятия</p>
                <input type="text" class="groupInput" />
              </div>
              <div class="group">
                <p class="groupName">Ваши ФИО</p>
                <input type="text" class="groupInput" />
              </div>
              <div class="group">
                <p class="groupName">Телефон для связи</p>
                <input type="text" class="groupInput" />
              </div>
              <div class="group">
                <p class="groupName">Или укажите любой другой предпочтительный способ связи</p>
                <input type="text" class="groupInput" />
              </div>
          </div>
          <button class="submitButton" @click="$emit('send')">Оставить запрос</button>
        </div>
        <div class="rightButtonWrapper">
          <button v-if='currentStage < lastStage' class="rightButton" @click='nextStage'><img :src="require('./right.svg')" /></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>


export default {
  data(){
    return {
      currentStage: 0,
      lastStage: 2,

    }
  },
  async fetch(){
    this.directionList = await directions();
    this.certList = await certs();
    this.transportList = await transport();
    this.projectStagesList = await project_stages();
  },
  computed:{
    question(){
      return STAGE_LIST[this.currentStage].question;
    },
    answers(){
      if(this.currentStage === 0){
        return this.projectStagesList.data;
      }else if(this.currentStage === 1){
        return this.transportList.data;
      }else if(this.currentStage === 2){
        return this.directionList.data;
      }else{
        return this.certList.data;
      }
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
    width: 1326px;
    height: 800px;
    padding: 50px;
    background-color: #ffffff;
    border-radius: 59px;
    box-shadow: 0px 10px 10px 4px rgba(0, 0, 0, 0.05);
  }

  .carousel{
    display: flex;
    align-items: center;
  }

  .field{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 26px;
    max-width: 656px;;
  }

  .fieldName{
    font-size: 36px;
    line-height: 43px;
    color: #25222C;
    margin-bottom: 14px;
  }

  .fieldDescription{
    font-size: 18px;
    line-height: 15px;
    text-align: center;
    color: #374A59;
    margin-bottom: 14px;
  }

  .content{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0 36px;
  }

  .fieldInput{
    width: 656px;
    height: 74px;
    padding: 0 26px;
    font-size: 18px;
    line-height: 15px;
    color: #374A59;
    background: #F6F7FA;
    border-radius: 16px 0px 0px 16px;
  }
  .groupInput{
    width: 656px;
    height: 36px;
    padding: 0 26px;
    font-size: 18px;
    line-height: 15px;
    color: #374A59;
    background: #F6F7FA;
    border-radius: 16px 0px 0px 16px;
  }

  .closeButton {
    position:absolute;
    right: 52px;
    top: 46px;
  }

  .title{
    font-weight: 300;
    font-size: 48px;
    line-height: 58px;
    color: #009A96;
    margin: 0;
  }

  .name{
    font-weight: 300;
    font-size: 36px;
    line-height: 44px;
    color: #25222C;
  }

  .item{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-right: 16px;
    &:last-child{
      margin-right: 0;
    }

  }

  .emojiList{
    display: flex;
  }

  .emoji{
    width: 36px;
    height: 36px;
    margin-bottom: 16px;
  }

  .emojiName{
    font-weight: 300;
    font-size: 18px;
    line-height: 27px;
    text-align: justify;
    color: #374A59;
  }


  .description {
    font-size: 18px;
    line-height: 27px;
    text-align: center;
    color: #374A59;
  }

  .header{
    display: flex;
    flex-direction: column;
    align-items: center;
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
