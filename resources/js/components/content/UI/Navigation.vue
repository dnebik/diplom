<template>
    <div class="nav">

        <div class="body" v-if="route === '/documents'">
            <div class="doc">
                <router-link :to="{name: 'docs'}">
                    <div class="name">
                        Мои документы
                    </div>
                </router-link>
                <svg class="add" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.00083 0C4.03042 0 0.000976562 4.0295 0.000976562 8.99991C0.000976562 13.9701 4.03036 18 9.00071 18C13.9711 18 18.0009 13.9701 18.0009 8.99991C18.0009 4.0295 13.9711 0 9.00083 0ZM12.7977 9.98996H9.90148V13.0181C9.9013 13.5258 9.4897 13.9374 8.98181 13.9374C8.47373 13.9374 8.06214 13.5258 8.06214 13.0178V9.98996H5.24307C4.73511 9.98978 4.32369 9.57818 4.32339 9.07029C4.32339 8.56251 4.73517 8.15074 5.24307 8.15062L8.06208 8.1508V5.46337C8.06208 4.95541 8.47385 4.54369 8.98163 4.54369C9.4897 4.54369 9.90148 4.95547 9.9013 5.46337L9.90148 8.15056L12.7973 8.15086C13.3053 8.15056 13.7172 8.56246 13.717 9.07053C13.7172 9.57848 13.3053 9.98996 12.7977 9.98996Z" fill="#48ACAD"/>
                </svg>
            </div>
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

            &.router-link-exact-active ~ svg path
                fill: #ffffff
            &:not(.router-link-exact-active) ~ svg path
                fill: #48ACAD
        .doc
            position: relative
            cursor: pointer
            .add
                width: 21px
                height: 21px
                position: absolute
                right: 15px
                top: 12px
                z-index: 1000
                //path
                //    fill: #48ACAD47
                //&:hover
                //    path
                //        fill: #48ACAD

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

        .doc
            position: relative
            cursor: pointer
            .add
                width: 20px
                height: 20px
                position: absolute
                right: 8px
                top: 7px
                z-index: 1000
                path
                    fill: #48ACAD47
                &:hover
                    path
                        fill: #48ACAD


    a
        display: flex
</style>
