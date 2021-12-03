<template>
  <div class="header">
    <slot />
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.header{
  display: flex;
  justify-content: flex-end;
  padding: 24px 0;
  width: 100%;
  box-shadow: 0px 10px 10px 2px rgba(0, 0, 0, 0.05);
}
</style>
