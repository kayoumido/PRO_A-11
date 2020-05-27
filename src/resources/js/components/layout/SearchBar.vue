<template>
    <v-autocomplete
        single-line
        hide-details
        placeholder="Rechecher une presentation"
        prepend-inner-icon="mdi-magnify"
        hide-no-data
        solo
        v-model="select"
        :loading="loading"
        :items="items"
        item-value="id"
        item-text="title"
        :search-input.sync="search"
        @change="GoToPresentation(select)"
    ></v-autocomplete>
</template>

<script>
export default {
  name: 'SearchBar',
  data() {
    return {
      loading: false,
      items: [],
      search: null,
      select: null,
    };
  },
  watch: {
    search(val) {
      return val && val !== this.select && this.querySelections(val);
    },
  },
  methods: {
    querySelections(searchVal) {
      const apiUrl = '/presentations/search';
      this.loading = true;

      window.axios.get(apiUrl, { params: { keywords: searchVal } })
        .then((res) => {
          this.items = res.data;
        });

      this.loading = false;
    },
    GoToPresentation(id) {
      if (id !== null && id !== '') {
        this.$router.push({
          name: 'Présentation',
          params: { idPresentation: id },
        });
      }
    },
  },

};
</script>
