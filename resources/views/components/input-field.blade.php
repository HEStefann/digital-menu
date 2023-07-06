<div class="flex items-center h-12 text-[#909090] bg-[#F5F5F5] shadow-[0_2px_12px_0_rgb(32,32,32,18%)] rounded-xl">
    <div class="flex items-center pl-3 pointer-events-none">
        <i class="{{ $icon }}"></i>
    </div>
    <input class="border-0 bg-inherit focus:outline-none focus:ring-0 flex-grow" type={{ $type }}
        id={{ $id }} name={{ $name }} placeholder="{{ $placeholder }}" value="{{ $value }}"
        {{ strlen($model) > 0 ? 'x-model=' . $model : '' }}>
</div>
