<template>
  <div class="task-card flex flex-col border border-gray-600 px-2 py-3">
      <!-- Actions -->
      <div class="flex flex-row-reverse">
        <!-- Delete -->
        <div
            class="close bg-red-500 text-white px-1 py-1 leading-none rounded-sm text-xs cursor-pointer"
            @click="onRemove"
        >x</div>
        <!-- Edit -->
        <div
            class="edit mr-1 bg-blue-500 text-white px-1 py-1 leading-none rounded-sm text-xs cursor-pointer"
            @click="onEdit"
        >edit</div>
      </div>

    <!-- Main content -->
      <div class="created-at text-gray-600 text-sm font-medium">{{ dueDate }} - <span>#{{ id }}</span></div>
      <div class="name font-bold mt-2">{{ name }}</div>
      <div>
        <div
            class="status font-bold text-xs mt-2 rounded-md text-white px-4 py-1 inline-block"
            :class="statusClass"
        >
            {{ getStatusLabel(status) }}
        </div>
      </div>
  </div>
</template>

<script>
export default {
    props: {
        id: {
            type: Number,
            default: null
        },
        name: {
            type: String,
            default: null
        },
        dueDateAt: {
            type: String,
            default: null
        },
        status: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            statuses: {
                open: 'New',
                in_progress: 'In Progress',
                done: 'Completed',
            }
        }
    },
    computed: {
        dueDate() {
            return this.dueDateAt ? this.$helpers.formatDate(this.dueDateAt, 'MM/DD/YYYY') : null
        },
        statusClass() {
            return {
                'bg-green-400': this.status === 'open',
                'bg-blue-400': this.status === 'in_progress',
                'bg-gray-400': this.status === 'done',
            }
        }
    },
    methods: {
        getStatusLabel(key) {
            return this.statuses.hasOwnProperty(key) ? this.statuses[key] : null
        },
        onEdit() {
            this.$emit('onEdit', this.id)
        },
        onRemove() {
            this.$emit('onRemove', this.id)
        }
    }
}
</script>

<style lang="scss" scoped>
</style>