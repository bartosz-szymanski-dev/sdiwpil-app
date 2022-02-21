<template>
  <v-app>
    <app-navbar
      ref="navbar"
    />
    <v-container
      :style="{paddingTop: `${navbarHeight}px`}"
    >
      <main-screen />
    </v-container>
  </v-app>
</template>

<script>
import AppNavbar from '../../../shared/components/AppNavbar';
import MainScreen from './MainScreen';

export default {
  name: 'HomePage',
  components: { AppNavbar, MainScreen },
  data: () => ({
    navbarHeight: 0,
  }),
  mounted() {
    this.navbarHeight = this.getNavbarHeight();
  },
  methods: {
    getNavbarHeight() {
      const { navbar } = this.$refs;
      if (navbar) {
        const firstChild = navbar.$children[0];

        return firstChild.$el ? firstChild.$el.clientHeight + 12 : 0;
      }

      return 0;
    },
  },
};
</script>

<style scoped lang="scss">
.container {
  position: relative;
  z-index: 2;
}
</style>
