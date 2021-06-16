<template>
    <div class="auth">
        <h1>Авторизация</h1>
        <InfoBox class="warning" v-if="warning" text="Неверный логин или пароль." type="danger" />
        <form @submit.prevent="auth()">
            <InputBox v-model="login" label="Логин"/>
            <InputBox v-model="password" password label="Пароль"/>
            <InputCheckBox label="Запомнить меня" v-model="remember"/>
            <button :disabled="!validate || waiting" class="btn submit" type="submit">Войти</button>
        </form>
    </div>
</template>

<script>
import InputBox from "./UI/InputBox";
import InputCheckBox from "./UI/InputCheckBox";
import InfoBox from "./UI/InfoBox";
import router from "../../routes";
export default {
    name: "Auth",
    components: {
        InputBox,
        InputCheckBox,
        InfoBox,
    },
    props: {
        redirect: null
    },
    data() {
        return {
            login: 'login',
            password: 'password',
            remember: true,
            waiting: false,
            warning: false,
        }
    },
    computed: {
        validate() {
            return this.login.toString().length > 0 && this.password.toString().length > 0;
        }
    },
    methods: {
        auth() {
            this.warning = false;
            this.waiting = true;

            let req = axios.post('/user/login',{
                login: this.login,
                password: this.password,
                remember: this.remember,
            })

            req.then(value => {
                if (value['data']['status']['code'] == 0) {
                    this.$root.$data.user = value['data']['user'];
                    if (this.redirect === null || typeof this.redirect === "undefined") this.$router.push({name: 'docs'});
                    else {
                        console.log(this.redirect);
                        this.$router.push(this.redirect);
                    }
                } else {
                    this.warning = true;
                    this.password = '';
                }
            })

            req.catch(reason => {
                console.log(reason);
            })

            req.finally(() => {this.waiting = false})
        }
    }
}
</script>

<style scoped lang="sass">
    .auth
        position: relative
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
            margin-top: 20px !important
        .warning
            position: absolute
            top: -5px
</style>
