<template>
  <div>
    <v-container fluid>
      <app-background color-schema="management" />
    </v-container>

    <v-container
      :style="{
        paddingTop: `${navbarHeight}px`,
        minHeight: `calc(100vh - ${footerHeight}px)`,
      }"
    >
      <route-screen
        header="Witaj w panelu administracji placówki medycznej"
        text="Poniższe odnośniki przestawiają możliwości oferowane przez system. Kliknij w jeden z nich, by rozpocząć akcję"
      />
    </v-container>
  </div>
</template>

<script>
import AppBackground from '../../../../shared/components/AppBackground';
import RouteScreen from '../../../../shared/components/RouteScreen';

export default {
  name: 'DesktopContainer',
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

</style>
