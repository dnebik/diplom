<template>
    <div class="employee-selector">
        <Loading v-if="!loaded"/>
        <label v-if="loaded && label" :for="id">Отправить на рассмотрение:</label>
        <select ref="select" v-if="loaded" :id="id" @change="$emit('change', $event.target.value)">
            <option v-for="(item, index) in employee"
                    :value="index"
                    :selected="index == selected"
                    :key="index">{{ item }}</option>
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
    model: {
        prop: 'selected',
        event: 'change',
    },
    data() {
        return {
            id: null,
            employee: {},
            loaded: false,
        }
    },
    props: {
        selected: [String, Number],
        label: {
            type: Boolean,
            default: true,
        },
        with_none: {
            type: Boolean,
            default: true
        }
    },
    created() {
        this.id = Math.random().toString(36).substring(7);
    },
    mounted() {
        let request = axios.post('/staff/get');
        request.then(value => {
            if (this.with_none) {
                this.$set(this.employee, 0, "Не отправлять");
            }
            for (let item of value['data']['staff']) {
                if (this.$root['user']['id'] === item['id']) continue;
                this.$set(this.employee, item['id'], item['FIO']);
            }
        });
        request.catch(reason => {console.log(reason)});
        request.finally(() => {
            this.loaded = true;
            setTimeout(() => {
                this.$emit('change', this.$refs.select.value)
            }, 50);
        })
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
