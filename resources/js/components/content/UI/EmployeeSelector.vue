<template>
    <div class="employee-selector">
        <Loading v-if="!loaded"/>
        <label v-if="loaded" :for="id">Отправить на рассмотрение:</label>
        <select v-if="loaded" :id="id">
            <option v-for="(item, index) in employee" :key="index">{{ item }}</option>
        </select>
    </div>
</template>

<script>
import Loading from "./Loading";
export default {
    name: "EmployeeSelector",
    components: {
        Loading,
    },
    data() {
        return {
            id: null,
            employee: {
                0: 'Не отправлять'
            },
            loaded: false,
        }
    },
    created() {
        this.id = Math.random().toString(36).substring(7);
    },
    mounted() {
        let request = axios.post('/staff/get');
        request.then(value => {
            for (let item of value['data']['staff']) {
                if (this.$root['user']['id'] === item['id']) continue;
                this.$set(this.employee, item['id'], item['FIO']);
            }
        });
        request.catch(reason => {console.log(reason)});
        request.finally(() => {this.loaded = true})
    }
}
</script>

<style scoped>
    .employee-selector label {
        margin: 0 0 5px 2px;
        color: #2d3748;
        font-size: 18px;
    }
</style>
