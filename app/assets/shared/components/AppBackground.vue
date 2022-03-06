<template>
  <div :class="classes" />
</template>

<script>
export default {
  name: 'AppBackground',
  props: {
    colorSchema: {
      type: String,
      default: 'patient',
      validator: (value) => ['patient', 'doctor', 'receptionist', 'management'].includes(value),
    },
  },
  computed: {
    classes() {
      switch (this.colorSchema) {
        case 'doctor':
          return 'background background-doctor';
        case 'receptionist':
          return 'background background-receptionist';
        default:
          return 'background';
      }
    },
  },
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

  &-doctor {
    background: linear-gradient(180deg, rgba(53, 166, 230, 1) 0%, rgba(0, 206, 200, 1) 100%);
  }

  &-receptionist {
    background: linear-gradient(180deg, #4774FC 0%, rgba(0, 206, 200, 1) 100%);
  }
}
</style>
