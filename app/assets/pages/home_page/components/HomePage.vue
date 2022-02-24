<template>
  <v-app class="home-page--bg">
    <app-navbar ref="navbar" />

    <v-container
      :style="{
        paddingTop: `${navbarHeight}px`,
        minHeight: `calc(100vh - ${footerHeight}px)`,
      }"
    >
      <main-screen class="home-page--main" />

      <v-row class="home-page--row">
        <v-col
          sm="6"
          class="pb-0"
        >
          <main-img />
        </v-col>

        <v-col
          cols="12"
          class="pt-0"
        >
          <main-functions />
        </v-col>
      </v-row>
    </v-container>

    <app-footer ref="footer" />
  </v-app>
</template>

<script>
import AppNavbar from '../../../shared/components/AppNavbar';
import AppFooter from '../../../shared/components/AppFooter';
import MainScreen from './MainScreen';
import MainImg from './MainImg';
import MainFunctions from './MainFunctions';

export default {
  name: 'HomePage',
  components: {
    MainFunctions, AppNavbar, MainScreen, MainImg, AppFooter,
  },
  data: () => ({
    navbarHeight: 0,
    footerHeight: 0,
  }),
  mounted() {
    this.navbarHeight = this.getNavbarHeight();
    this.footerHeight = this.getFooterHeight();
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
    getFooterHeight() {
      const { footer } = this.$refs;
      if (footer) {
        return footer.$el.clientHeight;
      }

      return 0;
    },
  },
};
</script>

<style scoped lang="scss">
@import 'assets/styles/app';

.container {
  position: relative;
  z-index: 2;
  overflow-x: hidden;
}

.home-page {
  &--bg {
    background-color: rgba($primary, 0.2);
  }

  &--main {
    margin-bottom: 32px;

    @media (min-width: $sm) {
      margin-bottom: 64px;
    }
  }

  &--row {
    justify-content: center;
  }
}
</style>
