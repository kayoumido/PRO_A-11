<template>
    <p>
        <span v-show="!editing">
            {{input}}
            <v-btn @click="editing=true" color="warning" text><v-icon>mdi-pen</v-icon></v-btn>
        </span>
        <span v-show="editing">
            <v-text-field
                v-model="input"
                append-icon="mdi-check"
                :rules="[rules.required]"
                :name="name"
                @click:append="updateValue"
                :error="error">

            </v-text-field>
        </span>
    </p>
</template>

<script>
export default {
  name: 'EditableText',
  props: [
    'name',
    'value',
    'apiUrl',
  ],
  data() {
    return {
      editing: false,
      error: false,
      rules: {
        required: (value) => !!value || 'Required.',
      },
      input: this.value,
    };
  },
  methods: {
    updateValue() {
      window.axios.put(this.apiUrl, {
        [this.name]: this.input,
      })
        .then((response) => {
          this.input = response.data[this.name];
          this.error = false;
          this.editing = false;
        })
        .catch(() => {
          this.error = true;
        });
    },
  },
};
</script>

<style scoped>

</style>
