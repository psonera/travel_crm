<template>
    <button type="button" @click="isOpen = true" class="bg-black ml-auto bg-success block p-2 rounded-xl text-white">+ Add New Stage</button>
    <teleport to="body">
        <div
            v-show="isOpen"
            class="
            fixed inset-0 w-full h-screen flex items-center justify-center
            bg-gray-800 bg-opacity-50
            overflow-hidden
            z-10
            "
        >
            <div class="relative w-full max-w-lg p-3 mx-auto my-auto rounded-xl shadow-lg bg-white">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
                        <div class="relative flex flex-col min-w-0 mb-6 break-words border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                                <h2 class="text-xl font-bold">Create Lead Pipeline Stage</h2>
                                <span class="ml-auto hover:cursor-pointer" @click="isOpen = false"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                            <div class="flex-auto p-6">
                                <form role="form" method="POST" action="/lead_pipeline_stages/store">
                                    <slot></slot>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                            Add Lead Pipeline Stage</button>    
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>
<script>
export default {
    data() {
        return {
            isOpen: false
        };
    }
}
</script>