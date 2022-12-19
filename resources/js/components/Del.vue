<template>
<a href="#" :class="btnClass" @click="del">
   <slot></slot>
</a>
</template>

<script>
export default {
    props: {
        url: String,
        btnClass: String
    },
    methods: {
        del() {
            let _that = this
            this.$swal({
                title: 'Do you want to delete?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.delete(_that.url).then(()=> {
                        _that.$swal('Deleted!', '', 'success')
                        location.reload()
                    })
                }
            })
        }
    }
}

</script>

<style lang="scss" scoped>

</style>