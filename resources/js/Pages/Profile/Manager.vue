<template>
    <Head title="Profile Manager"/>

    <AuthenticatedLayout>
        <div class="profile-manager">
            <form @submit.prevent="submit">
                <header>
                    {{ localType }}
                    <div class="profile-photo">
                        <label for="photo" class="edit-top-btn" v-if="localType == 'M'"><span class="material-symbols-outlined">edit</span></label>
                        <input type="file" id="photo" name="photo" hidden
                            @input="form.perfil_photo = $event.target.files[0]"/>
                        <img :src="user.perfil_photo" :alt="user.name" v-if="user.perfil_photo">
                        <img src="../../img/user.png" :alt="user.name" v-else>
                    </div>
                    <div class="content">
                        <div>
                            <h3>{{ user.name }}</h3>
                            <p>Projects {{ projectsCount }} | subscribers {{ user.subscribers }}</p>
                        </div>
                        <div class="user-social-medias">
                            <a href="www.google.com" target="_black" class="social-media">
                                <img src="./../../img/3d.jpg" alt="">
                            </a>
                            <div class="add" v-if="localType == 'M'">
                                <span class="material-symbols-outlined">add</span>
                            </div>
                        </div>
                        <div class="my-4 mt-6">
                            <label for="curriculum" class="basic-black-btn">Add | update a curriculum</label>
                            <input type="file" id="curriculum" name="curriculum" hidden
                                @input="form.curriculum = $event.target.files[0]"/>
                        </div>
                    </div>
                </header>
                <hr>
                <section class="about">
                    <div class="about-form">
                        <h3>About me</h3>
                        <textarea name="about" v-model="form.about" id="about" cols="30" rows="10" placeholder="Write a litle "></textarea>
                    </div>
                    <div class="about-image">
                        <label for="about_image" class="edit-top-btn" v-if="localType == 'M'"><span class="material-symbols-outlined">edit</span></label>
                        <input type="file" id="about_image" name="about_image" hidden
                            @input="form.about_image = $event.target.files[0]"/>
                        <img :src="user.about_image" v-if="user.about_image">
                        <span v-else>With out image 😔</span>
                    </div>
                </section>
                <div class="update-profile-btn">
                    <button type="submit" class="basic-fouth-btn">Update Profile</button>
                </div>
            </form>
            <section class="about-show">
                <div class="about-info">
                    <h3>About me</h3>
                    <p>{{ user.about }}</p>
                </div>
                <div class="about-image">
                    <img :src="user.about_image" v-if="user.about_image">
                    <span v-else>With out image 😔</span>
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

        user: Object,
        projects: Object,
        projectsCount: Number,
        localType: String,

    },

    data () {
        return {

            form: useForm({
                perfil_photo: null,
                curriculum: null,
                about: '',
                about_image: null,
                _method: 'put',
            })
        }
    },

    mounted() {
        this.form.about = this.user.about;
    },

    methods: {
        submit() {
            this.form.post(route('profile.manager.update'), this.form, {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.perfil_photo) {
                        this.form.reset('perfil_photo');
                    }
                    if (this.form.errors.curriculum) {
                        this.form.reset('curriculum');
                    }
                    if (this.form.errors.about) {
                        this.form.reset('about');
                    }
                    if (this.form.errors.about_image) {
                        this.form.reset('about_image');
                    }
                },
            });
        },
    },
}

</script>
