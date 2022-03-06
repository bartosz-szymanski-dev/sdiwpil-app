<template>
  <v-container
    :style="{
      paddingTop: `${navbarHeight}px`,
      minHeight: `calc(100vh - ${footerHeight}px)`,
    }"
  >
    <app-background color-schema="receptionist" />

    <route-screen
      header="Zarządzanie rejestracją użytkowników"
      text="Na poniższej liście znajdują się oczekujące prośby akceptacji o rejestrację. Zweryfikuj dane i zaakceptuj lub odrzuć dane podanie."
    />
  </v-container>
</template>

<script>
import AppBackground from '../../../../shared/components/AppBackground';
import RouteScreen from '../../../../shared/components/RouteScreen';

export default {
  name: 'MobileContainer',
  components: { AppBackground, RouteScreen },
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
