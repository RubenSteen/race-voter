<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage, Link, Head } from "@inertiajs/inertia-vue3";
import { ChevronRightIcon } from "@heroicons/vue/20/solid";
import { MegaphoneIcon, XMarkIcon } from "@heroicons/vue/24/outline";

const props = defineProps({
    polls: Object,
});
</script>

<template>
    <Head title="Polls" />

    <DefaultLayout>
        <template #headerName> Polls </template>

        <template #headerButton>
            <span class="ml-3">
                <Link
                    :href="route('poll.create')"
                    type="button"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                >
                    Create poll
                </Link>
            </span>
        </template>

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                    >
                        <div
                            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                        >
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                        >
                                            Name
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Opens at
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Closes at
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Race date/time
                                        </th>
                                        <th
                                            scope="col"
                                            class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                        >
                                            <span class="sr-only">Show</span>
                                        </th>
                                        <th
                                            scope="col"
                                            class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                        >
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 bg-white"
                                >
                                    <tr v-for="poll in polls" :key="poll.id">
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium sm:pl-6 text-gray-900"
                                        >
                                            {{ poll.name }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium sm:pl-6 text-gray-900"
                                        >
                                            {{ poll.open_at }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium sm:pl-6 text-gray-900"
                                        >
                                            {{ poll.close_at }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium sm:pl-6 text-gray-900"
                                        >
                                            {{ poll.race_at }}
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                        >
                                            <Link
                                                :href="
                                                    route('poll.show', poll.id)
                                                "
                                                as="button"
                                                class="text-purple-600 hover:text-purple-900"
                                                >Show<span class="sr-only"
                                                    >, {{ poll.id }}</span
                                                ></Link
                                            >
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'poll.destroy',
                                                        poll.id
                                                    )
                                                "
                                                method="delete"
                                                as="button"
                                                class="text-red-600 hover:text-red-900"
                                                >Delete<span class="sr-only"
                                                    >, {{ poll.id }}</span
                                                ></Link
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
