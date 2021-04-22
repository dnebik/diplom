<template>
    <div class="my-documents-container">
    </div>
</template>

<script>
import ListItem from "../UI/ListItem";
export default {
    name: "MyDocuments",
    components: {
        ListItem,
    },
}
</script>

<style scoped lang="sass">
    .my-documents-container
        flex: auto
</style>
