<template>
  <v-list
    nav
    dense
  >
    <v-list-item-group
      v-model="group"
      active-class="secondary--text text--accent-4"
    >
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-h6" />
          <v-list-item-subtitle>
            {{ title }}
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider />
      <v-list-item
        v-for="({ icon, name, route }, i) in items"
        :key="i"
        :href="$fosGenerate(route)"
      >
        <v-list-item-icon>
          <v-icon>{{ icon }}</v-icon>
        </v-list-item-icon>
        <v-list-item-title>{{ name }}</v-list-item-title>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</template>

<script>
import { mapState } from 'vuex';
import { MENU } from '../../store/module-namespaces';

export default {
  name: 'MobileNavList',
  props: {
    title: {
      type: String,
      required: true,
    },
  },
  data: () => ({
    group: null,
  }),
  computed: {
    ...mapState(MENU, ['items']),
  },
};
</script>

<style scoped>

</style>
