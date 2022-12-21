<template>
    <v-select
        v-model="selected"
        :options="icons"
    >
        <template #open-indicator="{ attributes }">
            <span v-bind="attributes">
                <i class="fa fa-angle-down"></i>
            </span>
        </template>
        <template #option="option">
            <i :class="option.label"></i> {{ option.label }}
        </template>
        <template #selected-option="option">
            <i :class="option.label"></i> {{ option.label }}
        </template>
    </v-select>
    <input type="hidden" :name="name" v-model="selected">
    
</template>

<script>
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

export default {
    components: {vSelect},
    props: {
        icons: Array,
        value: String,
        name: String
    },
    data () {
        return {
            selected: null
        }
    },
    mounted() {
        this.selected = this.value
    }
}
</script>

<style>

</style>