<template>
  <div>
    <v-container fluid>
      <main-background />
    </v-container>

    <v-container
      :style="{
        paddingTop: `${navbarHeight}px`,
        minHeight: `calc(100vh - ${footerHeight}px)`,
      }"
    >
      <main-screen :is-mobile="false" />

      <main-functions class="pt-12" />
    </v-container>
  </div>
</template>

<script>
import MainBackground from './MainBackground';
import MainScreen from './MainScreen';
import MainFunctions from './MainFunctions';

export default {
  name: 'MainContainer',
  components: { MainScreen, MainBackground, MainFunctions },
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
