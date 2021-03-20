<template>
    <div class="auth">
        <h1>Авторизация</h1>
        <form @submit.prevent="login()">
            <Input v-model="login" label="Логин"/>
            <Input v-model="password" password label="Пароль"/>
            <button :disabled="!validate" class="btn submit" type="submit">Войти</button>
        </form>
    </div>
</template>

<script>
import Input from "./UI/Input";
export default {
    name: "Auth",
    components: {
        Input,
    },
    data() {
        return {
            login: '',
            password: '',
        }
    },
    computed: {
        validate() {
            return this.login.toString().length > 0 && this.password.toString().length > 0;
        }
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
        .btn
            float: right
</style>
