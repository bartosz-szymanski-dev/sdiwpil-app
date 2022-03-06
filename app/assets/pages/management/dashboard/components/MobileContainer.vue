<template>
  <v-container
    :style="{
      paddingTop: `${navbarHeight}px`,
      minHeight: `calc(100vh - ${footerHeight}px)`,
    }"
  >
    <app-background color-schema="management" />

    <route-screen
      header="Witaj w panelu administracji placówki medycznej"
      text="Poniższe odnośniki przestawiają możliwości oferowane przez system. Kliknij w jeden z nich, by rozpocząć akcję"
    />
  </v-container>
</template>

<script>
import AppBackground from '../../../../shared/components/AppBackground';
import RouteScreen from '../../../../shared/components/RouteScreen';

export default {
  name: 'MobileContainer',
  components: { RouteScreen, AppBackground },
  props: {
    navbarHeight: {
      type: Number,
      required: true,
    },
    footerHeight: {
      type: Number,
      required: true,
    },
  },
};
</script>

<style scoped>
.container {
  position: relative;
  z-index: 2;
  overflow-x: hidden;
}
</style>
