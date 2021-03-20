<template>
    <div>
        <Input v-model="value" label="Логин"/>
    </div>
</template>

<script>
import Input from "./UI/Input";
export default {
    name: "Auth",
    data() {
        return {
            value: '',
        }
    },
    components: {
        Input,
    }
}
</script>

<style scoped>

</style>
