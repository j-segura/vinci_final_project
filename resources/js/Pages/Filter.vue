<template>
    <Head title="Filter" />

    <AuthenticatedLayout>
        <div class="sub-title">
            <h2 class="text-center">{{ category.name }}</h2>
            <p class="text-center">Looking for a good artist? find him below</p>
        </div>
        <section id="works-index">
            <div class="work-card" v-for="project in category.projects">
                <Link class="user-info" :href="route('profile.show', project.author)">
                    <div class="user-picture">
                        <img :src="project.author.perfil_photo" alt="" v-if="project.author.perfil_photo">
                        <img src="../img/user.png" alt="" v-else>
                    </div>
                    <span>{{ project.author.name }} | Artist</span>
                </Link>
                <div class="work">
                    <Link class="img" :href="route('project.show', project)">
                        <img :src="project.image" :alt="project.title">
                    </Link>
                    <span>{{ project.title }}</span>
                </div>
            </div>
        </section>
        <footer></footer>
    </AuthenticatedLayout>
</template>

<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Paginator from '@/Components/Paginator.vue';
import { Link } from '@inertiajs/vue3';

export default {

    components: {

        AuthenticatedLayout,
        Head,
        Paginator,
        Link,

    },

    props: {
        category: Object,
    },

}

</script>

<style>

.margin-b {
    margin-bottom: 5rem;
}

</style>
