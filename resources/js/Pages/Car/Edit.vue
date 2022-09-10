<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage, useForm, Link, Head } from "@inertiajs/inertia-vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    ChevronRightIcon,
    ChevronDownIcon,
    LinkIcon,
    ExclamationCircleIcon,
} from "@heroicons/vue/20/solid";

const props = defineProps({
    car: Object,
});

const form = useForm({
    name: props.car.name,
    image: props.car.image,
    source: props.car.source,
});

const submit = () => {
    // https://inertiajs.com/manual-visits
    form.put(route("car.update", props.car.id), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Editing car" />

    <DefaultLayout>
        <template #headerName> Editing {{ car.name }} </template>

        <template #headerButton>
            <Link
                as="button"
                method="delete"
                :href="route('car.destroy', props.car.id)"
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
                Delete
            </Link>
        </template>

        <div class="bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <form
                    class="space-y-8 divide-y divide-gray-200"
                    @submit.prevent="submit"
                >
                    <div class="space-y-8 divide-y divide-gray-200">
                        <div>
                            <div>
                                <h3
                                    class="text-lg font-medium leading-6 text-gray-900"
                                >
                                    Car information
                                </h3>
                            </div>

                            <div
                                class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                            >
                                <div class="sm:col-span-4">
                                    <div class="flex justify-between">
                                        <label
                                            for="name"
                                            class="block text-sm font-medium text-gray-700"
                                            >Car name</label
                                        >
                                        <span
                                            class="text-sm text-gray-500"
                                            id="name-optional"
                                            >Required</span
                                        >
                                    </div>
                                    <div
                                        class="relative mt-1 rounded-md shadow-sm"
                                    >
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            v-model="form.name"
                                            :class="[
                                                form.errors.name
                                                    ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500'
                                                    : 'border-gray-300 focus:ring-purple-500 focus:border-purple-500',
                                                'block w-full shadow-sm sm:text-sm rounded-md pr-10',
                                            ]"
                                            placeholder="LA Canyons"
                                            aria-invalid="true"
                                            aria-describedby="name-error"
                                        />
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                        >
                                            <ExclamationCircleIcon
                                                v-if="form.errors.name"
                                                class="h-5 w-5 text-red-500"
                                                aria-hidden="true"
                                            />
                                        </div>
                                    </div>
                                    <p
                                        class="mt-2 text-sm text-red-600"
                                        id="name-error"
                                        v-if="form.errors.name"
                                    >
                                        {{ form.errors.name }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                            >
                                <div class="sm:col-span-4">
                                    <div class="flex justify-between">
                                        <label
                                            for="source"
                                            class="block text-sm font-medium text-gray-700"
                                            >Car source</label
                                        >
                                        <span
                                            class="text-sm text-gray-500"
                                            id="source-optional"
                                            >Optional</span
                                        >
                                    </div>
                                    <div
                                        class="relative mt-1 rounded-md shadow-sm"
                                    >
                                        <input
                                            type="text"
                                            name="source"
                                            id="source"
                                            v-model="form.source"
                                            :class="[
                                                form.errors.source
                                                    ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500'
                                                    : 'border-gray-300 focus:ring-purple-500 focus:border-purple-500',
                                                'block w-full shadow-sm sm:text-sm rounded-md pr-10',
                                            ]"
                                            placeholder="https://www.racedepartment.com/downloads/la-canyons.15067/"
                                            aria-invalid="true"
                                            aria-describedby="source-error"
                                        />
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                                        >
                                            <ExclamationCircleIcon
                                                v-if="form.errors.source"
                                                class="h-5 w-5 text-red-500"
                                                aria-hidden="true"
                                            />
                                        </div>
                                    </div>
                                    <p
                                        class="mt-2 text-sm text-red-600"
                                        id="source-error"
                                        v-if="form.errors.source"
                                    >
                                        {{ form.errors.source }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5">
                        <div class="flex justify-end">
                            <Link
                                :href="route('car.index')"
                                as="button"
                                type="button"
                                class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                            >
                                Cancel
                            </Link>
                            <button
                                type="submit"
                                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-purple-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </DefaultLayout>
</template>
