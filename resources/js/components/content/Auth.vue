<template>
    <div class="auth">
        <h1>Авторизация</h1>
        <form @submit.prevent="login()">
            <InputBox v-model="login" label="Логин"/>
            <InputBox v-model="password" password label="Пароль"/>
            <InputCheckBox label="Запомнить меня" v-model="remember"/>
            <button :disabled="!validate" class="btn submit" type="submit">Войти</button>
        </form>
    </div>
</template>

<script>
import InputBox from "./UI/InputBox";
import InputCheckBox from "./UI/InputCheckBox";
export default {
    name: "Auth",
    components: {
        InputBox,
        InputCheckBox,
    },
    data() {
        return {
            login: 'login',
            password: 'password',
            remember: true
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
            margin-top: 15px
</style>
