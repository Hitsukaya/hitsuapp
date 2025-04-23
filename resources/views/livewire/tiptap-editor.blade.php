<div x-data="{
    editor: null,
    content: @entangle('content')
}"
x-init="editor = new Tiptap.Editor({
    element: $refs.editor,
    extensions: [TiptapStarterKit],
    content: content,
    onUpdate({ editor }) {
        content = editor.getHTML();
    }
})"
>
    <div x-ref="editor"></div>
</div>

<script>
    import { Editor } from '@tiptap/core'
    import { StarterKit } from '@tiptap/starter-kit'

    window.Tiptap = { Editor, StarterKit }
</script>
