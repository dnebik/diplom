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

.nv-desctop
    margin-right: 63px
    @media (max-width: 414px)
        display: none


</style>
