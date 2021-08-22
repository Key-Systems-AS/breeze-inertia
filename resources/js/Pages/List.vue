<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <draggable
                            v-model="myArray"
                            group="people"
                            @start="drag=true"
                            @end="onEnd"
                            item-key="id">
                            <template #item="{element}">
                                <div>{{element.name}}</div>
                            </template>
                        </draggable>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import draggable from 'vuedraggable'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        draggable,
        Head,
    },
    props: {

    },
    data() {
        return {
            drag: false,
            myArray: [
                { name: "Angular", id:0 },
                { name: "React", id:1 },
                { name: "Vue", id:2 },
                { name: "HTML", id:3 },
            ],
            oldIndex: '',
            newIndex: ''
        }
    },
    methods: {
        onEnd: function(evt) {
            console.log(evt);
            this.oldIndex = evt.oldIndex;
            this.newIndex = evt.newIndex;
        }
    }
}
</script>
