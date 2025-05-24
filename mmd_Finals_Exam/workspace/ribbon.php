<body class="bg-gray-100">
    <!-- Ribbon Container -->
    <div class="w-full bg-white shadow flex flex-col">
        <!-- Top Bar -->
        <div class="flex items-center px-4 py-2">
            <!-- Google Docs Icon -->
            <div class="flex items-center mr-4">
                <div class="w-8 h-8 bg-blue-500 rounded flex items-center justify-center">
                    <img src="https://ssl.gstatic.com/docs/doclist/images/mediatype/icon_1_document_x32.png" alt="">
                </div>
                <span class="ml-2 text-lg font-semibold text-gray-800">Untitled document</span>
                <span class="ml-2 text-sm text-gray-500">Saved to Drive</span>
            </div>
            <!-- Menu -->
            <div class="flex space-x-4 text-sm text-gray-700 font-medium">
                <button class="hover:bg-gray-100 px-2 py-1 rounded">File</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Edit</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">View</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Insert</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Format</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Tools</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Extensions</button>
                <button class="hover:bg-gray-100 px-2 py-1 rounded">Help</button>
            </div>
            <!-- Spacer -->
            <div class="flex-1"></div>
            <!-- Action Icons -->
            <div class="flex items-center space-x-2">
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 20h9" />
                        <path d="M12 4v16m0 0H3" />
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M19.4 15a7 7 0 10-14.8 0" />
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4" />
                        <path d="M12 8h.01" />
                    </svg>
                </button>
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-8 h-8 rounded-full border-2 border-blue-500">
            </div>
        </div>
        <!-- Toolbar -->
        <div class="flex items-center px-4 py-2 border-t border-b bg-gray-50">
            <button class="p-2 hover:bg-gray-200 rounded" title="Undo">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 14H5v-4" />
                    <path d="M20 20a9 9 0 10-8 8" />
                </svg>
            </button>
            <button class="p-2 hover:bg-gray-200 rounded" title="Redo">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 10h4v4" />
                    <path d="M4 4a9 9 0 018 8" />
                </svg>
            </button>
            <div class="w-px h-6 bg-gray-300 mx-2"></div>
            <select class="border border-gray-300 rounded px-2 py-1 text-sm mr-2">
                <option>Normal text</option>
                <option>Title</option>
                <option>Subtitle</option>
                <option>Heading 1</option>
                <option>Heading 2</option>
            </select>
            <select class="border border-gray-300 rounded px-2 py-1 text-sm mr-2">
                <option>Arial</option>
                <option>Times New Roman</option>
                <option>Calibri</option>
            </select>
            <select class="border border-gray-300 rounded px-2 py-1 text-sm mr-2" style="width: 60px;">
                <option>11</option>
                <option>12</option>
                <option>14</option>
                <option>18</option>
            </select>
            <div class="flex items-center space-x-1">
                <button class="p-2 hover:bg-gray-200 rounded font-bold" title="Bold">
                    <span class="font-bold text-gray-700">B</span>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded italic" title="Italic">
                    <span class="italic text-gray-700">I</span>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded underline" title="Underline">
                    <span class="underline text-gray-700">U</span>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Text color">
                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 01.894.553l5 10A1 1 0 0115 14H5a1 1 0 01-.894-1.447l5-10A1 1 0 0110 2zm0 3.618L6.382 12h7.236L10 5.618zM10 16a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Highlight color">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <rect x="4" y="4" width="12" height="12" rx="2"/>
                    </svg>
                </button>
            </div>
            <div class="w-px h-6 bg-gray-300 mx-2"></div>
            <div class="flex items-center space-x-1">
                <button class="p-2 hover:bg-gray-200 rounded" title="Align left">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 6h18M3 12h12M3 18h18"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Align center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 6h12M3 12h18M6 18h12"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Align right">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 6h18M9 12h12M3 18h18"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Numbered list">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 6h13M8 12h13M8 18h13"/>
                        <circle cx="4" cy="6" r="1"/>
                        <circle cx="4" cy="12" r="1"/>
                        <circle cx="4" cy="18" r="1"/>
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-200 rounded" title="Bulleted list">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 6h13M8 12h13M8 18h13"/>
                        <circle cx="4" cy="6" r="1"/>
                        <circle cx="4" cy="12" r="1"/>
                        <circle cx="4" cy="18" r="1"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1"></div>
            <button class="ml-2 px-4 py-1 bg-blue-600 text-white rounded font-medium hover:bg-blue-700">Share</button>
        </div>
    </div>
</body>