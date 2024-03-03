<template>
    <Head title="Admin"/>

    <AuthenticatedLayout>
        Maquitar aqui la vista de ver usuairio
    </AuthenticatedLayout>
</template>

<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {

    components: {

        AuthenticatedLayout,
        Head,

    },

}

</script>
