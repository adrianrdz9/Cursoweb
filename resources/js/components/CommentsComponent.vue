<template>
    <div class="p-4">
        <div class="card mb-4" v-for="comment of comments" :key="comment.id">

            <div class="card-header" style="background-color: rgba(40, 40, 40, 0.3)">
                <div class="row">
                    <div class="col-6">
                        <span style="font-weight: bold; font-size: 1.4em"> {{comment.user.name}} </span>
                    </div>

                    <div class="col-6 text-right">
                        <span class="color: grey; font-weight: bold; font-style: italic"> {{ moment(comment.created_at).fromNow() }} </span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12" v-html="comment.comment"></div>
                    <div v-if="comment.comments.length > 0" class="col-12">
                        <a href="#" class="ml-4 response-toggle" @click="showResponses"> Ver ({{comment.comments.length}}) respuestas </a>

                        <div class="col-12 d-none responses" v-for="response of comment.comments" :key="response.id">
                            <div class="row justify-content-end">
                                <div class="col-9">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-6">
                                                    <span style="font-weight: bold; font-size: 1.1em"> {{response.user.name}} </span>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <span class="color: grey; font-weight: bold; font-style: italic"> {{ moment(response.created_at).fromNow() }} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-12" v-html="response.comment"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="card-footer">
                <a class="d-block text-right" href="#" @click="respond">Responder</a>
                 <form action="/comment" method="post" class="d-none">
                    <input type="hidden" name="assignment_id" :value="assignment_id">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="comment_id" :value="comment.id">
                    <textarea class="comment" name="comment" placeholder="Comentario"></textarea>
                    <div class="row justify-content-end mt-2">
                        <div class="col-auto">
                            <button class="btn btn-success">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header"><h3>Agregar comentario</h3></div>

            <div class="card-body">
                <form action="/comment" method="post">
                    <input type="hidden" name="assignment_id" :value="assignment_id">
                    <input type="hidden" name="_token" :value="csrf">
                    <textarea class="comment" name="comment" placeholder="Comentario"></textarea>
                    <div class="row justify-content-end mt-2">
                        <div class="col-auto">
                            <button class="btn btn-success">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>


<script>

export default {
    props: {
        assignment_id: Number
    },

    data(){
        return {
            comments: [],
            csrf: null,
            moment: window.moment
        }
    },

    mounted(){
        axios.get('/comment/'+this.assignment_id).then((res)=>{
            console.log(res);

            this.comments = res.data;
        });

        this.csrf = document.querySelector('meta[name="csrf-token"]').content

        $(document).ready( ()=>{
            for( let c of document.querySelectorAll( 'textarea[name="comment"]' )){
                ClassicEditor.create(
                    c,
                    {
                        cloudServices: {
                            uploadUrl: "https://39866.cke-cs.com/easyimage/upload/",
                            tokenUrl: "https://39866.cke-cs.com/token/dev/WqT7oYJ8EhNCRBLGcxzB0cyE2hWkbebmuwtZptH845pyeADlm307ytkc75Ij"
                        }
                    }
                )
            }
        });
    },

    updated(){
        
    },

    methods: {
        showResponses(ev){
            ev.preventDefault();
            $(ev.target).parent().children('div.responses').removeClass('d-none')
            $(ev.target).addClass('d-none');
            return false;
        },

        respond(ev){
            ev.preventDefault();
            $(ev.target).parent().children('form').removeClass('d-none')
            $(ev.target).removeClass('d-block').addClass('d-none');
            return false;
        }
    }
}

</script>
