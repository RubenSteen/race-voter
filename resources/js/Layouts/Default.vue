<script setup>
import { Inertia } from "@inertiajs/inertia";
import { usePage, Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
} from "@headlessui/vue";
import {
    ArrowLongLeftIcon,
    ArrowLongRightIcon,
    BriefcaseIcon,
    CalendarIcon,
    CheckCircleIcon,
    CheckIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    CurrencyDollarIcon,
    EnvelopeIcon,
    LinkIcon,
    MagnifyingGlassIcon,
    MapPinIcon,
    PencilIcon,
} from "@heroicons/vue/20/solid";
import { Bars3Icon, BellIcon, XMarkIcon } from "@heroicons/vue/24/outline";

const user = {
    name: "Whitney Francis",
    email: "whitney.francis@example.com",
    imageUrl:
        "https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
};

const navigation = [
    { name: "Vote", href: route("suggest.index"), current: false },
    { name: "Cars", href: route("car.index"), current: false },
    { name: "Tracks", href: route("track.index"), current: false },
];

const userNavigation = [{ name: "Sign out", href: "#" }];
</script>

<template>
    <div class="min-h-full">
        <!-- Navbar -->
        <Disclosure as="nav" class="bg-gray-50" v-slot="{ open }">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div
                    class="relative flex h-16 items-center justify-between border-b border-gray-200"
                >
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img
                                class="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=violet&shade=500"
                                alt="Your Company"
                            />
                        </div>

                        <!-- Links section -->
                        <div class="hidden lg:ml-10 lg:block">
                            <div class="flex space-x-4">
                                <a
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :href="item.href"
                                    :class="[
                                        item.current
                                            ? 'bg-gray-100'
                                            : 'hover:text-gray-700',
                                        'px-3 py-2 rounded-md text-sm font-medium text-gray-900',
                                    ]"
                                    :aria-current="
                                        item.current ? 'page' : undefined
                                    "
                                    >{{ item.name }}</a
                                >
                            </div>
                        </div>
                    </div>

                    <!-- <div
                        class="flex flex-1 justify-center px-2 lg:ml-6 lg:justify-end"
                    >
                        <div class="w-full max-w-lg lg:max-w-xs">
                            <label for="search" class="sr-only">Search</label>
                            <div
                                class="relative text-gray-400 focus-within:text-gray-500"
                            >
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                                >
                                    <MagnifyingGlassIcon
                                        class="h-5 w-5"
                                        aria-hidden="true"
                                    />
                                </div>
                                <input
                                    id="search"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 text-gray-900 placeholder-gray-500 focus:border-purple-500 focus:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-purple-500 sm:text-sm"
                                    placeholder="Search"
                                    type="search"
                                    name="search"
                                />
                            </div>
                        </div>
                    </div>  -->
                    <div class="flex lg:hidden">
                        <DisclosureButton
                            class="inline-flex items-center justify-center rounded-md bg-gray-50 p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                        >
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon
                                v-if="!open"
                                class="block h-6 w-6"
                                aria-hidden="true"
                            />
                            <XMarkIcon
                                v-else
                                class="block h-6 w-6"
                                aria-hidden="true"
                            />
                        </DisclosureButton>
                    </div>

                    <!-- Actions section -->
                    <div class="hidden lg:ml-4 lg:block">
                        <div class="flex items-center">
                            <!-- <button
                                type="button"
                                class="flex-shrink-0 rounded-full bg-gray-50 p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                            >
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true" />
                            </button> -->

                            <!-- Profile dropdown -->
                            <Menu
                                v-if="$page.props.auth.user"
                                as="div"
                                class="relative ml-3 flex-shrink-0"
                            >
                                <div>
                                    <MenuButton
                                        class="flex rounded-full bg-gray-50 text-sm text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                                    >
                                        <span class="sr-only"
                                            >Open user menu</span
                                        >
                                        <img
                                            class="h-8 w-8 rounded-full"
                                            :src="
                                                $page.props.auth.user.getAvatar()
                                            "
                                            alt="Profile picture"
                                        />
                                    </MenuButton>
                                </div>
                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <MenuItem
                                            v-for="item in userNavigation"
                                            :key="item.name"
                                            v-slot="{ active }"
                                        >
                                            <a
                                                :href="item.href"
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'block py-2 px-4 text-sm text-gray-700',
                                                ]"
                                                >{{ item.name }}</a
                                            >
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>
            </div>

            <DisclosurePanel
                class="border-b border-gray-200 bg-gray-50 lg:hidden"
            >
                <div class="space-y-1 px-2 pt-2 pb-3">
                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        as="a"
                        :href="item.href"
                        :class="[
                            item.current ? 'bg-gray-100' : 'hover:bg-gray-100',
                            'block px-3 py-2 rounded-md font-medium text-gray-900',
                        ]"
                        :aria-current="item.current ? 'page' : undefined"
                        >{{ item.name }}</Link
                    >
                </div>
                <div class="border-t border-gray-200 pt-4 pb-3">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0">
                            <img
                                class="h-10 w-10 rounded-full"
                                :src="user.imageUrl"
                                alt=""
                            />
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">
                                {{ user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ user.email }}
                            </div>
                        </div>
                        <!-- <button
                            type="button"
                            class="ml-auto flex-shrink-0 rounded-full bg-gray-50 p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                        >
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="h-6 w-6" aria-hidden="true" />
                        </button> -->
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <Link
                            v-for="item in userNavigation"
                            :key="item.name"
                            as="a"
                            :href="item.href"
                            class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-100"
                            >{{ item.name }}</Link
                        >
                    </div>
                </div>
            </DisclosurePanel>
        </Disclosure>

        <!-- Page heading -->
        <header class="bg-gray-50 py-8">
            <div
                class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 xl:flex xl:items-center xl:justify-between"
            >
                <div class="min-w-0 flex-1">
                    <h1
                        class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"
                    >
                        <slot name="headerName"></slot>
                    </h1>
                </div>
                <div class="mt-5 flex xl:mt-0 xl:ml-4">
                    <slot name="headerButton"></slot>
                </div>
            </div>
        </header>

        <main class="pt-8 pb-16">
            <slot />
        </main>
    </div>
</template>
