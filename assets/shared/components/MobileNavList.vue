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
        v-for="({ icon, name }, i) in items"
        :key="i"
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
    items: [
      {
        icon: 'mdi-home',
        name: 'Strona główna',
      },
      {
        icon: 'mdi-account',
        name: 'Strefa pacjenta',
      },
      {
        icon: 'mdi-doctor',
        name: 'Strefa lekarza',
      },
      {
        icon: 'mdi-account-group',
        name: 'Strefa recepcji',
      },
      {
        icon: 'mdi-account-tie',
        name: 'Strefa administracji',
      },
    ],
  }),
};
</script>

<style scoped>

</style>
