<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import 'vue-toast-notification/dist/theme-sugar.css';
import {useToast} from 'vue-toast-notification';

const $toast = useToast();

import {Head, useForm} from "@inertiajs/vue3";

const props = defineProps({
    post: Array,
    active: String,
    inactive: String,
})

const form = useForm({
    _method: 'patch',
    title: props.post.title,
    status: props.post.status,
    description: props.post.description,
})

const submit = () => {
    form.submit('post', route("posts.update", props.post.id), {
        onSuccess: () => {
            $toast.success("Post updated successfully!");
        },
        onError: () => {
            $toast.error("Failed to updated post!");
        }
    })
}
</script>

<template>
    <Head>
        <title>Tasks</title>
    </Head>
    <AuthenticatedLayout>

        <div class="grid lg:grid-cols-1 md:grid-cols-2 grid-cols-1 gap-4 px-5 pt-5 max-h-96">
            <div class="col-span-2 border rounded-xl shadow-xl max-h-96">
                <div class="w-full mx-auto">
                    <div class="p-4 sm:p-8 bg-white rounded-xl shadow sm:rounded-lg">
                        <h2 class="p-0 text-secondary text-20 font-medium">Update post</h2>
                        <form @submit.prevent="submit" class="mt-6 space-y-6">
                            <div class="grid grid-cols-3 w-full gap-8">
                                <div
                                    class="col-span-3 grid grid-cols-2 gap-4 p-5 border-gray-100 border rounded-2xl shadow-sm">
                                    <div class="w-full">
                                        <InputLabel for="title" value="Task title" icon="*"/>

                                        <TextInput
                                            id="title"
                                            type="text"
                                            placeholder="ex: Shirt"
                                            class="mt-1 block w-full"
                                            v-model="form.title"/>

                                        <InputError class="mt-2" :message="form.errors.title"/>

                                    </div>

                                    <div class="w-full">
                                        <InputLabel for="text" value="Task description"/>

                                        <textarea
                                            type="text"
                                            placeholder="ex: post description"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            v-model="form.description">

                                        </textarea>

                                        <InputError class="mt-2" :message="form.errors.description"/>

                                    </div>

                                    <div class="grid grid-cols-1 w-full gap-4 col-span-1 justify-center">
                                        <div class="w-full">
                                            <InputLabel value="Status" icon="*"/>
                                            <div class="flex flex-row gap-4 pt-2">
                                                <input
                                                    type="radio"
                                                    class="mt-1"
                                                    v-model="form.status"
                                                    :class="form.status === props.inactive ? '!accent-green' : ''"
                                                    :value=props.inactive
                                                />
                                                <label :class="form.status === props.inactive ? 'text-red-600' : 'text-gray-700'"
                                                       class="font-semibold text-md  self-end capitalize">{{ props.inactive }}</label>

                                                <input
                                                    type="radio"
                                                    class="mt-1"
                                                    v-model="form.status"
                                                    :value=props.active
                                                    :class="form.status === props.active  ? '!accent-danger' : ''"
                                                />
                                                <label :class="form.status === props.active ? 'text-lime-600' : 'text-gray-700'"
                                                       class="font-semibold text-md  self-end capitalize">{{ props.active }}</label>


                                            </div>

                                            <InputError class="mt-2" :message="form.errors.status"/>
                                        </div>

                                    </div>
                                </div>

                            </div>


                            <div class="flex items-center gap-4 justify-end">
                                <PrimaryButton>
                                    <span class="pl-2">update post</span>
                                </PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                </Transition>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
