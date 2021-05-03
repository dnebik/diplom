<template>
    <div class="header">


        <div v-if="isAuthed" class="mobile-navigation hide" ref="mobile_navigation">

            <div class="main-nav">
                <router-link to="/documents" class="item left">
                    <svg width="36" height="38" viewBox="0 0 36 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.9615 15.8295V32.3717C28.9615 34.5294 27.2077 36.2556 25.0154 36.2556H5.13846C2.94615 36.2556 1.19231 34.5294 1.19231 32.3717V5.47269C1.19231 3.31501 2.94615 1.58887 5.13846 1.58887H25.0154C27.2077 1.58887 28.9615 3.31501 28.9615 5.47269V7.19881V8.78112" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                        <path d="M5.86923 11.658H23.4077" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M5.86923 18.8502H18" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M5.86923 26.1864H11.4231" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M30.7154 6.62342L14.9308 23.741L13.7615 28.4879L18.4385 26.9056L34.2231 9.78801C34.8077 9.06879 34.8077 8.06187 34.2231 7.48649L33.0538 6.47956C32.4692 5.90418 31.3 6.04804 30.7154 6.62342Z" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                        <path d="M28.9615 8.63733L32.4692 11.8019" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                        <path d="M14.9308 23.8848L18.4384 26.9055" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                    </svg>
                </router-link>
                <div class="vr"></div>
                <router-link to="/audio" class="item">
                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.67202 5.79515V30.8171C1.67202 34.5777 5.77602 36.8918 9.27202 35.1562L33.136 22.7175C36.632 20.8372 36.632 16.0642 33.136 14.184L9.27202 1.74533C5.92802 -0.134928 1.67202 2.17924 1.67202 5.79515Z" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                    </svg>
                </router-link>
                <div class="vr"></div>
                <router-link to="/monitoring" class="item right">
                    <svg width="36" height="39" viewBox="0 0 36 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.871 37.5H6.47743V25.2C6.47743 24.15 7.21289 23.25 8.07096 23.25H10.1549C11.0129 23.25 11.7484 24.15 11.7484 25.2V37.5H11.871Z" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                        <path d="M22.5355 37.4999H17.1419V13.4999C17.1419 12.4499 17.8774 11.5499 18.7355 11.5499H20.8194C21.6774 11.5499 22.4129 12.4499 22.4129 13.4999V37.4999H22.5355Z" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                        <path d="M33.0774 37.4999H27.6839V4.49991C27.6839 3.44991 28.4194 2.54993 29.2774 2.54993H31.4839C32.3419 2.54993 33.0774 3.44991 33.0774 4.49991V37.4999Z" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                        <path d="M1.20645 37.5H34.7936" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M1.20645 1.5V37.5" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                    </svg>
                </router-link>
                <div @click="$root.logout()" class="item exit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.3333 0H2.66669C1.19331 0 0 1.19331 0 2.66669V8H2.66669V2.66669H21.3334V21.3334H2.66669V16H0V21.3333C0 22.8067 1.19331 24 2.66669 24H21.3334C22.8067 24 24 22.8067 24 21.3333V2.66669C24 1.19331 22.8067 0 21.3333 0Z" fill="black"/>
                        <path d="M9.44669 16.78L11.3333 18.6667L18 12L11.3333 5.33334L9.44669 7.22003L12.8933 10.6667H0V13.3333H12.8933L9.44669 16.78Z" fill="black"/>
                    </svg>
                </div>
            </div>

            <div class="sub-nav">
                <Navigation v-on:updated="menuHeightUpdate"></Navigation>
            </div>

        </div>


        <div class="line">
            <img class="logo" :src="$root.$data.path + '/images/logo.svg'">
            <div class="title">Document Server</div>

            <div v-if="isAuthed" class="inline-navigate">
                <router-link to="/documents" class="item">
                    Документы
                </router-link>
                <router-link to="/audio" class="item">
                    Аудио
                </router-link>
                <router-link to="/monitoring" class="item">
                    Мониторинг
                </router-link>
                <div @click="$root.logout()" class="item right">
                    Выход
                </div>
            </div>

            <div v-if="isAuthed" class="menu-arrow hide" @click="toggleMenu()" ref="menu_button">
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
import Navigation from "./content/UI/Navigation";
export default {
    name: "Header",
    components: {
        Navigation,
    },
    watch: {
        $route: {
            handler() {
                this.menuHeightUpdate();
            }
        },
    },
    computed: {
        isAuthed() {
            return this.$parent.$data.user !== null;
        }
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.widthCheck);
        window.removeEventListener('click', this.checkClick);
        window.removeEventListener('scroll', this.checkScroll);
    },
    mounted() {
        this.menuHeightUpdate();
        window.addEventListener('resize', this.widthCheck);
        window.addEventListener('click', this.checkClick);
        window.addEventListener('scroll', this.checkScroll);
    },
    methods: {
        toggleMenu() {
            if (!this.isAuthed) return;
            let nav = this.$refs['mobile_navigation'];
            let btn = this.$refs['menu_button'];

            nav.classList.toggle('hide')
            btn.classList.toggle('hide')
        },
        checkClick(event) {
            let header = event.target.closest('.header');
            if (!header) {
                let nav = this.$refs['mobile_navigation'];
                let btn = this.$refs['menu_button'];

                nav.classList.add('hide')
                btn.classList.add('hide')
            }
        },
        checkScroll(event) {
            let nav = this.$refs['mobile_navigation'];
            let btn = this.$refs['menu_button'];

            if (nav.classList.contains('hide')) return;

            nav.classList.add('hide')
            btn.classList.add('hide')
        },
        menuHeightUpdate() {
            if (!this.isAuthed) return;
            let nav = this.$refs['mobile_navigation'];
            setTimeout(function () {
                nav.style.maxHeight = nav.scrollHeight + 'px';
            }, 5)
        },
        widthCheck() {
            if (!this.isAuthed) return;
            let width = window.innerWidth;
            if (width > 414)
            {
                let nav = this.$refs['mobile_navigation'];
                let btn = this.$refs['menu_button'];

                // console.log(nav, btn)
                nav.classList.add('hide')
                btn.classList.add('hide')
            }
            else {
                this.menuHeightUpdate()
            }
        }
    },
}
</script>

<style scoped lang="sass">

    $button_padding: 10px

    .header
        max-width: 1500px
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
            .main-nav
                background-color: #028F91
                display: flex
                height: 60px
                position: relative
                .vr
                    margin: auto 0
                    height: 40px
                    width: 2px
                    background-color: #105A5B
                .right
                    margin-right: auto
                .left
                    margin-left: auto
                .exit
                    background-color: #F97171
                    width: 48px
                    position: absolute
                    right: 0
                    height: 100%
                    path
                        fill: #AF3434
                .item
                    display: flex
                    align-items: center
                    justify-content: center
                    &:not(.exit)
                        padding: 0 24px
                    &.router-link-active:not(.exit) path
                        stroke: white
                    &:not(.router-link-active):not(.exit) path
                        stroke: #48ACAD

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
                padding: 0 10px
                height: 100%
                display: flex
                align-items: center
                &:not(.hide)
                    transform: rotate(180deg)
                @media (min-width: 414px)
                    display: none


</style>
