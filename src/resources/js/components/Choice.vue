<template>
    <v-sheet
        class="pa-12"
        color="success">
    {{choice.message}}
    </v-sheet>
</template>

<script>
export default {
  name: 'Choice',
  props: [
    'choice',
  ],
};
</script>

<style scoped>

</style>
