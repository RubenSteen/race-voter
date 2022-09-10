<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage, Link, Head } from "@inertiajs/inertia-vue3";
import { Switch } from "@headlessui/vue";
import { watch, ref } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { ExclamationIcon } from "@heroicons/vue/outline";

const props = defineProps({
    users: Object,
});

const selectedUser = ref();

const showBanModal = ref(false);
const showAdminModal = ref(false);

function prepareBanModal(user) {
    selectedUser.value = user;
    showBanModal.value = true;
}

function prepareAdminModal(user) {
    selectedUser.value = user;
    showAdminModal.value = true;
}

function ban() {
    Inertia.put(route("user.ban", selectedUser.value.id));
    selectedUser.value = null;
    showBanModal.value = false;
}

function admin() {
    Inertia.put(route("user.admin", selectedUser.value.id));
    selectedUser.value = null;
    showAdminModal.value = false;
}
</script>

<template>
    <Head title="Users" />

    <!-- Modals -->
    <div>
        <!-- Ban Model -->
        <TransitionRoot as="template" :show="showBanModal">
            <Dialog
                as="div"
                class="relative z-10"
                @close="showBanModal = false"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <div class="fixed z-10 inset-0 overflow-y-auto">
                    <div
                        class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to="opacity-100 translate-y-0 sm:scale-100"
                            leave="ease-in duration-200"
                            leave-from="opacity-100 translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <DialogPanel
                                class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full sm:p-6"
                            >
                                <div class="sm:flex sm:items-start">
                                    <div
                                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                                    >
                                        <ExclamationIcon
                                            class="h-6 w-6 text-red-600"
                                            aria-hidden="true"
                                        />
                                    </div>
                                    <div
                                        class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                                    >
                                        <DialogTitle
                                            v-if="selectedUser"
                                            as="h3"
                                            class="text-lg leading-6 font-medium text-gray-900"
                                        >
                                            {{
                                                selectedUser.banned
                                                    ? "Unban"
                                                    : "Ban"
                                            }}
                                            user
                                        </DialogTitle>
                                        <div v-if="selectedUser" class="mt-2">
                                            <p
                                                v-if="selectedUser.banned"
                                                class="text-sm text-gray-500"
                                            >
                                                Are you sure you want to unban
                                                {{ selectedUser.nickname }}
                                            </p>
                                            <p
                                                v-else
                                                class="text-sm text-gray-500"
                                            >
                                                Are you sure you want to ban
                                                {{ selectedUser.nickname }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse"
                                >
                                    <Link
                                        type="button"
                                        @click="ban(selectedUser)"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                    >
                                        Submit
                                    </Link>
                                    <button
                                        type="button"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                        @click="showBanModal = false"
                                        ref="cancelButtonRef"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
        <!-- End Ban Model -->

        <!-- Admin Model  -->
        <TransitionRoot as="template" :show="showAdminModal">
            <Dialog
                as="div"
                class="relative z-10"
                @close="showAdminModal = false"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <div class="fixed z-10 inset-0 overflow-y-auto">
                    <div
                        class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to="opacity-100 translate-y-0 sm:scale-100"
                            leave="ease-in duration-200"
                            leave-from="opacity-100 translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <DialogPanel
                                class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full sm:p-6"
                            >
                                <div class="sm:flex sm:items-start">
                                    <div
                                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10"
                                    >
                                        <ExclamationIcon
                                            class="h-6 w-6 text-yellow-600"
                                            aria-hidden="true"
                                        />
                                    </div>
                                    <div
                                        class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                                    >
                                        <DialogTitle
                                            v-if="selectedUser"
                                            as="h3"
                                            class="text-lg leading-6 font-medium text-gray-900"
                                        >
                                            {{
                                                selectedUser.admin
                                                    ? "Remove admin"
                                                    : "Make admin"
                                            }}
                                            user
                                        </DialogTitle>
                                        <div v-if="selectedUser" class="mt-2">
                                            <p
                                                v-if="selectedUser.admin"
                                                class="text-sm text-gray-500"
                                            >
                                                Are you sure you want to remove
                                                {{ selectedUser.nickname }} from
                                                their admin status
                                            </p>
                                            <p
                                                v-else
                                                class="text-sm text-gray-500"
                                            >
                                                Are you sure you want to make
                                                {{ selectedUser.nickname }} a
                                                admin
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse"
                                >
                                    <Link
                                        type="button"
                                        @click="admin(selectedUser)"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-yellow-600 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:ml-3 sm:w-auto sm:text-sm"
                                    >
                                        Submit
                                    </Link>
                                    <button
                                        type="button"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                        @click="showAdminModal = false"
                                        ref="cancelButtonRef"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
        <!-- End Admin Model -->
    </div>
    <!-- End Modals -->

    <DefaultLayout>
        <!-- Page Header -->
        <div class="bg-white shadow">
            <div class="px-4 sm:px-6 lg:max-w-6xl lg:mx-auto lg:px-8">
                <div class="py-6 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <!-- Profile -->
                        <div class="flex items-center">
                            <h2 class="font-bold text-xl text-gray-900">
                                Users
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="mt-8">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                        >
                            <div
                                class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                            >
                                <table
                                    class="min-w-full divide-y divide-gray-300"
                                >
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Discord Nickname
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Last Activity
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Banned
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            >
                                                Admin
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 bg-white"
                                    >
                                        <tr
                                            v-for="user in props.users"
                                            :key="user.id"
                                        >
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6"
                                            >
                                                <div class="flex items-center">
                                                    <div
                                                        class="h-10 w-10 flex-shrink-0"
                                                    >
                                                        <img
                                                            class="h-10 w-10 rounded-full"
                                                            :src="user.avatar"
                                                            alt=""
                                                        />
                                                    </div>
                                                    <div class="ml-4">
                                                        <div
                                                            class="font-medium text-gray-900"
                                                        >
                                                            {{ user.nickname }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                            >
                                                <div class="text-gray-900">
                                                    {{ user.last_activity }}
                                                </div>
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                            >
                                                <Switch
                                                    :checked="user.banned"
                                                    @click="
                                                        prepareBanModal(user)
                                                    "
                                                    :class="[
                                                        user.banned
                                                            ? 'bg-cyan-600'
                                                            : 'bg-gray-200',
                                                        'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-20',
                                                    ]"
                                                >
                                                    <span class="sr-only"
                                                        >Use setting</span
                                                    >
                                                    <span
                                                        :class="[
                                                            user.banned
                                                                ? 'translate-x-5'
                                                                : 'translate-x-0',
                                                            'pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                                                        ]"
                                                    >
                                                        <span
                                                            :class="[
                                                                user.banned
                                                                    ? 'opacity-0 ease-out duration-100'
                                                                    : 'opacity-100 ease-in duration-200',
                                                                'absolute inset-0 h-full w-full flex items-center justify-center transition-opacity',
                                                            ]"
                                                            aria-hidden="true"
                                                        >
                                                            <svg
                                                                class="h-3 w-3 text-gray-400"
                                                                fill="none"
                                                                viewBox="0 0 12 12"
                                                            >
                                                                <path
                                                                    d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                />
                                                            </svg>
                                                        </span>
                                                        <span
                                                            :class="[
                                                                user.banned
                                                                    ? 'opacity-100 ease-in duration-200'
                                                                    : 'opacity-0 ease-out duration-100',
                                                                'absolute inset-0 h-full w-full flex items-center justify-center transition-opacity',
                                                            ]"
                                                            aria-hidden="true"
                                                        >
                                                            <svg
                                                                class="h-3 w-3 text-cyan-600"
                                                                fill="currentColor"
                                                                viewBox="0 0 12 12"
                                                            >
                                                                <path
                                                                    d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"
                                                                />
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </Switch>
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                            >
                                                <Switch
                                                    :checked="user.admin"
                                                    @click="
                                                        prepareAdminModal(user)
                                                    "
                                                    :class="[
                                                        user.admin
                                                            ? 'bg-cyan-600'
                                                            : 'bg-gray-200',
                                                        'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-20',
                                                    ]"
                                                >
                                                    <span class="sr-only"
                                                        >Use setting</span
                                                    >
                                                    <span
                                                        :class="[
                                                            user.admin
                                                                ? 'translate-x-5'
                                                                : 'translate-x-0',
                                                            'pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                                                        ]"
                                                    >
                                                        <span
                                                            :class="[
                                                                user.admin
                                                                    ? 'opacity-0 ease-out duration-100'
                                                                    : 'opacity-100 ease-in duration-200',
                                                                'absolute inset-0 h-full w-full flex items-center justify-center transition-opacity',
                                                            ]"
                                                            aria-hidden="true"
                                                        >
                                                            <svg
                                                                class="h-3 w-3 text-gray-400"
                                                                fill="none"
                                                                viewBox="0 0 12 12"
                                                            >
                                                                <path
                                                                    d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                />
                                                            </svg>
                                                        </span>
                                                        <span
                                                            :class="[
                                                                user.admin
                                                                    ? 'opacity-100 ease-in duration-200'
                                                                    : 'opacity-0 ease-out duration-100',
                                                                'absolute inset-0 h-full w-full flex items-center justify-center transition-opacity',
                                                            ]"
                                                            aria-hidden="true"
                                                        >
                                                            <svg
                                                                class="h-3 w-3 text-cyan-600"
                                                                fill="currentColor"
                                                                viewBox="0 0 12 12"
                                                            >
                                                                <path
                                                                    d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"
                                                                />
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </Switch>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
