<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center border border-transparent bg-[#182321] px-4 py-2.5 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-[#e86d45] focus:bg-[#e86d45] focus:outline-none focus:ring-2 focus:ring-[#e86d45] focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
