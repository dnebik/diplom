<template>
    <div class="body">
        <img :src="$root.$data.path + '/images/ghost.svg'" alt="404 ghost">
        <div class="text">
            <h1>404</h1>
            <p>Куда мы попали?</p>
            <router-link to="documents">Вернуться на главную</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "NonExisting"
}
</script>

<style scoped lang="sass">
    .body
        display: flex
        flex-wrap: wrap
        margin: 120px auto 80px
        width: max-content
        color: #A3D5D6

        img
            width: 100px
            margin-right: 30px
            margin-top: 20px

        .text
            width: max-content
            h1
                font-size: 102px
                margin: 0
            p
                font-size: 20px
                font-weight: bold
                margin: -20px 0 5px

            a
                text-decoration: underline
</style>
