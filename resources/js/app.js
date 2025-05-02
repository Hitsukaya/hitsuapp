import './bootstrap';


import { Node } from '@tiptap/core';
import { Plugin } from 'prosemirror-state';
import hljs from 'highlight.js';

const CodeBlock = Node.create({
  name: 'codeBlock',

  group: 'block',

  content: 'text*',

  parseHTML() {
    return [{ tag: 'pre' }];
  },

  renderHTML({ node }) {
    return [
      'pre',
      {
        class: 'hljs',
      },
      [
        'code',
        { class: node.attrs.language },
        node.textContent,
      ]
    ];
  },

  addCommands() {
    return {
      setCodeBlock: () => ({ commands }) => {
        return commands.toggleNode('codeBlock', 'paragraph');
      },
    };
  },

  addProseMirrorPlugins() {
    return [
      new Plugin({
        props: {
          handleDOMEvents: {
            input: (view, event) => {
              const codeBlocks = view.dom.querySelectorAll('pre');
              codeBlocks.forEach((block) => {
                hljs.highlightBlock(block);
              });
              return false;
            },
          },
        },
      }),
    ];
  },
});


import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'

window.setupEditor = function (content) {
  let editor

  return {
    content: content,

    init(element) {
      editor = new Editor({
        element: element,
        extensions: [StarterKit],
        content: this.content,
        onUpdate: ({ editor }) => {
          this.content = editor.getHTML()
        },
      })

      this.$watch('content', (content) => {

        if (content === editor.getHTML()) return

        editor.commands.setContent(content, false)
      })
    },
  }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.tiptap-content pre').forEach(block => {
        const button = document.createElement('button');
        button.className = 'copy-btn';
        button.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
            </svg>
        `;

        button.onclick = () => {
            navigator.clipboard.writeText(block.innerText.trim());
            button.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" class="w-4 h-2 text-green-400">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                </svg>
                <span>Copied!</span>
            `;
            setTimeout(() => {
                button.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                    </svg>

                `;
            }, 1500);
        };

        block.style.position = 'relative';
        block.appendChild(button);
    });
});


if (typeof screen.orientation !== "undefined" && screen.orientation.lock) {
    screen.orientation.lock("portrait").catch(function(e) {
      console.log("Error locking orientation: ", e);
    });
  } else if (typeof screen.lockOrientation !== "undefined") {
    screen.lockOrientation("portrait");
  } else {
    console.log("Orientation lock is not supported on this device.");
  }

if (window.innerWidth <= 768) {
    if (typeof screen.orientation !== "undefined" && screen.orientation.lock) {
      screen.orientation.lock("portrait").catch(function(e) {
        console.log("Error locking orientation: ", e);
      });
    } else if (typeof screen.lockOrientation !== "undefined") {
      screen.lockOrientation("portrait");
    } else {
      console.log("Orientation lock is not supported on this device.");
    }
  }
