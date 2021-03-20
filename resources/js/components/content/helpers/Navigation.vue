<template>
    <div class="nav">

        <div v-if="currentRoute === 'docs'">

        </div>



    </div>
</template>

<script>
export default {
    name: "Navigation",
    computed: {
        currentRoute() {
            return this.$route.matched[0].name;
        }
    }
}
</script>

<style scoped lang="sass">

</style>
