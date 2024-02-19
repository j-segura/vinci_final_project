<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="header">
            <div class="header-img">
                <img :src="imagenUrl" alt="">
            </div>
            <div class="header-content">
                <h1>Find your favorite artiste</h1>
                <input type="search" placeholder="Search...">
                <p>More than 1000 artists, designers & creative people</p>
            </div>
            {{ imagenUrl }}
        </div>
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

    data() {

        return {

        imagenUrl: `${this.$page.props.appUrl}/imagenes/imagen.jpg`

        };

    },

}

</script>



<style>

/* header {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #FF4B4B;
    height: 5rem;
} */

</style>
