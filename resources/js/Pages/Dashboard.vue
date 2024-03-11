<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="header">
            <div class="header-img">
                <img src="./../img/header-bg.jpg" alt="">
            </div>
            <div class="header-content">
                <h1>Find your favorite artist</h1>
                <div class="search-bar">
                    <input type="search" placeholder="Search for someone...">
                    <button></button>
                </div>
                <p>More than 1000 artists, designers & creative people</p>
            </div>
        </div>
        <div class="sub-title">
            <h2>Look for a Category</h2>
            <p>Here you will find all the categories we have available</p>
        </div>
        <section id="categories">
            <div v-for="category in categories">
                <img :src="category.image" alt="category">
                <span>{{ category.name }}</span>
            </div>
        </section>
        <div class="sub-title">
            <h2 class="text-center">Choose from the best</h2>
            <p class="text-center">Looking for a good artist? find him below</p>
        </div>
        <section id="works-index">
            <div class="work-card" v-for="project in projects.data">
                <div class="user-info">
                    <div class="user-picture"></div>
                    <span>{{ project.author.name }} | Artist</span>
                </div>
                <div class="work">
                    <Link class="img" :href="route('project.show', project)">
                        <img :src="project.image" :alt="project.title">
                    </Link>
                    <span>{{ project.title }}</span>
                </div>
            </div>
        </section>
        <Paginator :links="projects.links" class="margin-b"/>
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
        categories: Object,
        projects: Object,
    },

    data() {

        return {

        };

    },

}

</script>

<style>

.margin-b {
    margin-bottom: 5rem;
}

</style>
