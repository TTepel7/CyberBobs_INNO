<template>
  <div class="searchField">
    <div class="content">
      <img class="icon" :src="require('./search.svg')"/>
      <input
        class="input"
        type="text"
        v-bind="$attrs"
        @input="$emit('update', $event.target.value)"
        v-on="$listeners"
      />
    </div>
    <button class="button">Найти идеальное решение</button>
  </div>
</template>

<script>
export default {
  model: {
    prop: 'text',
    event: 'update',
  },
  props:{
    text: {
      type: String,
      required: true,
    }
  },
}
</script>

<style lang="scss" scoped>
.searchField{
  display: flex;
  justify-content: space-between;
  width: 926px;
  border-radius: 48px;
  box-shadow: 0px 10px 10px 2px rgba(0, 0, 0, 0.05);
}

.icon{
  margin-right: 14px;
}

.input {
  font-weight: 300;
  font-size: 24px;
  line-height: 29px;

  &:focus {
    outline: none;
  }
}

.content{
  display:flex;
  margin-left: 20px;
}

.button{
  height: 100%;
  padding: 20px 42px;
  font-weight: 300;
  font-size: 24px;
  line-height: 29px;
  color: #ffffff;
  background-color: #009A96;
  border-radius: 48px;
}

</style>
