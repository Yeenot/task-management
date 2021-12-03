<template>
    <div>
        <task-form-modal
            v-model="taskForm.show"
            :task-id="taskForm.id"
            @onSave="onSave"
        >
        </task-form-modal>

        <!-- Main content -->
        <div class="mt-6">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                @click="onCreateNewTask"
            >
                Create New Task
            </button>
        </div>
        <div class="tasks mt-4 grid grid-cols-5 gap-4">
            <div
                v-for="task in tasks"
                :key="task.id"
            >
                <task-card
                    :id="task.id"
                    :name="task.name"
                    :due-date-at="task.created_at"
                    :status="task.status"
                    @onEdit="onEditTask"
                    @onRemove="onRemoveTask"
                >
                </task-card>
            </div>
        </div>
    </div>
</template>

<script>
import TaskFormModal from "../../components/TaskFormModal.vue";


export default {
    components: {
        TaskFormModal
    },
    data: () => ({
        tasks: [],
        taskForm: {
            show: false,
            id: null
        }
    }),
    mounted() {
        this.initialize();
    },
    methods: {
        initialize() {
            this.getTasks()
        },
        getTasks() {
            var vm = this
            var params = {
                search: this.search
            }
            axios.get(`/api/tasks`, { params })
                .then((response) => {
                    if (response.status === 200) {
                        vm.tasks = response.data.data
                    }
                });
        },
        onCreateNewTask() {
            this.taskForm.id = null
            this.taskForm.show = true
        },
        onSave() {
            var vm = this
            vm.taskForm.show = false
            vm.getTasks()
        },
        onEditTask(id) {
            var vm = this
            vm.taskForm.id = id
            vm.taskForm.show = true
        },
        onRemoveTask(id) {
            var vm = this
            axios.delete(`/api/tasks/${id}`)
                .then((response) => {
                    vm.getTasks()
                });
        }
    }
}
</script>