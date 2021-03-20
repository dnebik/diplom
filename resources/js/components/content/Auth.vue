<template>
    <div class="auth">
        <h1>Авторизация</h1>
        <Input v-model="login" label="Логин"/>
        <Input v-model="password" password label="Пароль"/>
    </div>
</template>

<script>
import Input from "./UI/Input";
export default {
    name: "Auth",
    data() {
        return {
            login: '',
            password: '',
        }
    },
    components: {
        Input,
    }
}
</script>

<style scoped lang="sass">
    .auth
        padding-top: 80px
        width: max-content
        margin: 0 auto
        h1
            text-align: center
            padding-bottom: 23px
            font-size: 24px
            color: #48ACAD
</style>
