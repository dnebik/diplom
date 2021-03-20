<template>
    <div class="nav">

        <div class="body" v-if="currentRoute === '/documents'">
            <router-link :to="{name: 'docs'}">
                <div class="name">Мои документы</div>
            </router-link>
            <router-link :to="{name: 'requests'}">
                <div class="name">Запросы</div>
            </router-link>
            <router-link :to="{name: 'history'}">
                <div class="name">История просмотров</div>
            </router-link>
            <router-link :to="{name: 'search'}">
                <div class="name">Поиск документов</div>
            </router-link>
        </div>

    </div>
</template>

<script>
export default {
    name: "Navigation",
    computed: {
        currentRoute() {
            return this.$route.matched[0].path;
        }
    }
}
</script>

<style scoped lang="sass">

.nav
    @media (max-width: 414px)
        .body
            background-color: #017174
            padding-top: 6px
            padding-bottom: 6px

        a
            font-size: 22px
            width: 100%
            height: 45px
            justify-content: right
            align-items: center

            .name
                margin-right: 51px

            &.router-link-active
                background-color: #028F91
                color: #ffffff
            &:not(.router-link-active)
                color: #48ACAD

    a
        display: flex
</style>
