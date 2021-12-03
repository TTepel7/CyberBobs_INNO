<template>
  <div>
    <Auth />
  </div>
</template>

<script>
import Auth from "~/components/Auth.vue";
export default {
  components:{
    Auth,
  },
  head(){
    return {
        title: 'Вход в систему',
      }
  }
}
</script>
