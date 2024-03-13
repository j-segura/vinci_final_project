<template>
    <Head title="Post Project"/>

    <AuthenticatedLayout>
        <div class="project-show-view">
            <div class="title">
                <h2><span>{{ project.title }}</span> | {{ project.author.name }}</h2>
                <Link>
                    <button class="gray-btn"><span class="material-symbols-outlined">arrow_back</span></button>
                </Link>
            </div>
            <section class="project">
                <div class="image">
                    <img :src="project.image" alt="">
                </div>
                <div class="description">
                    <h3>Description</h3>
                    <div class="tags">
                        <span v-for="tag in project.tags">{{ tag.name }}</span>
                    </div>
                    <p>{{ project.description }}</p>
                    <div class="actions">
                        <div><span class="material-symbols-outlined">thumb_up</span>{{ project.likes }}</div>
                        <div><span class="material-symbols-outlined">chat</span>100</div>
                    </div>
                </div>
            </section>
            <section class="comments">
                <h3>Comments</h3>
                <div class="comment-sec">
                    <form class="input" @submit.prevent="addComment">
                        <textarea v-model="form.comment" cols="20" rows="10" placeholder="Make a comment about this work"></textarea>
                        <button type="submit" class="basic-fouth-btn">Post comment</button>
                    </form>
                    <div class="comments-square">
                        <div v-if="project.comments.length > 0">
                            <div class="comment" v-for="comment in project.comments">
                                <div class="coment-header" >
                                    <div class="user-data">
                                        <div class="user-photo-o">
                                            <img :src="comment.author.perfil_photo" v-if="comment.author.perfil_photo">
                                            <img src="../../img/user.png" v-else>
                                        </div>
                                        <span>{{ comment.author.name }}</span>
                                    </div>
                                    <span class="material-symbols-outlined delete"
                                        v-if="comment.author_id === authUser"
                                        @click="deleteComment(comment)">
                                        delete
                                    </span>
                                </div>
                                <p>{{ comment.content }}</p>
                            </div>
                        </div>
                        <div class="no-content" v-else>
                            Be the first to comment
                        </div>
                    </div>
                </div>
            </section>
            <section class="more">
                <h3>More from</h3>
                <div class="aditional-projects">
                    <div v-for="work in moreProjects">
                        <Link :href="route('project.show', work)">
                            <img :src="work.image" :alt="work.title">
                            <span>{{ work.title }}</span>
                        </Link>
                    </div>
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
import { Inertia } from "@inertiajs/inertia";

export default {

    components: {

        AuthenticatedLayout,
        Head,
        Link,

    },

    props: {
        project: Object,
        moreProjects: Object,
        authUser: Number,
    },

    data () {
        return {
            form: useForm({
                comment: "",
            })
        };
    },

    methods: {

        addComment() {
            this.form.post(route('comments.store', this.project), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.comment) {
                        this.form.reset('comment');
                    }
                },
            });
        },

        deleteComment(comment){
            Inertia.delete(route('comments.delete', comment), {
                preserveScroll: true,
                preserveState: true,
            });
        },

    },

}

</script>
