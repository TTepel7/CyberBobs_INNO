<template>
  <div class="fog"></div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.fog{
  position: absolute;
  top:0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(0deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1));
  filter: blur(43px);
}
</style>
