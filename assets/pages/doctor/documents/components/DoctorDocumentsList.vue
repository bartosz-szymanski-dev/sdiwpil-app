<template>
  <v-data-table
    :headers="headers"
    :items="documents"
    no-data-text="Nie utworzono dokumentów"
    :options.sync="options"
    :footer-props="{
      'items-per-page-text': 'Ilość wierszy na stronie',
      'items-per-page-options': rowsPerPageItems,
      'page-text': '{0}-{1} z {2}',
    }"
  >
    <template #top>
      <v-toolbar flat>
        <v-toolbar-title>Lista dokumentów</v-toolbar-title>

        <v-spacer />

        <v-dialog
          v-model="isNewDialogOpen"
          persistent
          max-width="500px"
          @keydown.esc="isNewDialogOpen = false"
        >
          <template #activator="{ on, attrs }">
            <v-btn
              color="secondary"
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Stwórz dokument
            </v-btn>
          </template>

          <new-document-form />
        </v-dialog>
      </v-toolbar>
    </template>

    <template #item.actions="{ item }">
      <v-btn
        text
        color="primary"
      >
        <v-icon>mdi-file-find</v-icon>
      </v-btn>

      <v-btn
        text
        color="warning"
      >
        <v-icon>mdi-file-edit</v-icon>
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import { get } from 'lodash';
import NewDocumentForm from './Forms/NewDocumentForm';

export default {
  name: 'DoctorDocumentsList',
  components: { NewDocumentForm },
  data: () => ({
    headers: [
      {
        text: 'Typ dokumentu',
        sortable: false,
        value: 'type',
      },
      {
        text: 'Pacjent',
        sortable: false,
        value: 'patient',
      },
      {
        text: 'Akcje',
        sortable: false,
        value: 'actions',
      },
    ],
    options: {
      itemsPerPage: 25,
      page: 1,
    },
    rowsPerPageItems: [25, 50, 100, 250],
    isNewDialogOpen: false,
  }),
  computed: {
    documents() {
      return get(window, 'state.documents', []);
    },
  },
};
</script>

<style scoped>

</style>
