<template>
  <v-app class="home-page--bg">
    <app-navbar ref="navbar" />

    <mobile-container
      v-if="breakpoint.mdAndDown"
      :navbar-height="navbarHeight"
      :footer-height="footerHeight"
    />

    <main-container
      :navbar-height="navbarHeight"
      :footer-height="footerHeight"
    />

    <app-footer ref="footer" />
  </v-app>
</template>

<script>
import AppNavbar from '../../../shared/components/AppNavbar';
import AppFooter from '../../../shared/components/AppFooter';
import MobileContainer from './MobileContainer';
import MainContainer from './MainContainer';
import breakpoint from '../../../mixins/breakpoint';

export default {
  name: 'HomePage',
  components: {
    AppNavbar, AppFooter, MobileContainer, MainContainer,
  },
  mixins: [breakpoint],
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
@import 'assets/styles/colors';

.container {
  position: relative;
  z-index: 2;
  overflow-x: hidden;
}

.home-page {
  &--bg {
    background-color: rgba($primary, 0.2);
  }
}
</style>
