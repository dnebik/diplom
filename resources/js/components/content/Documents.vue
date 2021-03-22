<template>
    <div class="flex-body">
        <div class="nv-desctop">
            <navigate></navigate>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "Documents"
}
</script>

<style scoped lang="sass">

.flex-body
    display: flex

</style>
