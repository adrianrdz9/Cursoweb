<template>
	<div>
		<label for="body">Cuerpo</label>
		<ckeditor :editor="ClassicEditor" v-model="old" :config="{plugins:[Alignment]}"></ckeditor>
	</div>
</template>

<script scoped>
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment';     // <--- ADDED
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import EssentialsPlugin from '@ckeditor/ckeditor5-essentials/src/essentials';
    import BoldPlugin from '@ckeditor/ckeditor5-basic-styles/src/bold';
    import ItalicPlugin from '@ckeditor/ckeditor5-basic-styles/src/italic';
    import ParagraphPlugin from '@ckeditor/ckeditor5-paragraph/src/paragraph';


export default{
	props: {
		old: String,
	},

	data(){
		return {
			ClassicEditor,
			Alignment,
			EssentialsPlugin,
                        BoldPlugin,
                        ItalicPlugin,
                        ParagraphPlugin,
			config:{
				plugins: [
					Alignment,
                        		EssentialsPlugin,
                        		BoldPlugin,
                        		ItalicPlugin,
                        		
                        		ParagraphPlugin,
				],

				 toolbar: {
                        items: [
                            'bold',
                            'italic',
                            
			    'alignment',
                            'undo',
                            'redo'
                        ]
                    }
			}
		}
	}
}
</script>
