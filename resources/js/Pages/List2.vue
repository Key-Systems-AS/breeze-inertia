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
                    <div class="p-6 bg-white border-b border-gray-200 w-2/4">

                    <draggable
                        class="list-group"
                        tag="transition-group"
                        :component-data="{
                            tag: 'ul',
                            type: 'transition-group',
                            name: !drag ? 'flip-list' : null
                        }"
                        v-model="list"
                        v-bind="dragOptions"
                        @start="drag = true"
                        @end="drag = false"
                        item-key="order"
                        >
                        <template #item="{ element }">
                            <li class="list-group-item">
                            <i
                                :class="
                                element.fixed ? 'fa fa-anchor' : 'glyphicon glyphicon-pushpin'
                                "
                                @click="element.fixed = !element.fixed"
                                aria-hidden="true"
                            ></i>
                            {{ element.name }}
                            </li>
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

const message = [
  "vue.draggable",
  "draggable",
  "component",
  "for",
  "vue.js 2.0",
  "based",
  "on",
  "Sortablejs"
];

export default {
    name: "transition-example-2",
    display: "Transitions",
    order: 7,
    components: {
        BreezeAuthenticatedLayout,
        draggable,
        Head,
    },
    data() {
        return {
        list: message.map((name, index) => {
            return { name, order: index + 1 };
        }),
        drag: false
        };
    },
    methods: {
        sort() {
        this.list = this.list.sort((a, b) => a.order - b.order);
        }
    },
    computed: {
        dragOptions() {
        return {
            animation: 200,
            group: "description",
            disabled: false,
            ghostClass: "ghost"
        };
        }
    }
}
</script>


<style>
.button {
  margin-top: 35px;
}
.flip-list-move {
  transition: transform 0.5s;
}
.no-move {
  transition: transform 0s;
}
.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}
.list-group {
    display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    -ms-flex-direction: column;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    border-radius: .25rem;
}
.list-group-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.125);
}
.list-group-item i {
  cursor: pointer;
}
</style>
