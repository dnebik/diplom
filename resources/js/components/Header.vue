<template>
    <div class="header">


        <div class="mobile-navigation hide" ref="mobile_navigation">

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

            <div class="menu-arrow hide" @click="toggleMenu()" ref="menu_button">
                <svg width="25" height="15" viewBox="0 0 25 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                        <path class="left" d="M24.3059 0.701192C23.3805 -0.233731 21.8699 -0.233731 20.9309 0.701192L15.5961 6.09074L10.8601 10.8891C9.93468 11.824 9.93468 13.3501 10.8601 14.2988C11.7855 15.2337 13.2961 15.2337 14.2352 14.2988L19.5699 8.90926L24.3195 4.11091C25.245 3.16224 25.245 1.64986 24.3059 0.701192Z" fill="white"/>
                        <path class="right" d="M0.694066 0.701192C1.61949 -0.233731 3.1301 -0.233731 4.06913 0.701192L9.40392 6.09074L14.1535 10.8891C15.0789 11.824 15.0789 13.3501 14.1535 14.2988C13.2281 15.2337 11.7175 15.2337 10.7784 14.2988L5.44366 8.90926L0.694066 4.11091C-0.231355 3.16224 -0.231355 1.64986 0.694066 0.701192Z" fill="white"/>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="25" height="15" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
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
    watch: {
        $route: {
            handler() {
                let nav = this.$refs['mobile_navigation'];
                nav.style.maxHeight = nav.scrollHeight + 'px';
            }
        },
    },
    mounted() {
        let nav = this.$refs['mobile_navigation'];
        nav.style.maxHeight = nav.scrollHeight + 'px';
    },
    methods: {
        exit() {

        },
        toggleMenu() {
            let nav = this.$refs['mobile_navigation'];
            let btn = this.$refs['menu_button'];

            nav.classList.toggle('hide')
            btn.classList.toggle('hide')
        }
    },
}
</script>

<style scoped lang="sass">

    $button_padding: 10px

    .header
        max-width: 1700px
        margin: 0 auto
        @media (min-width: 414px)
            padding-top: 24px
            .mobile-navigation
                display: none
        @media (max-width: 414px)
            .mobile-navigation
                &.hide
                    max-height: 0 !important

        .mobile-navigation
            overflow: hidden
            transition: max-height .5s ease-in-out

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


            .menu-arrow
                transition: .3s
                margin-left: auto
                margin-right: 20px
            .menu-arrow:not(.hide)
                transform: rotate(180deg)

</style>
