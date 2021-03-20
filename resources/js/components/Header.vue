<template>
    <div class="header">


        <div class="mobile-navigation">

            <div class="main-nav">
                <router-link to="/documents" class="item">
                    Документы
                </router-link>
                <router-link to="/audio" class="item">
                    Аудио
                </router-link>
                <router-link to="/monitoring" class="item">
                    Мониторинг
                </router-link>
                <div @click="exit()" class="item right">
                    Выход
                </div>
            </div>

            <div class="sub-nav">
                <Navigation></Navigation>
            </div>

        </div>


        <div class="line">
            <img class="logo" :src="$root.$data.path + '/images/logo.svg'">
            <div class="title">Document Server</div>

            <div class="inline-navigate">
                <router-link to="/documents" class="item">
                    Документы
                </router-link>
                <router-link to="/audio" class="item">
                    Аудио
                </router-link>
                <router-link to="/monitoring" class="item">
                    Мониторинг
                </router-link>
                <div @click="exit()" class="item right">
                    Выход
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import Navigation from "./content/helpers/Navigation";
export default {
    name: "Header",
    components: {
        Navigation,
    },
    methods: {
        exit() {

        }
    }
}
</script>

<style scoped lang="sass">

    $button_padding: 10px

    .header
        max-width: 1700px
        margin: 0 auto
        @media (min-width: 414px)
            padding-top: 24px

        .line
            position: relative
            background-color: #028F91
            color: white
            display: flex
            align-items: center

            @media (min-width: 1024px)
                padding-right: 93px
                border-radius: 36px
                margin-left: 64px
                margin-right: 41px
                .logo
                    left: -30px
                    top: -13px
                .title
                    margin-left: 80px

            @media (min-width: 414px)
                height: 55px
                .logo
                    width: 95px
                .title
                    font-size: 28px
                .inline-navigate
                    margin-left: 22px
                    display: flex
                    flex: auto
                    font-size: 16px
                    height: 100%
                    .item
                        padding: 0 $button_padding
                        cursor: pointer
                        display: flex
                        align-items: center
                        height: 100%
                        position: relative

                        &:hover
                            background-color: #01717460

                        &.router-link-active:before
                            content: ' '
                            width: calc(100% - (#{$button_padding} * 2))
                            bottom: 16px
                            position: absolute
                            height: 1.5px
                            background-color: #ffffff


                    .right
                        margin-left: auto


            @media (min-width: 414px) and (max-width: 1024px)
                padding-right: 32px
                .logo
                    left: 13px
                    top: 12px
                .title
                    margin-left: 110px

            @media (max-width: 414px)
                height: 45px
                .logo
                    width: 65px
                    left: 13px
                    top: 11px
                .title
                    font-size: 22px
                    margin-left: 80px
                .inline-navigate
                    display: none



            .logo
                position: absolute

</style>
