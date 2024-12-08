@props(['name' => 'body', 'column' => 'body', 'title' => 'body', 'open' => 'true', 'content' => ''])

<div>
    <x-main::accordion.single :title="$title" :open="$open">
        <div  x-data="{
        monacoContent: '',
        monacoLanguage: 'html',
        monacoPlaceholder: true,
        monacoPlaceholderText: 'Start typing here',
        monacoLoader: true,
        monacoFontSize: '15px',
        monacoId: $id('monaco-editor'),
        monacoEditor(editor){
            editor.onDidChangeModelContent((e) => {
                this.monacoContent = editor.getValue();
                this.updatePlaceholder(editor.getValue());
                document.getElementById('hiddenEditorContent').value = this.monacoContent; // Update the hidden input field
            });

            editor.onDidBlurEditorWidget(() => {
                this.updatePlaceholder(editor.getValue());
            });

            editor.onDidFocusEditorWidget(() => {
                this.updatePlaceholder(editor.getValue());
            });
        },
        updatePlaceholder: function(value) {
            if (value == '') {
                this.monacoPlaceholder = true;
                return;
            }
            this.monacoPlaceholder = false;
        },
        monacoEditorFocus(){
            document.getElementById(this.monacoId).dispatchEvent(new CustomEvent('monaco-editor-focused', { monacoId: this.monacoId }));
        },
        monacoEditorAddLoaderScriptToHead() {
            script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.39.0/min/vs/loader.min.js';
            document.head.appendChild(script);
        },
        initMonacoEditor() {
            this.monacoEditorAddLoaderScriptToHead();

            let monacoLoaderInterval = setInterval(() => {
                if (typeof _amdLoaderGlobal !== 'undefined') {
                    require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.39.0/min/vs' }});
                    let proxy = URL.createObjectURL(new Blob([`self.MonacoEnvironment = { baseUrl: 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.39.0/min' }; importScripts('https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.39.0/min/vs/base/worker/workerMain.min.js');`], { type: 'text/javascript' }));

                    window.MonacoEnvironment = { getWorkerUrl: () => proxy };

                    require(['vs/editor/editor.main'], () => {
                   monacoTheme = {'base':'vs-dark','inherit':true,'rules':[{'background':'0C1021','token':''},{'foreground':'aeaeae','token':'comment'},{'foreground':'d8fa3c','token':'constant'},{'foreground':'ff6400','token':'entity'},{'foreground':'fbde2d','token':'keyword'},{'foreground':'fbde2d','token':'storage'},{'foreground':'61ce3c','token':'string'},{'foreground':'61ce3c','token':'meta.verbatim'},{'foreground':'8da6ce','token':'support'},{'foreground':'ab2a1d','fontStyle':'italic','token':'invalid.deprecated'},{'foreground':'f8f8f8','background':'9d1e15','token':'invalid.illegal'},{'foreground':'ff6400','fontStyle':'italic','token':'entity.other.inherited-class'},{'foreground':'ff6400','token':'string constant.other.placeholder'},{'foreground':'becde6','token':'meta.function-call.py'},{'foreground':'7f90aa','token':'meta.tag'},{'foreground':'7f90aa','token':'meta.tag entity'},{'foreground':'ffffff','token':'entity.name.section'},{'foreground':'d5e0f3','token':'keyword.type.variant'},{'foreground':'f8f8f8','token':'source.ocaml keyword.operator.symbol'},{'foreground':'8da6ce','token':'source.ocaml keyword.operator.symbol.infix'},{'foreground':'8da6ce','token':'source.ocaml keyword.operator.symbol.prefix'},{'fontStyle':'underline','token':'source.ocaml keyword.operator.symbol.infix.floating-point'},{'fontStyle':'underline','token':'source.ocaml keyword.operator.symbol.prefix.floating-point'},{'fontStyle':'underline','token':'source.ocaml constant.numeric.floating-point'},{'background':'ffffff08','token':'text.tex.latex meta.function.environment'},{'background':'7a96fa08','token':'text.tex.latex meta.function.environment meta.function.environment'},{'foreground':'fbde2d','token':'text.tex.latex support.function'},{'foreground':'ffffff','token':'source.plist string.unquoted'},{'foreground':'ffffff','token':'source.plist keyword.operator'}],'colors':{'editor.foreground':'#F8F8F8','editor.background':'#0C1021','editor.selectionBackground':'#253B76','editor.lineHighlightBackground':'#FFFFFF0F','editorCursor.foreground':'#FFFFFFA6','editorWhitespace.foreground':'#FFFFFF40'}};
                    monaco.editor.defineTheme('blackboard', monacoTheme);
                        document.getElementById(this.monacoId).editor = monaco.editor.create($refs.monacoEditorElement, {
                            value: this.monacoContent,
                            theme: 'blackboard',
                            fontSize: this.monacoFontSize,
                            lineNumbersMinChars: 3,
                            automaticLayout: true,
                            language: this.monacoLanguage
                        });

                        this.monacoEditor(document.getElementById(this.monacoId).editor);
                        this.updatePlaceholder(this.monacoContent);
                    });

                    clearInterval(monacoLoaderInterval);
                    this.monacoLoader = false;
                }
            }, 5);
        },
        init() {
            this.initMonacoEditor();
        }
    }"
              x-init="init()"
              :id="monacoId"
              class="flex flex-col items-center relative justify-start w-full bg-[#0C1021] min-h-[250px] pt-3 h-100">

            <!-- Editor Wrapper -->

            <div x-show="monacoLoader" class="absolute inset-0 z-20 flex items-center justify-center w-full h-full">
                <!-- Loader -->
            </div>

            <div x-show="!monacoLoader" class="relative z-10 w-full h-full">
                <div x-ref="monacoEditorElement" class="w-full h-full text-lg"></div>
                <div x-ref="monacoPlaceholderElement" x-show="monacoPlaceholder" @click="monacoEditorFocus()" :style="'font-size: ' + monacoFontSize" class="w-full text-sm font-mono absolute z-50 text-gray-2000 ml-14 -translate-x-0.5 mt-0.5 left-0 top-0" x-text="monacoPlaceholderText"></div>
            </div>

            <!-- Hidden input to store Monaco Editor content -->
            <input type="hidden" name="editor_content" id="hiddenEditorContent" value="">

            <!-- Submit button for the form -->

            @csrf
        </div>

    </x-main::accordion.single>
</div>
