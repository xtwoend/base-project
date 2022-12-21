<template>
    <div class="table-responsive">
        <Vue3EasyDataTable
            alternating
            show-index
            table-class-name="vtable"
            v-model:server-options="options"
            :server-items-length="dataLength"
            :loading="isLoading"
            :headers="headers"
            :items="items"
            ref="vtable"
        >
            <template v-for="(_, slot) in $slots" v-slot:[slot]="scope">
                <slot :name="slot" v-bind="scope || {}" />
            </template>
        </Vue3EasyDataTable>
    </div>
</template>

<script>
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

export default {
    props: {
        url: String,
        headers: Array,
    },
    components: {
        Vue3EasyDataTable
    },
    data () {
        return {
            options: {
                page: 1,
                rowsPerPage: 25
            },
            dataLength: 0,
            isLoading: false,
            items: [],
            params: {}
        }
    },
    mounted () {
        this.fetchData()
    },
    watch: {
        options: {
            handler(val) {
                this.fetchData()
            },
            deep: true
        }
    },
    methods: {
        async fetchData() {
            this.isLoading = true
            this.items = []
            let res = await axios.get(this.url, {params: this.options}).then(res => res.data)
            this.items = res.data
            this.dataLength = res.total
            this.options.page = res.current_page
            this.options.rowsPerPage = res.per_page
            this.isLoading = false
        },
        reload() {
            console.log('reload')
        }
    }
}
</script>

<style>

</style>