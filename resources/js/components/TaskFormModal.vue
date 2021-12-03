<template>
    <modal
        name="task"
        @before-close="beforeClose"
    >
        <div class="px-6 py-4">
            <div class="text-2xl font-bold">{{ title }}</div>
            <div class="flex flex-col mt-4">
                <div class="flex flex-col">
                    <label>Name</label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        type="text"
                        v-model="form.name"
                        placeholder="Task Name Here..."
                    >
                </div>
                <div class="flex flex-col" v-if="taskId">
                    <label>Status</label>
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        v-model="form.status"
                    >
                        <option value="open">New</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Completed</option>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <button
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded"
                    :class="saveClass"
                    :disabled="isSaveDisabled"
                    @click="save"
                >
                    <template v-if="saving">
                        Saving...
                    </template>
                    <template v-else>
                        Save
                    </template>
                </button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    props: {
        value: {
            type: Boolean,
            default: false
        },
        taskId: {
            type: Number,
            default: null
        }
    },
    data() {
        return {
            loading: false,
            saving: false,
            form: {
                name: null,
                status: "open"
            }
        }
    },
    watch: {
        value(value) {
            this.toggle(value)
        },
    },
    computed: {
        title() {
            return this.taskId ? 'Edit Task': 'Create New Task'
        },
        isSaveDisabled() {
            return this.loading || this.saving
        },
        saveClass() {
            return {
                'hover:bg-blue-700': !this.isSaveDisabled,
                'bg-blue-900': this.isSaveDisabled,
            }
        }
    },
    created() {
        this.initialization()
    },
    methods: {
        initialization() {
            this.toggle(this.show)
        },
        toggle(show) {
            if (show) {
                this.getTask()
                this.$modal.show('task')
            } else {
                this.$modal.hide('task')
            }
            this.emitValue(show)
        },
        emitValue(value) {
            this.$emit('input', value)
        },
        beforeClose() {
            this.emitValue(false)
        },
        getTask() {
            var vm = this
            if (vm.taskId) {
                vm.loading = true
                axios.get(`/api/tasks/${vm.taskId}`)
                    .then((response) => {
                        if (response.status === 200) {
                            var data = response.data.data
                            vm.form.name = data.name
                            vm.form.status = data.status
                        }
                        vm.loading = false
                    });
            }
        },
        save() {
            var vm = this
            var promise = vm.taskId ? vm.update() : vm.create()
            vm.saving = true
            promise.then((response) => {
                vm.saving = false
                vm.clearForm()
                vm.$emit('onSave')
            });
        },
        create() {
            return axios.post(`/api/tasks`, this.form)
        },
        update() {
            return axios.put(`/api/tasks/${this.taskId}`, this.form)
        },
        clearForm() {
            this.form = {
                name: null,
                status: "open"
            }
        }
    }
}
</script>

<style>

</style>