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
}
</style>
