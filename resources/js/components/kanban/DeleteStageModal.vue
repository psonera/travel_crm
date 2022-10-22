<template>
    <button type="button" @click="isOpen = true" class="bg-white border-2 border-red-500 mb-2 mr-2 p-2 py-2.5 rounded text-red-500 text-sm"><i class="fa fa-trash"></i></button>
    <teleport to="body">
        <div
            v-show="isOpen"
            @click="isOpen = false"
            class="
            fixed inset-0 w-full h-screen flex items-center justify-center
            bg-gray-800 bg-opacity-50
            overflow-hidden
            z-10
            "
        >
            <div class="relative w-full max-w-lg p-3 mx-auto my-auto rounded-xl shadow-lg bg-white">
                <div>
                    <div class="text-center p-3 flex-auto justify-center leading-6">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-16 h-16 flex items-center text-red-500 mx-auto"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                        fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"
                        />
                    </svg>
                    <h2 class="text-2xl font-bold py-4">Are you sure?</h2>
                    <p class="text-md text-gray-500 px-8">
                        Do you really want to delete this stage? <br />
                        <span class="text-red-400 font-bold text-sm text-center">Note: This action can't be undone</span>
                    </p>
                    </div>
                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <button @click="confirm" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-md hover:shadow-lg hover:bg-red-600">
                            Yes, I Understand
                        </button>
                        <button @click="isOpen = false" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-md hover:shadow-lg hover:bg-gray-100">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>
<script>
export default {
    emits: ["confirm"],
    data() {
        return {
            isOpen: false
        };
    },
    props: {
        stage_id: Number
    },
    methods: {
        confirm(){
            this.$emit('confirm', this.stage_id)
        }
    }
}
</script>