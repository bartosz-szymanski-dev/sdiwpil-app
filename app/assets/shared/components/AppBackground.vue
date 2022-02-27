<template>
  <div class="background" />
</template>

<script>
export default {
  name: 'AppBackground',
};
</script>

<style scoped lang="scss">
@import '../../styles/breakpoints';

.background {
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 150%;
  height: 360px;
  border-radius: 0 0 50% 50%;
  background: linear-gradient(180deg, rgba(0, 206, 200, 1) 0%, rgba(53, 166, 230, 1) 100%);
  z-index: -1;

  @media (min-width: $md) {
    height: 460px;
  }
}
</style>
