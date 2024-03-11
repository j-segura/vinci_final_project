<template>
    <Head title="Profile Manager"/>

    <AuthenticatedLayout>
        <div class="profile-manager">
            <header>
                <div class="profile-photo">
                    <div class="edit-top-btn">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                    <img src="./../../img/old.jpg" alt="">
                </div>
                <div class="content">
                    <div>
                        <h3>Daniel Murth</h3>
                        <p>Projects 25 + | Artist | Exp 8</p>
                    </div>
                    <div class="user-social-medias">
                        <a href="www.google.com" target="_black" class="social-media">
                            <img src="./../../img/3d.jpg" alt="">
                        </a>
                        <div class="add">
                            <span class="material-symbols-outlined">add</span>
                        </div>
                    </div>
                    <div class="my-4 mt-6">
                        <label for="photo" class="basic-black-btn">Add | update a curriculum</label>
                        <input type="file" id="photo" name="photo" hidden
                            @input="form.image = $event.target.files[0]"/>
                    </div>
                </div>
            </header>
            <hr>
            <section class="about">
                <div class="about-form">
                    <h3>About me</h3>
                    <textarea name="about" id="about" cols="30" rows="10" placeholder="Write a litle "></textarea>
                    <button class="basic-black-btn fit-content">Add | update</button>
                </div>
                <div class="about-image">
                    <div class="edit-top-btn">
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                    <img src="./../../img/old.jpg" alt="">
                </div>
            </section>
            <hr>
            <section class="user-projects">
                <div class="head">
                    <h3>Your Proyects</h3>
                    <Link :href="route('project.create')">
                        <button class="basic-succes-btn">Add Project +</button>
                    </Link>
                </div>
                <div class="projects-grid mt-2" v-if="projects.length > 0">
                    <div class="card-p" v-for="project in projects">
                        <div class="actions">
                            <Link class="show-btn" :href="route('project.show', project)">
                                <span class="material-symbols-outlined">visibility</span>
                            </Link>
                            <Link :href="route('project.edit', project)" class="edit-btn">
                                <span class="material-symbols-outlined">edit</span>
                            </Link>
                            <div class="delete-btn">
                                <span class="material-symbols-outlined">delete</span>
                            </div>
                        </div>
                        <img :src="project.image" alt="">
                    </div>
                </div>
                <div class="no-content" v-else>
                    No projects yet
                </div>
            </section>
            <hr>
            <section class="references">
                <div class="head">
                    <h3>References</h3>
                    <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas.</p>
                </div>
                <div class="references-grid">
                    <div class="card-ref">
                        <div class="card-ref-head">
                            <div class="user-data">
                                <div class="user-photo-o">
                                    <img src="./../../img/scullture.jpg" alt="">
                                </div>
                                <span>Susan Bill</span>
                            </div>
                            <div class="trash-top-btn">
                                <span class="material-symbols-outlined">delete</span>
                            </div>
                        </div>
                        <p>
                            Lorem Ipsum es simplemente el texto de relleno de las imprentas. este man le mete muy rico sabe trabajar el arte como se debe bla bla bla
                        </p>
                    </div>
                    <div class="card-ref">
                        <div class="card-ref-head">
                            <div class="user-data">
                                <div class="user-photo-o">
                                    <img src="./../../img/scullture.jpg" alt="">
                                </div>
                                <span>Susan Bill</span>
                            </div>
                            <div class="trash-top-btn">
                                <span class="material-symbols-outlined">delete</span>
                            </div>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam molestias perfe
                        </p>
                    </div>
                    <div class="card-ref">
                        <div class="card-ref-head">
                            <div class="user-data">
                                <div class="user-photo-o">
                                    <img src="./../../img/scullture.jpg" alt="">
                                </div>
                                <span>Joe Miller</span>
                            </div>
                            <div class="trash-top-btn">
                                <span class="material-symbols-outlined">delete</span>
                            </div>
                        </div>
                        <p>
                            Que! chimba! de projectos WAAAAAA!!
                        </p>
                    </div>
                    <div class="card-ref">
                        <div class="card-ref-head">
                            <div class="user-data">
                                <div class="user-photo-o">
                                    <img src="./../../img/scullture.jpg" alt="">
                                </div>
                                <span>Susan Bill</span>
                            </div>
                            <div class="trash-top-btn">
                                <span class="material-symbols-outlined">delete</span>
                            </div>
                        </div>
                        <p>
                            Lorem Ipsum es simplemente el texto de relleno de las imprentas. este man le mete muy rico sabe trabajar el arte como se debe bla bla bla
                        </p>
                    </div>
                </div>
                <div class="add-reference">
                    <div class="user-photo-o">
                        <img src="./../../img/scullture.jpg" alt="">
                    </div>
                    <textarea name="reference" id="reference" placeholder="Give a reference about Daniel:" cols="30" rows="10"></textarea>
                    <button class="basic-succes-btn">Comment</button>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

export default {

    components: {

        AuthenticatedLayout,
        Head,
        Link,

    },

    props: {

        projects: Object

    }

}

</script>
