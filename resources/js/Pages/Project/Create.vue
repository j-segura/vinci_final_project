<template>
    <Head title="Post Project"/>

    <AuthenticatedLayout>
        <div class="project-view">
            <h2>+ Add a new project to the portfolio</h2>
            <form @submit.prevent="submit">
                <div class="grid-2">
                    <div class="space-y-6 col-12 col-md-6">
                        <div class="input-p">
                            <InputLabel for="name" value="Project title | name *" />

                            <TextInput
                                id="name"
                                ref="nameInput"
                                v-model="form.name"
                                type="text"
                                class="block w-full"
                                placeholder="Write a title"
                                autocomplete="name-input"
                            />

                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="typo__label">Categorie(s) *</label>
                        <multiselect
                            v-model="value"
                            tag-placeholder="Add this as new tag"
                            placeholder="Search or add a tag"
                            label="name" track-by="code"
                            :options="options"
                            :multiple="true"
                            :taggable="true"
                            @tag="addTag">
                        </multiselect>
                    </div>
                </div>
                <label for="description">Description *</label>
                <textarea name="description"  cols="30" rows="10" placeholder="Write a  interesting description..."></textarea>
                <div class="my-4 mt-6">
                    <label for="image" class="basic-fouth-btn ">Upload an image</label>
                    <input type="file" id="image" name="image" hidden
                        @input="form.image = $event.target.files[0]"/>
                </div>
                <div class="project-image-view">
                    <img src="./../../img/main.jpg" alt="">
                </div>
                <div class="omt-8">
                    <button type="submit" class="basic-succes-btn">Create Category</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Multiselect from 'vue-multiselect'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

export default {

    components: {

        AuthenticatedLayout,
        Head,
        Multiselect,
        InputError,
        InputLabel,
        TextInput,

    },

    data () {
        return {
            value: [
                { name: 'Javascript', code: 'js' }
            ],
            options: [
                { name: 'Colorida', code: 'vu' },
                { name: 'Anime', code: 'js' },
                { name: 'Monas chinas', code: 'os' }
            ],

            form: useForm({
                name: "",
            })
        }
    },

    methods: {
        addTag (newTag) {
        const tag = {
            name: newTag,
            code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
        }
        this.options.push(tag)
        this.value.push(tag)
        }
    }

}

</script>
