<template>
    <div class="nav">

        <div class="body" v-if="route === '/documents'">
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
    data() {
        return {
            route: ''
        }
    },
    mounted() {
        this.update();
    },
    watch: {
        $route: {
            handler(to, from) {
                this.update();
            }
        },
    },
    methods: {
        update() {
            if (this.$route.matched.length === 0) return;
            this.route = this.$route.matched[0].path;
            this.$emit('updated');
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

            &.router-link-exact-active
                background-color: #028F91
                color: #ffffff
            &:not(.router-link-exact-active)
                color: #48ACAD

    @media (min-width: 414px)
        .body
            padding-top: 6px
            padding-bottom: 6px
            max-width: 250px
            width: 100%

        a
            font-size: 18px
            height: 32px
            width: 100%
            justify-content: left
            align-items: center

            .name
                position: relative

            &.router-link-exact-active .name
                color: #48ACAD
            &.router-link-exact-active .name:before
                content: ''
                background-color: #48ACAD
                width: 100%
                height: 2px
                position: absolute
                bottom: -2px

            &:not(.router-link-exact-active) .name
                color: #48ACAD47
            &:not(.router-link-exact-active):hover .name
                color: #48ACAD90


    a
        display: flex
</style>
