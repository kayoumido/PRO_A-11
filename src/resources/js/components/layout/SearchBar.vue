<template>
    <v-autocomplete
        single-line
        hide-details
        placeholder="Rechecher une presentation"
        append-icon="mdi-magnify"
        hide-no-data
        v-model="select"
        :loading="loading"
        :items="items"
        item-value="id"
        item-text="title"
        :search-input.sync="search"
    ></v-autocomplete>
</template>

<script>
export default {
  name: 'SearchBar',
  data() {
    return {
      model: null,
      value: '',
      loading: false,
      items: [],
      search: null,
      select: null,
    };
  },
  beforeUpdate() {
  },
  watch: {
    search(val) {
      return val && val !== this.select && this.querySelections(val);
    },
  },
  methods: {
    querySelections(v) {
      const apiUrl = '/presentations/search';
      this.loading = true;
      setTimeout(() => {
        window.axios.get(apiUrl, { params: { keywords: v } })
          .then((res) => {
            this.items = res.data;
          });
      }, 500);

      this.loading = false;
    },
  },

};
</script>
