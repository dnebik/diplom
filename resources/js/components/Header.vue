<template>
    <div class="header">
        <div class="line">
            <img class="logo" :src="$root.$data.path + '/images/logo.svg'">

        </div>
    </div>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style scoped lang="sass">
    .line
        position: relative
        background-color: #028F91
        @media (min-width: 1024px)
            border-radius: 36px
            margin: 24px 41px 56px 64px !important
        @media (min-width: 414px)
            height: 72px
        @media (max-width: 414px)
            height: 67px
        @media (min-width: 414px) and (max-width: 1024px)
            margin: 24px 0 56px 0

        .logo
            width: 125px
            position: absolute
            left: 0
</style>
