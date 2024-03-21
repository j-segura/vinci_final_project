<template>
    <Head title="Profile Manager"/>

    <AuthenticatedLayout>
        <div class="profile-manager">
            <form @submit.prevent="submit">
                <header>
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
                            <a v-for="smedia in user.social_medias" :href="smedia.pivot.url" target="_black" class="social-media" v-if="localType == 'S'">
                                <img :src="smedia.icon" :alt="smedia.icon">
                            </a>
                            <div v-for="smedia, index in form.socialMedias" class="social-media" v-else>
                                <img :src="smedia.media.icon" :alt="smedia.media.icon">
                                <button class="remove" @click.prevent="deleteSocialMedia(index)"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                            <div class="add" v-if="localType == 'M'" @click.prevent="showSocialMedia()">
                                <span class="material-symbols-outlined" v-if="showSocialMediaForm">close</span>
                                <span class="material-symbols-outlined" v-else>add</span>
                            </div>
                        </div>
                        <div class="add-social-media-form" v-if="localType == 'M' && showSocialMediaForm">
                            <div>
                                <label class="typo__label">Social media</label>
                                <multiselect
                                    v-model="socialMedia.media"
                                    deselect-label="Can't remove this value"
                                    track-by="id"
                                    label="name"
                                    placeholder="Select one"
                                    :options="socialMedias"
                                    :searchable="false"
                                    :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }">{{ option.name }}</template>
                                </multiselect>
                            </div>
                            <div class="space-y-6 col-12 col-md-6">
                                <div class="input-p">
                                    <InputLabel for="name" value="Url *" />

                                    <TextInput
                                        id="name"
                                        ref="nameInput"
                                        v-model="socialMedia.url"
                                        type="text"
                                        class="block w-full"
                                        placeholder="https://www.youtube.com/"
                                        autocomplete="name-input"
                                    />
                                </div>
                            </div>
                            <button @click.prevent="addSocialMedia(socialMedia)" class="add-sm"><span class="material-symbols-outlined">add</span></button>
                        </div>
                        <div class="my-4 mt-6" v-if="localType == 'M'">
                            <label for="curriculum" class="basic-black-btn">Add | update a curriculum</label>
                            <input type="file" id="curriculum" name="curriculum" hidden
                                @input="form.curriculum = $event.target.files[0]"/>
                        </div>
                        <div class="user-actions" v-else>
                            <button class="curri">
                                Curriculum
                                <span class="material-symbols-outlined">download</span>
                            </button>
                            <button class="about">About me</button>
                            <button class="subs">Subscribe <span>$2.88</span></button>
                        </div>
                    </div>
                </header>
                <hr>
                <section class="about" v-if="localType == 'M'">
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
                <div class="update-profile-btn" v-if="localType == 'M'">
                    <button type="submit" class="basic-fouth-btn">Update Profile</button>
                </div>
            </form>
            <section class="about-show" v-if="localType == 'S'">
                <div class="about-info">
                    <h3>About {{ user.name }}</h3>
                    <p>{{ user.about }}</p>
                </div>
                <div class="about-image">
                    <img :src="user.about_image" v-if="user.about_image">
                    <span v-else>With out image 😔</span>
                </div>
            </section>
            <hr>
            <section class="user-projects">
                <div class="head" v-if="localType == 'M'">
                    <h3>Your Proyects</h3>
                    <Link :href="route('project.create')">
                        <button class="basic-succes-btn">Add Project +</button>
                    </Link>
                </div>
                <div class="head-show" v-else>
                    <h3>Some of {{ user.name }}’s projects</h3>
                    <p>Here you can find some of the artist's most outstanding projects.</p>
                </div>
                <div class="projects-grid mt-2" v-if="projects.length > 0">
                    <div class="card-p" v-for="project in projects">
                        <div class="actions" v-if="localType == 'M'">
                            <Link class="show-btn" :href="route('project.show', project)">
                                <span class="material-symbols-outlined">visibility</span>
                            </Link>
                            <Link :href="route('project.edit', project)" class="edit-btn">
                                <span class="material-symbols-outlined">edit</span>
                            </Link>
                            <div class="delete-btn" @click="deleteProject(project)">
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
                    <p>Some refereces about the artist job</p>
                </div>
                <div class="references-grid" v-if="references.length > 0">
                    <div class="card-ref" v-for="reference in references">
                        <div class="card-ref-head">
                            <div class="user-data">
                                <div class="user-photo-o">
                                    <img :src="reference.author.perfil_photo" alt="" v-if="reference.author.perfil_photo">
                                    <img src="../../img/user.png" alt="" v-else>
                                </div>
                                <span>{{ reference.author.name }}</span>
                            </div>
                            <div class="trash-top-btn" v-if="localType == 'M' || reference.author.id === userAuth.id"  @click="deleteReference(reference)">
                                <span class="material-symbols-outlined">delete</span>
                            </div>
                        </div>
                        <p>
                            {{ reference.content }}
                        </p>
                    </div>
                </div>
                <div class="no-content" v-else>
                    No references yet
                </div>
                <form @submit.prevent="makeReference" class="add-reference" v-if="localType == 'S'">
                    <div class="user-photo-o">
                        <img :src="userAuth.perfil_photo" alt="" v-if="userAuth.perfil_photo">
                        <img src="../../img/user.png" alt="" v-else>
                    </div>
                    <textarea name="reference" v-model="reference.comment" id="reference" :placeholder="`Give a reference about ${user.name}:`" cols="30" rows="10"></textarea>
                    <button class="basic-succes-btn">Comment</button>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

 <script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Inertia } from "@inertiajs/inertia";
import Multiselect from 'vue-multiselect';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

export default {

    components: {

        AuthenticatedLayout,
        Multiselect,
        InputError,
        InputLabel,
        TextInput,
        Head,
        Link,

    },


    props: {

        user: Object,
        projects: Object,
        projectsCount: Number,
        references: Object,
        localType: String,
        userAuth: {
            Object,
            default: null,
        },
        socialMedias: {
            Object,
            default: null,
        },

    },

    data () {
        return {

            form: useForm({
                perfil_photo: null,
                curriculum: null,
                about: '',
                about_image: null,
                socialMedias: [],
                _method: 'put',
            }),

            socialMedia: {
                media: null,
                url: '',
            },

            reference: useForm({
                comment: null,
            }),

            showSocialMediaForm: false,
        }
    },

    mounted() {
        this.form.about = this.user.about;
        this.form.socialMedias = this.user.social_medias.map(item => {
            return {
                media: {
                    id: item.id,
                    name: item.name,
                    icon: item.icon
                },
                url: item.pivot.url
            };
        });
    },

    methods: {

        showSocialMedia() {
            this.showSocialMediaForm = !this.showSocialMediaForm;
        },

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
                    if (this.form.errors.socialMedias) {
                        this.form.reset('socialMedias');
                    }
                },
            });
        },

        makeReference() {
            this.reference.post(route('reference.store', this.user), {
                preserveScroll: true,
                onSuccess: () => this.reference.reset(),
                onError: () => {
                    if (this.reference.errors.comment) {
                        this.reference.reset('comment');
                    }
                },
            });
        },

        deleteProject(project){
            alert('Are you sure?');
            Inertia.delete(route('project.destroy', project), {
                preserveScroll: true,
                preserveState: true,
            });
        },

        deleteReference(reference){
            alert('Are you sure?')
            Inertia.delete(route('references.destroy', reference), {
                preserveScroll: true,
                preserveState: true,
            });
        },

        addSocialMedia(socialMedia) {
            this.form.socialMedias.push(socialMedia);
            this.socialMedia = {
                media: null,
                url: '',
            };
        },

        deleteSocialMedia(index) {
            this.form.socialMedias.splice(index, 1);
        }
    },
}

</script>
