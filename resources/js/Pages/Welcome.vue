<script setup>
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
    { name: "Vote", href: "#", current: true },
    { name: "Cars", href: "#", current: false },
    { name: "Tracks", href: "#", current: false },
];
const userNavigation = [{ name: "Sign out", href: "#" }];

const suggests = [
    {
        car: {
            name: "Subaru Impreza WRX STi GRB",
            image: "https://assettocorsa.club/assets/template/images/auto/subaru-impreza-wrx-sti/large/image1.jpg",
        },
        track: {
            name: "SS Peyregrosse-Mandagout",
            image: "https://assettocorsa.club/assets/template/images/tracks/ss-peyregrosse-mandagout/large/image1.jpg",
        },
    },
    // More suggests...
];
const publishingOptions = [
    {
        name: "Published",
        description:
            "This job posting can be viewed by anyone who has the link.",
        current: true,
    },
    {
        name: "Draft",
        description: "This job posting will no longer be publicly accessible.",
        current: false,
    },
];

const selected = ref(publishingOptions[0]);
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
                            <Menu as="div" class="relative ml-3 flex-shrink-0">
                                <div>
                                    <MenuButton
                                        class="flex rounded-full bg-gray-50 text-sm text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                                    >
                                        <span class="sr-only"
                                            >Open user menu</span
                                        >
                                        <img
                                            class="h-8 w-8 rounded-full"
                                            :src="user.imageUrl"
                                            alt=""
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
                    <DisclosureButton
                        v-for="item in navigation"
                        :key="item.name"
                        as="a"
                        :href="item.href"
                        :class="[
                            item.current ? 'bg-gray-100' : 'hover:bg-gray-100',
                            'block px-3 py-2 rounded-md font-medium text-gray-900',
                        ]"
                        :aria-current="item.current ? 'page' : undefined"
                        >{{ item.name }}</DisclosureButton
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
                        <DisclosureButton
                            v-for="item in userNavigation"
                            :key="item.name"
                            as="a"
                            :href="item.href"
                            class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-100"
                            >{{ item.name }}</DisclosureButton
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
                        Votes
                    </h1>
                </div>
                <div class="mt-5 flex xl:mt-0 xl:ml-4">
                    <span class="hidden sm:block">
                        <button
                            type="button"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                        >
                            <PencilIcon
                                class="-ml-1 mr-2 h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                            Edit
                        </button>
                    </span>

                    <span class="ml-3 hidden sm:block">
                        <button
                            type="button"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                        >
                            <LinkIcon
                                class="-ml-1 mr-2 h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                            View
                        </button>
                    </span>

                    <Listbox as="div" v-model="selected" class="sm:ml-3">
                        <ListboxLabel class="sr-only">
                            Change published status
                        </ListboxLabel>
                        <div class="relative">
                            <div
                                class="inline-flex divide-x divide-purple-600 rounded-md shadow-sm"
                            >
                                <div
                                    class="inline-flex divide-x divide-purple-600 rounded-md shadow-sm"
                                >
                                    <div
                                        class="inline-flex items-center rounded-l-md border border-transparent bg-purple-500 py-2 pl-3 pr-4 text-white shadow-sm"
                                    >
                                        <CheckIcon
                                            class="h-5 w-5"
                                            aria-hidden="true"
                                        />
                                        <p class="ml-2.5 text-sm font-medium">
                                            {{ selected.name }}
                                        </p>
                                    </div>
                                    <ListboxButton
                                        class="inline-flex items-center rounded-l-none rounded-r-md bg-purple-500 p-2 text-sm font-medium text-white hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                                    >
                                        <span class="sr-only"
                                            >Change published status</span
                                        >
                                        <ChevronDownIcon
                                            class="h-5 w-5 text-white"
                                            aria-hidden="true"
                                        />
                                    </ListboxButton>
                                </div>
                            </div>

                            <transition
                                leave-active-class="transition ease-in duration-100"
                                leave-from-class="opacity-100"
                                leave-to-class="opacity-0"
                            >
                                <ListboxOptions
                                    class="absolute left-0 z-10 mt-2 -mr-1 w-72 origin-top-right divide-y divide-gray-200 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:left-auto sm:right-0"
                                >
                                    <ListboxOption
                                        as="template"
                                        v-for="option in publishingOptions"
                                        :key="option.name"
                                        :value="option"
                                        v-slot="{ active, selected }"
                                    >
                                        <li
                                            :class="[
                                                active
                                                    ? 'text-white bg-purple-500'
                                                    : 'text-gray-900',
                                                'cursor-default select-none p-4 text-sm',
                                            ]"
                                        >
                                            <div class="flex flex-col">
                                                <div
                                                    class="flex justify-between"
                                                >
                                                    <p
                                                        :class="
                                                            selected
                                                                ? 'font-semibold'
                                                                : 'font-normal'
                                                        "
                                                    >
                                                        {{ option.name }}
                                                    </p>
                                                    <span
                                                        v-if="selected"
                                                        :class="
                                                            active
                                                                ? 'text-white'
                                                                : 'text-purple-500'
                                                        "
                                                    >
                                                        <CheckIcon
                                                            class="h-5 w-5"
                                                            aria-hidden="true"
                                                        />
                                                    </span>
                                                </div>
                                                <p
                                                    :class="[
                                                        active
                                                            ? 'text-purple-200'
                                                            : 'text-gray-500',
                                                        'mt-2',
                                                    ]"
                                                >
                                                    {{ option.description }}
                                                </p>
                                            </div>
                                        </li>
                                    </ListboxOption>
                                </ListboxOptions>
                            </transition>
                        </div>
                    </Listbox>

                    <!-- Dropdown -->
                    <Menu as="div" class="relative ml-3 sm:hidden">
                        <MenuButton
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                        >
                            More
                            <ChevronDownIcon
                                class="-mr-1 ml-2 h-5 w-5 text-gray-500"
                                aria-hidden="true"
                            />
                        </MenuButton>

                        <transition
                            enter-active-class="transition ease-out duration-200"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <MenuItems
                                class="absolute right-0 z-10 mt-2 -mr-1 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            >
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active ? 'bg-gray-100' : '',
                                            'block px-4 py-2 text-sm text-gray-700',
                                        ]"
                                        >Edit</a
                                    >
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active ? 'bg-gray-100' : '',
                                            'block px-4 py-2 text-sm text-gray-700',
                                        ]"
                                        >View</a
                                    >
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
        </header>

        <main class="pt-8 pb-16">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="px-4 sm:px-0">
                    <h2 class="text-lg font-medium text-gray-900">
                        People have voted for...
                    </h2>
                </div>

                <!-- Stacked list -->
                <ul
                    role="list"
                    class="mt-5 divide-y divide-gray-200 border-t border-gray-200 sm:mt-0 sm:border-t-0"
                >
                    <li v-for="suggest in suggests" :key="suggest.email">
                        <a href="#" class="group block">
                            <div
                                class="flex items-center py-5 px-4 sm:py-6 sm:px-0 bg-gray-100"
                            >
                                <div class="flex min-w-0 flex-1 px-4">
                                    <div class="flex-shrink-0 flex flex-col">
                                        <img
                                            class="h-auto w-32 lg:w-64 group-hover:opacity-75"
                                            :src="suggest.car.image"
                                            alt=""
                                        />
                                        <div>
                                            <p
                                                class="truncate text-sm font-medium text-purple-600 text-base"
                                            >
                                                {{ suggest.car.name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4"
                                    >
                                        <div class="flex flex-col">
                                            <div class="flex-shrink-0">
                                                <img
                                                    class="h-auto w-32 lg:w-64 group-hover:opacity-75"
                                                    :src="suggest.track.image"
                                                    alt=""
                                                />
                                            </div>
                                            <div>
                                                <p
                                                    class="text-sm font-medium text-purple-600 text-base"
                                                >
                                                    {{ suggest.track.name }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <ChevronRightIcon
                                        class="h-5 w-5 text-gray-400 group-hover:text-gray-700"
                                        aria-hidden="true"
                                    />
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </main>
    </div>
</template>
