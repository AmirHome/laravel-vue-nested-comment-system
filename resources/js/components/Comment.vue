<template>
    <div>
        <div class="card border-0 bg-white shadow-sm mb-2 py-2 px-3">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <div class="d-flex">
                        <h6 class="mb-1 font-weight-bold">{{ comment.name }}</h6>
                        <small class="ml-auto font-wight-light text-muted">{{ comment.created_at }}</small>
                    </div>

                    <p class="mb-0">{{ comment.comment }}</p>
                </div>
                <button  v-if="level < 3" class="btn btn-link" @click="respond=!respond">
                    <span v-if="!respond">Reply</span>
                    <span v-if="respond">Close</span>
                </button>
            </div>

            <div>
                <comment-form v-if="respond" class="mt-3" :comments="comment.children" :parent="comment" :toggle="respond" @toggle="toggleForm()"></comment-form>
            </div>
        </div>

        <div v-if="comment.children.length" class="pl-3 container-children-comment">
            <comment v-for="c in comment.children" :key="c.id" :comment="c" :level="level+1"></comment>
        </div>
    </div>
</template>

<script>
    import CommentForm from '../components/CommentForm.vue';

    export default {
        components: {
            'comment-form': CommentForm,
        },
        name: 'comment',

        props: ['comment', 'level'],

        data: function() {
            return {
                respond: false
            }
        },


        methods: {
            /**
             * Toggles the form for this comment
             */
            toggleForm: function() {
                this.respond = !this.respond;
            },
        }
    }
</script>
