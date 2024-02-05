<template>
    <!-- BEGIN #footer -->
    <footer class="page-footer">
        <p class="mb-0">Copyright &copy; {{ year }}. All right reserved.</p>
    </footer>
    <!-- END #footer -->

</template>

<script>

import { computed } from 'vue'

export default {
    name: "LayoutFooter",
    setup () {
        const year = computed(() => new Date().getFullYear())
        return { year }
    }
}
</script>

<style scoped>

</style>
